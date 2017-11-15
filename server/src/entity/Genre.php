<?php
require_once "Entity.php";

class Genre extends Entity {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

}