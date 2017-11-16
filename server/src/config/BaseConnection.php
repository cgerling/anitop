<?php
namespace anitop\config;

class BaseConnection {
    private $connection;

    public function __construct() {
        $database = new Database("mysql", "localhost");
        $this->connection = $database->connect("anitop", "anitop", getenv("db_pwd"));
    }

    public function get() {
        return $this->connection;
    }
}