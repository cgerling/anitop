<?php

require_once "adapter/iadapter.php";
require_once "entity/status.php";

class StatusAdapter implements iAdapter {

    /**
     * Adapt a Database ResultSet to an Entity instance
     * @param $resultset database result set
     * @return Entity
     */
    public function toEntity($resultset) {
        $status = new Status($resultset["name"], $resultset["description"]);
        $status->id = $resultset["statusid"];

        return $status;
    }

    /**
     * Adapt a Database ResultSet to an Entity array instance
     * @param $resultset
     * @return array
     */
    public function toEntityArray($resultset) {
        $status = array();

        foreach ($resultset as $item) {
            $status[] = $this->toEntity($item);
        }

        return $status;
    }

    /**
     * @param $anime
     * @return array
     */
    public function toMap($entity): array {
        $statusMap = array();

        foreach ($entity as $key=>$value) {
            $statusMap[$key] = $value;
        }

        $statusMap["statusid"] = $statusMap["id"];
        unset($statusMap["id"]);

        return $statusMap;
    }
}