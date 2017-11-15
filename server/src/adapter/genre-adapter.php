<?php
require_once "iadapter.php";
require_once "entities/genre.php";

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
     * @param $anime
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