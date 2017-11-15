<?php
require_once "adapter/GenreAdapter.php";

class GenrePDO {
    private $table;
    private $query;
    private $adapter;

    public function __construct() {
        $this->table = "genre";
        $this->query = new QueryManager($this->table);
        $this->adapter = new GenreAdapter();
    }

    public function selectById(int $id) {
        $filter = array(
            0 => "genre.genreid = {$id}"
        );

        $resultset = $this->query->selectOne(array(), $filter);
        $genre = $this->adapter->toEntity($resultset);

        return $genre;
    }

    public function selectByName(string $name) {
        $filter = array(
            0 => "genre.name LIKE '%{$name}%'"
        );

        $resultset = $this->query->select(array(), $filter);
        $genres = $this->adapter->toEntityArray($resultset);

        return $genres;
    }

    public function selectAll() {
        $resultset = $this->query->selectAll();
        $genres = $this->adapter->toEntityArray($resultset);

        return $genres;
    }

    public function create(Genre $genre) {
        $values = $this->adapter->toMap($genre);

        unset($values["genreid"]);

        $this->query->insert($values);
    }

    public function update(Genre $genre) {
        $fields = $this->adapter->toMap($genre);
        $filter = array(
            0 => "genre.genreid = {$genre->id}"
        );

        $this->query->update($fields, $filter);
    }

    public function delete(Genre $genre) {
        $filter = array(
            0 => "genre.genreid = {$genre->id}"
        );

        $this->query->delete($filter);
    }
}