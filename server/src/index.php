<?php
include "config/config.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use anitop\config\ConfigureSlim;
use anitop\pdo as PDO;

require_once "../vendor/autoload.php";

$app = new \Slim\App;

ConfigureSlim::configure($app);

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

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

    $passwordMatch = $encryptService->verify($user['passwd'], $userDb->password);
    if($passwordMatch) {
        $token = $authService->createToken($userDb);
        $data = array(
            'token' => $token
        );

        return $response->withJson($data);
    } else {
        return $response->withJson(array(), 401);
    }
});

$app->post('/auth/register', function (Request $request, Response $response) {
    $encryptService = $this->get('encryptionService');
    $userPdo = new PDO\UserPDO();

    $body = $request->getParsedBody();
    $passwd = $encryptService->encrypt($body['password']);
    $newUser = new \anitop\entity\User($body['name'], $body['email'], $passwd, new DateTime());

    $userPdo->create($newUser);
});

// TODO: add auth middleware

$app->get('/anime', function (Request $request, Response $response) {
    $animePdo = new PDO\AnimePDO();

    $allAnimes = $animePdo->selectAll();

    $body = $request->getParsedBody();
    $page = $body['page'] !== null && $body['page'] > 0 ? $body['page'] : 1;
    $size = $body['size'] ?? 30;

    $page = ($page - 1) * 30;

    $data = array(
        'animes' => array_slice($allAnimes, $page, $size, true)
    );

    return $response->withJson($data);
});

$app->post('/anime', function (Request $request, Response $response) {
    $animePdo = new PDO\AnimePDO();

    $body = $request->getParsedBody();
    $newAnime = new \anitop\entity\Anime($body['name'], new DateTime(), $body['description'], $body['author'], $body['publisher'], array(), $body['image']);

    $animePdo->create($newAnime);
});

$app->get('/anime/:id', function (Request $request, Response $response) {
    $animePdo = new PDO\AnimePDO();

    $body = $request->getParsedBody();
    $anime = $animePdo->selectById($body['id']);

    $data = array(
        'anime' => $anime
    );

    return $response->withJson($data);
});

$app->get('/watchlist', function (Request $request, Response $response) {
    $watchitemPdo = new PDO\WatchitemPDO();

    $body = $request->getParsedBody();
    $watchlist = $watchitemPdo->selectByUser($body['user']);
    $data = array(
        'watchlist' => $watchlist
    );

    return $response->withJson($data);
});

$app->put('/watchlist', function (Request $request, Response $response) {
    $watchitemPdo = new PDO\WatchitemPDO();
    $statusPdo = new PDO\StatusPDO();

    $body = $request->getParsedBody();

    $anime = new \anitop\entity\Anime();
    $anime->id = $body['anime'];

    $user = new \anitop\entity\User();
    $user->id = $body['user'];

    $defaultStatus = $statusPdo->selectByName('ativo');
    $status = new \anitop\entity\Status();
    $status->id = $body['status'] ?? $defaultStatus;

    $watchitem = new \anitop\entity\Watchitem($anime, $user, $status);
    $watchitemPdo->create($watchitem);
});

$app->get('/watchlist/status', function (Request $request, Response $response) {
    $statusPdo = new PDO\StatusPDO();

    $body = $request->getParsedBody();
    $status = $statusPdo->selectAll();
    $data = array(
        'status' => $status
    );

    return $response->withJson($data);
});

$app->run();
