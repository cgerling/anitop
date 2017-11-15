<?php
namespace Anitop\Adapter;

interface iAdapter {

    /**
     * Adapt a Database ResultSet to an Entity instance
     * @param $resultset database result set
     * @return Entity
     */
    public function toEntity($resultset);


    /**
     * Adapt a Database ResultSet to an Entity array instance
     * @param $resultset
     * @return array
     */
    public function toEntityArray($resultset);

    /**
     * Convert the Entity instance to key-value map to SQL Operations
     * @param $entity
     * @return array
     */
    public function toMap($entity): array;
}