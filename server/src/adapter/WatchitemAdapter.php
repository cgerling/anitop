<?php
namespace anitop\adapter;

use anitop\entity\User;
use anitop\entity\Watchitem;

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
        $user = new User();
        $user->id = $resultset['userid'];
        $status = null;

        $watchitem = new Watchitem($anime, $user, $status);
        $watchitem->id = $resultset['watchlistid'];

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
     * Convert the Entity instance to key-value map to SQL Operations
     * @param $entity
     * @return array
     */
    public function toMap($entity): array
    {
        $watchitemMap = array();

        foreach ($entity as $key=>$value) {
            $watchitemMap[$key] = $value->id;
        }

        $watchitemMap['watchitemid'] = $entity->id;
        unset($watchitemMap['id']);

        return $watchitemMap;
    }
}