<?php
namespace anitop\service;

use anitop\entity\User;
use \Firebase\JWT\JWT;

class AuthService {

    private $secret = "anitop_secret";
    private $algorithm;

    public function __construct($algorithm = array('HS256')) {
        $this->algorithm = $algorithm;
    }

    public function createToken(User $user) {
        $userInfo = array(
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email
        );

        return JWT::encode($userInfo, $this->secret);
    }

    public function parseToken(string $token): array {
        return (array) JWT::decode($token, $this->secret, $this->algorithm);
    }

}