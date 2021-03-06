<?php
namespace anitop\pdo;

use anitop\utils\QueryManager;
use anitop\entity\Anime;
use anitop\adapter\AnimeAdapter;

class AnimePDO {
    private $table;
    private $query;
    private $adapter;

    private $tableJoin = array();

    public function __construct() {
        $this->table = 'anime';
        $this->query = new QueryManager($this->table);
        $this->adapter = new AnimeAdapter();
    }

    public function selectById(int $id): Anime {
        $filter = array(
            0 => "anime.animeid = {$id}"
        );

        $result = $this->query->selectOne($this->tableJoin, $filter);
        $anime = $this->adapter->toEntity($result);

        return $anime;
    }

    public function selectByName(string $name): array {
        $filter = array(
            0 => "anime.name LIKE '%{$name}%'"
        );

        $result = $this->selectByFilter($filter);
        $animes = $this->adapter->toEntityArray($result);

        return $animes;
    }

    public function selectByPublisher(string $publisher): array {
        $filter = array(
            0 => "anime.publisher LIKE '%{$publisher}%'"
        );

        $result = $this->selectByFilter($filter);
        $animes = $this->adapter->toEntityArray($result);

        return $animes;
    }

    public function selectAll(): array {
        $resultset = $this->query->selectAll($this->tableJoin);
        $animes = $this->adapter->toEntityArray($resultset);

        return $animes;
    }

    public function create(Anime $anime) {
        $values = $this->adapter->toMap($anime);

        unset($values['animeid']);

        $this->query->insert($values);
    }

    public function update(Anime $anime) {
        $fields = $this->adapter->toMap($anime);
        $filter = array(
            0 => "anime.animeid = {$anime->id}"
        );

        $this->query->update($fields, $filter);
    }

    public function delete(Anime $anime) {
        $filter = array(
            0 => "anime.animeid = {$anime->id}"
        );

        $this->query->delete($filter);
    }

    private function selectByFilter($filter = array()) {
        return $this->query->select($this->tableJoin, $filter);
    }
}
