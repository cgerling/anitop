<?php
require_once "Entity.php";
namespace Anitop\Entity;

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