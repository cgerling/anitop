<?php
namespace anitop\entity;

class Status extends Entity {
    public $name;
    public $description;

    public function __construct(string $name, string $description) {
        $this->name = $name;
        $this->description = $description;
    }
}