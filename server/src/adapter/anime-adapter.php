<?php
require_once "adapter/iadapter.php";
require_once "entity/anime.php";
require_once "service/date-time-service.php";

class AnimeAdapter implements iAdapter {

    /**
     * Adapt a Database ResultSet to an Entity instance
     * @param $resultset database result set
     * @return Entity
     */
    public function toEntity($resultset) {
        $seasonRelease = DateTimeService::fromString($resultset["seasonRelease"]);

        $anime = new Anime($resultset["name"], $seasonRelease, $resultset["description"], $resultset["author"], $resultset["publisher"], array());
        $anime->id = $resultset["animeid"];

        return $anime;
    }

    /**
     * Adapt a Database ResultSet to an Entity array instance
     * @param $resultset
     * @return array
     */
    public function toEntityArray($resultset) {
        $animes = array();

        foreach ($resultset as $anime) {
            $animes[] = $this->toEntity($anime);
        }

        return $animes;
    }

    /**
     * @param $anime
     * @return array
     */
    public function toMap($anime): array {
        $animeMap = array();

        foreach ($anime as $key=>$value) {
            if($value instanceof DateTime) {
                $value = DateTimeService::toString($value);
            }

            $animeMap[$key] = $value;
        }

        $animeMap["animeid"] = $animeMap["id"];
        unset($animeMap["id"]);
        unset($animeMap["genres"]);

        return $animeMap;
    }
}