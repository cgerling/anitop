<?php
require_once "adapter/iadapter.php";
require_once "adapter/anime-adapter.php";
require_once "adapter/user-adapter.php";
require_once "adapter/status-adapter";
require_once "entity/watchitem.php";

class WatchitemAdapter implements iAdapter {
    private $animeAdapter;
    private $userAdapter;
    private $statusAdapter;

    public function __construct() {
        $this->animeAdapter = new AnimeAdapter();
        $this->userAdapter = new UserAdapter();
        $this->statusAdapter = new StatusAdapter();
    }

    /**
     * Adapt a Database ResultSet to an Entity instance
     * @param $resultset database result set
     * @return Entity
     */
    public function toEntity($resultset)
    {
        $anime = $this->animeAdapter->toEntity($resultset);
        $user = $this->userAdapter->toEntity($resultset);
        $status = $this->statusAdapter->toEntity($resultset);

        $watchitem = new Watchitem($anime, $user, $status);

        return $watchitem;
    }

    /**
     * Adapt a Database ResultSet to an Entity array instance
     * @param $resultset
     * @return array
     */
    public function toEntityArray($resultset)
    {
        $watchlist = array();

        foreach ($resultset as $watchitem) {
            $watchlist[] = $this->toEntity($watchitem);
        }

        return $watchlist;
    }

    /**
     * @param $anime
     * @return array
     */
    public function toMap($entity): array
    {
        $watchitemMap = array();

        foreach ($entity as $key=>$value) {
            $watchitemMap[$key] = $value->id;
        }

        return $watchitemMap;
    }
}