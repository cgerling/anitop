<?php
namespace anitop\adapter;

use anitop\entity\Anime;
use anitop\service\DateTimeService;

class AnimeAdapter implements iAdapter {

    /**
     * Adapt a Database ResultSet to an Entity instance
     * @param $resultset database result set
     * @return Entity
     */
    public function toEntity($resultset) {
        $anime = new Anime($resultset['name'], $resultset['description'], $resultset['studio'], $resultset['publisher'], $resultset['image']);
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
            $animeMap[$key] = $value;
        }

        $animeMap["animeid"] = $animeMap["id"];
        unset($animeMap["id"]);
        
        return $animeMap;
    }
}