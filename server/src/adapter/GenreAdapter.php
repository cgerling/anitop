<?php
require_once "iAdapter.php";
require_once "entity/Genre.php";

class GenreAdapter implements iAdapter {

    /**
     * Adapt a Database ResultSet to an Entity instance
     * @param $resultset database result set
     * @return Entity
     */
    public function toEntity($resultset) {
        $genre = new Genre($resultset["name"]);
        $genre->id = $resultset["genreid"];

        return $genre;
    }

    /**
     * Adapt a Database ResultSet to an Entity array instance
     * @param $resultset
     * @return array
     */
    public function toEntityArray($resultset) {
        $genres = array();

        foreach ($resultset as $genre) {
            $genres[] = $this->toEntity($genre);
        }

        return $genres;
    }

    /**
     * Convert the Entity instance to key-value map to SQL Operations
     * @param $entity
     * @return array
     */
    public function toMap($entity): array {
        $genreMap = array();

        foreach ($entity as $key=>$value) {
            $genreMap[$key] = $value;
        }

        $genreMap["genreid"] = $genreMap["id"];
        unset($genreMap["id"]);

        return $genreMap;
    }
}