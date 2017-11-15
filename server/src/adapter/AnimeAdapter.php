<?php
require_once "adapter/iAdapter.php";
require_once "entity/Anime.php";
require_once "service/DateTimeService.php";
namespace Anitop\Adapter;

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
     * Convert the Entity instance to key-value map to SQL Operations
     * @param $entity
     * @return array
     */
    public function toMap($entity): array {
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