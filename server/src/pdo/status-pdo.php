<?php

require_once "query-manager.php";
require_once "entities/status.php";
require_once "adapter/status-adapter.php";

class StatusPDO {
    private $table;
    private $query;
    private $adapter;

    public function __construct() {
        $this->table = "status";
        $this->query = new QueryManager($this->table);
        $this->adapter = new StatusAdapter();
    }

    public function selectById(int $id) {
        $filter = array(
            0 => "status.statusid = {$id}"
        );

        $resulset = $this->query->selectOne(array(), $filter);
        $status = $this->adapter->toEntity($resulset);

        return $status;
    }

    public function selectByName(string $name) {
        $filter = array(
            0 => "status.name LIKE '%{$name}%'"
        );

        $resultset = $this->query->select(array(), $filter);
        $status = $this->adapter->toEntity($resultset);

        return $status;
    }

    public function create(Status $status) {
        $values = $this->adapter->toMap($status);

        unset($values["statusid"]);

        $this->query->insert($values);
    }

    public function update(Status $status) {
        $fields = $this->adapter->toMap($status);
        $filter = array(
            0 => "status.statusid = {$status->id}"
        );

        $this->query->update($fields, $filter);
    }

    public function delete(Status $status) {
        $filter = array(
            0 => "status.statusid = {$status->id}"
        );

        $this->query->delete($filter);
    }
}