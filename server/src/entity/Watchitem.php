<?php
namespace anitop\entity;

class Watchitem extends Entity {
    public $anime;
    public $user;
    public $status;

    public function __construct(Anime $anime = null, User $user = null, Status $status = null)
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
