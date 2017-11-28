<?php
namespace anitop\pdo;

use anitop\utils\QueryManager;
use anitop\entity\Watchitem;
use anitop\adapter\WatchitemAdapter;

class WatchitemPDO {
    private $table;
    private $query;
    private $adapter;

    private $tableJoin = array(
        0 => array(
            "targetTable" => "anime",
            "targetColumn" => "animeid",
            "sourceColumn" => "anime"
        )/*,
        1 => array(
            "targetTable" => "status",
            "targetColumn" => "statusid",
            "sourceColumn" => "status"
        )*/
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

    public function selectByAnimeStatus(int $animeId, int $statusId) {
        $filter = array(
            0 => "watchlist.anime = {$animeId}",
            1 => "AND",
            2 => "watchlist.status = {$statusId}"
        );

        $resultset = $this->query->select($this->tableJoin, $filter);
        $watchlist = $this->adapter->toEntityArray($resultset);

        return $watchlist;
    }

    public function selectByUserStatus(int $userId, int $statusId) {
        $filter = array(
            0 => "watchlist.user = {$userId}",
            1 => "AND",
            2 => "watchlist.status = {$statusId}"
        );

        $resultset = $this->query->select($this->tableJoin, $filter);
        $watchlist = $this->adapter->toEntityArray($resultset);

        return $watchlist;
    }

    public function selectByUserAnime(int $userId, int $animeId) {
        $filter = array(
            0 => "watchlist.user = {$userId}",
            1 => "AND",
            2 => "watchlist.anime = {$animeId}"
        );

        $resultset = $this->query->selectOne($this->tableJoin, $filter);
        $watchlist = $this->adapter->toEntity($resultset);

        return $watchlist;
    }

    public function isWatching(int $userId, int $animeId, int $activeStatusId) {
        $filter = array(
            0 => "watchlist.user = {$userId}",
            1 => "AND",
            2 => "watchlist.anime = {$animeId}",
            3 => "AND",
            4 => "watchlist.status = {$activeStatusId}"
        );

        $count = $this->query->count($this->tableJoin, $filter);

        return $count > 0;
    }

    public function selectByUserAnimeStatus(int $userId, int $animeId, int $statusId) {
        $filter = array(
            0 => "watchlist.user = {$userId}",
            1 => "AND",
            2 => "watchlist.anime = {$animeId}",
            3 => "AND",
            4 => "watchlist.status = {$statusId}"
        );

        $resultset = $this->query->selectOne($this->tableJoin, $filter);
        $watchlist = $this->adapter->toEntity($resultset);

        return $watchlist;
    }

    public function selectAll() {
        $resultset = $this->query->selectAll($this->tableJoin);
        $watchlist = $this->adapter->toEntityArray($resultset);

        return $watchlist;
    }

    public function create(Watchitem $watchitem) {
        $values = $this->adapter->toMap($watchitem);
        unset($values["watchitemid"]);

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