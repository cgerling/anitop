<?php
namespace anitop\entity;

class Anime extends Entity {
    public $name;
    public $seasonRelease;
    public $description;
    public $author;
    public $publisher;
    public $genres;

    public function __construct(string $name, DateTime $seasonRelease, string $description, string $author, string $publisher, array $genres) {
        $this->name = $name;
        $this->seasonRelease = $seasonRelease;
        $this->description = $description;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->genres = $genres;
    }
}