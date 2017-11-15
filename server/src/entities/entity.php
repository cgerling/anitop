<?php
abstract class Entity {
    protected $id;

    /**
     * @param int $id
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
}