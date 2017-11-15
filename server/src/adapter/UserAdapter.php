<?php
namespace Anitop\Adapter;

use Anitop\Entity\User;
use Anitop\Service\DateTimeService;

class UserAdapter implements iAdapter {

    /**
     * Adapt a Database ResultSet to an Entity instance
     * @param $resultset database result set
     * @return Entity
     */
    public function toEntity($resultset) {
        $birth = DateTimeService::fromString($resultset["birth"]);

        $user = new User($resultset["name"], $resultset["email"], $resultset["password"], $birth);
        $user->id = $resultset["userid"];

        return $user;
    }

    /**
     * Adapt a Database ResultSet to an Entity array instance
     * @param $resultset
     * @return array
     */
    public function toEntityArray($resultset) {
        $users = array();

        foreach ($resultset as $user) {
            $users[] = $this->toEntity($user);
        }

        return $users;
    }

    /**
     * Convert the Entity instance to key-value map to SQL Operations
     * @param $entity
     * @return array
     */
    public function toMap($entity): array {
        $userMap = array();

        foreach ($entity as $key=>$value) {
            if($value instanceof DateTime) {
                $value = DateTimeService::toString($value);
            }

            $userMap[$key] = $value;
        }

        return $userMap;
    }
}