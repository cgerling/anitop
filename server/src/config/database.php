<?php

class Database {

    private $database;
    private $host;

    public function __constructor($database, $host) {
        $this->database = $database;
        $this->host = $host;
    }

    public function connect($dbname, $user, $passwd) {
        $connectionString = $this->database.":host".$this->host.";dbname=".$dbname;

        return new PDO($connectionString, $user, $passwd);
    }
}
