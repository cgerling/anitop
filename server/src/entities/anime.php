<?php
require_once "./entity.php";

class Anime extends Entity {
    private $name;
    private $seasonRelease;
    private $description;
    private $author;
    private $publisher;
    private $genres;

    public function __construct(string $name, DateTime $seasonRelease, string $description, string $author, string $publisher, array $genres) {
        $this->name = $name;
        $this->seasonRelease = $seasonRelease;
        $this->description = $description;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->genres = $genres;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getSeasonRelease(): DateTime {
        return $this->seasonRelease;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAuthor(): string {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getPublisher(): string {
        return $this->publisher;
    }

    /**
     * @return array
     */
    public function getGenres(): array {
        return $this->genres;
    }
}