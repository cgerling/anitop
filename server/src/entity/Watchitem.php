<?php
require_once "Entity.php";
require_once "Anime.php";
require_once "User.php";
require_once "Status.php";

class Watchitem extends Entity {

    private $anime;
    private $user;
    private $status;

    public function __construct(Anime $anime, User $user, Status $status)
    {
        $this->anime = $anime;
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * @return Anime
     */
    public function getAnime(): Anime {
        return $this->anime;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status {
        return $this->status;
    }

}