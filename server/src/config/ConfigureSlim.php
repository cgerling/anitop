<?php
namespace anitop\config;

use \Slim\App as App;
use \Psr\Container\ContainerInterface as Container;

use anitop\service\AuthService;
use anitop\service\EncryptionService;

require "service/AuthService.php";
require "service/EncryptionService.php";

class ConfigureSlim {
    public static function configure(App $app) {
        $container = $app->getContainer();

        self::injectServices($container);
    }

    private static function injectServices(Container $container) {
        $container['authService'] = function () {
            return new AuthService();
        };

        $container['encryptionService'] = function () {
            return new EncryptionService();
        };
    }
}