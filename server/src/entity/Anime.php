<?php
namespace anitop\entity;

class Anime extends Entity {
    public $name;
    public $description;
    public $studio;
    public $publisher;
    public $image;

    public function __construct(string $name = '', string $description = '', string $studio = '', string $publisher = '', string $image = '') {
        $this->name = $name;
        $this->description = $description;
        $this->studio = $studio;
        $this->publisher = $publisher;
        $this->image = $image;
    }
}