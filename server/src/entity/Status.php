<?php
require_once "Status.php";
namespace Anitop\Entity;

class Status extends Entity {
    public $name;
    public $description;

    public function __construct(string $name, string $description) {
        $this->name = $name;
        $this->description = $description;
    }
}