<?php

require_once "query-manager.php";
require_once "entity/watchitem.php";
require_once "adapter/watchitem-adapter.php";

class WatchitemPDO {
    private $table;
    private $query;
    private $adapter;

    private $tableJoin = array(
        0 => array(
            "targetTable" => "anime",
            "targetColumn" => "animeid",
            "sourceColumn" => "anime"
        ),
        1 => array(
            "targetTable" => "status",
            "targetColumn" => "statusid",
            "sourceColumn" => "status"
        )
    );

    public function __construct() {
        $this->table = "watchlist";
        $this->query = new QueryManager($this->table);
        $this->adapter = new WatchitemAdapter();
    }

    public function selectById(int $id) {
        $filter = array(
            0 => "watchlist.wathclistid = {$id}"
        );

        $resultset = $this->query->selectOne($this->tableJoin, $filter);
        $watchitem = $this->adapter->toEntity($resultset);

        return $watchitem;
    }

    public function selectByUser(int $userId) {
        $filter = array(
            0 => "watchlist.user = {$userId}"
        );

        $resultset = $this->query->select($this->tableJoin, $filter);
        $watchlist = $this->adapter->toEntityArray($resultset);

        return $watchlist;
    }

    public function selectAll() {
        $resultset = $this->query->selectAll($this->tableJoin);
        $watchlist = $this->adapter->toEntityArray($resultset);

        return $watchlist;
    }

    public function create(Watchitem $watchitem) {
        $values = $this->adapter->toMap($watchitem);

        unset($values["watchlistid"]);

        $this->query->insert($values);
    }

    public function update(Watchitem $watchitem) {
        $fields = $this->adapter->toMap($watchitem);
        $filter = array(
            0 => "watchlist.watchlistid = {$watchitem->id}"
        );

        $this->query->update($fields, $filter);
    }

    public function delete(Watchitem $watchitem) {
        $filter = array(
            0 => "watchlist.watchlistid = {$watchitem->id}"
        );

        $this->query->delete($filter);
    }
}