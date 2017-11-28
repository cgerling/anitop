<?php
include "config/config.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use anitop\config\ConfigureSlim;
use anitop\pdo as PDO;

require_once "../vendor/autoload.php";

$config = [
  'settings' => [
      'displayErrorDetails' => true
  ]
];
$container = new \Slim\Container($config);
$app = new \Slim\App($container);

ConfigureSlim::configure($app);

$app->post('/auth/login', function (Request $request, Response $response) {
    $authService = $this->get('authService');
    $encryptService = $this->get('encryptionService');
    $userPdo = new PDO\UserPDO();

    $body = $request->getParsedBody();
    $user = array(
        'email' => $body['email'],
        'passwd' => $body['password']
    );

    $userDb = $userPdo->selectByEmail($user['email']);

    $res = $response->withJson(array(), 401);
    $passwordMatch = $encryptService->verify($user['passwd'], $userDb->password);
    if($passwordMatch) {
        $token = $authService->createToken($userDb);
        $data = array(
            'token' => $token
        );
        
        $res = $response->withJson($data);
    } 

    return $res;
});

$app->post('/auth/register', function (Request $request, Response $response) {
    $encryptService = $this->get('encryptionService');
    $userPdo = new PDO\UserPDO();

    $body = $request->getParsedBody();
    $passwd = $encryptService->encrypt($body['password']);
    $newUser = new \anitop\entity\User($body['name'], $body['email'], $passwd, new DateTime());

    $userPdo->create($newUser);
});

$app->add(function ($req, $res, $next) {
    if(!$req->hasHeader('Authorization')) {
        return $res;
    }

    $token = $req->getHeader('Authorization')[0];
    if($token == null || $token == '') {
        return $res;
    }

    $authService = $this->get('authService');
    $userInfo = $authService->parseToken($token);

    $userPdo = new PDO\UserPDO();
    $user = $userPdo->selectByEmail($userInfo['email']);

    $request = $req->withAttribute('user', $user);

    return $next($request, $res);
});

// TODO: finish it
$app->get('/search', function (Request $request, Response $response, $args) {
    $animePdo = new PDO\AnimePDO();

    $params = $request->getQueryParams();

    $allAnimes = $animePdo->selectByName($params['term'] ?? '');

    $page = $params['page'] !== null && $params['page'] > 0 ? $params['page'] : 1;
    $size = $params['size'] ?? 30;

    $offset = ($page - 1) * $size;

    $result = array_slice($allAnimes, $offset, $size, true);
    $animes = \anitop\utils\EncodingService::encodeDoubleArray($result);

    $data = array(
        'animes' => $animes,
        'page' => (int) $page,
        'size' => (int) $size,
        'total' => count($allAnimes)
    );

    return $response->withJson($data);
});

$app->get('/anime', function (Request $request, Response $response) {
    $animePdo = new PDO\AnimePDO();

    $allAnimes = $animePdo->selectAll();

    $params = $request->getQueryParams();
    $page = $params['page'] !== null && $params['page'] > 0 ? $params['page'] : 1;
    $size = $params['size'] ?? 30;

    $offset = ($page - 1) * $size;

    $result = array_slice($allAnimes, $offset, $size, true);
    $animes = \anitop\utils\EncodingService::encodeDoubleArray($result);

    $data = array(
        'animes' => $animes,
        'page' => (int) $page,
        'size' => (int) $size,
        'total' => count($allAnimes)
    );

    return $response->withJson($data);
});

$app->post('/anime', function (Request $request, Response $response) {
    $animePdo = new PDO\AnimePDO();

    $body = $request->getParsedBody();
    $newAnime = new \anitop\entity\Anime($body['name'], new DateTime(), $body['description'], $body['author'], $body['publisher'], array(), $body['image']);

    $animePdo->create($newAnime);
});

$app->get('/anime/{id}', function (Request $request, Response $response, $args) {
    $animePdo = new PDO\AnimePDO();

    $anime = $animePdo->selectById($args['id']);

    $result = \anitop\utils\EncodingService::encodeArray($anime);

    $data = array(
        'anime' => $result
    );

    return $response->withJson($data);
});

$app->get('/anime/{id}/popularity', function (Request $request, Response $response, $args) {
    $watchitemPdo = new PDO\WatchitemPDO();
    $statusPdo = new PDO\StatusPDO();

    $animeId = $args['id'];
    $status = $statusPdo->selectByName('Active')[0];

    $watchlist = $watchitemPdo->selectByAnimeStatus($animeId, $status->id);
    $data = array(
        'popularity' => count($watchlist)
    );

    return $response->withJson($data);
});

$app->get('/watchlist', function (Request $request, Response $response) {
    $watchitemPdo = new PDO\WatchitemPDO();
    $statusPdo = new PDO\StatusPDO();

    $user = $request->getAttribute('user');
    $status = $statusPdo->selectByName('Active')[0];

    $result = $watchitemPdo->selectByUserStatus($user->id, $status->id);

    $animes = array();
    foreach ($result as $watchitem) {
        $animes[] = $watchitem->anime;
    }

    $watchlist = \anitop\utils\EncodingService::encodeDoubleArray($animes);
    $data = array(
        'watchlist' => $watchlist
    );

    return $response->withJson($data);
});

$app->get('/watchlist/{id}', function (Request $request, Response $response, $args) {
    $watchitemPdo = new PDO\WatchitemPDO();
    $statusPdo = new PDO\StatusPDO();

    $user = $request->getAttribute('user');
    $statusActive = $statusPdo->selectByName('Active')[0];
    $watching = $watchitemPdo->isWatching($user->id, $args['id'], $statusActive->id);

    $data = array(
        'watching' => $watching
    );

    return $response->withJson($data);
});

$app->post('/watchlist', function (Request $request, Response $response) {
    $watchitemPdo = new PDO\WatchitemPDO();
    $statusPdo = new PDO\StatusPDO();

    $body = $request->getParsedBody();

    $anime = new \anitop\entity\Anime();
    $anime->id = $body['anime'];

    $user = $request->getAttribute('user');

    $status = $statusPdo->selectByName('Active')[0];

    $watchitem = new \anitop\entity\Watchitem($anime, $user, $status);
    $watchitemPdo->create($watchitem);
});

$app->delete('/watchlist/{anime}', function (Request $request, Response $response, $args) {
    $watchitemPdo = new PDO\WatchitemPDO();
    $statusPdo = new PDO\StatusPDO();

    $animeId = $args['anime'];

    $user = $request->getAttribute('user');
    $userId = $user->id;

    $newStatus = $statusPdo->selectByName('Inactive')[0];
    $status = $statusPdo->selectByName('Active')[0];
    $statusId = $status->id;

    $watchitem = $watchitemPdo->selectByUserAnimeStatus($userId, $animeId, $statusId);
    $watchitem->status->id = $newStatus->id;
    $watchitem->user = new \anitop\entity\User;
    $watchitem->user->id = $user->id;

    $watchitemPdo->update($watchitem);
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    $corsResponse = $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

    return $corsResponse;
});

$app->run();
