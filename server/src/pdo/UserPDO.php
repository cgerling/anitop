<?php
namespace anitop\pdo;

use anitop\utils\QueryManager;
use anitop\entity\User;
use anitop\adapter\UserAdapter;

class UserPDO {
    private $table;
    private $query;
    private $adapter;

    public function __construct() {
        $this->table = 'user';
        $this->query = new QueryManager($this->table);
        $this->adapter = new UserAdapter();
    }

    public function selectById(int $id): User {
        $filter = array(
            0 => "user.userid = {$id}"
        );

        $resultset = $this->query->selectOne(array(), $filter);
        $user = $this->adapter->toEntity($resultset);

        return $user;
    }

    public function selectByEmail(string $email): User {
        $filter = array(
            0 => "user.email LIKE '%{$email}%'"
        );

        $resulset = $this->query->selectOne(array(), $filter);
        $user = $this->adapter->toEntity($resulset);

        return $user;
    }

    public function selectAll(): array {
        $resultset = $this->query->selectAll();
        $users = $this->adapter->toEntityArray($resultset);

        return $users;
    }

    public function create(User $user) {
        $values = $this->adapter->toMap($user);

        unset($values['userid']);
        
        $this->query->insert($values);
    }

    public function update(User $user) {
        $fields = $this->adapter->toMap($user);
        $filter = array(
            0 => "user.userid = {$user->id}"
        );

        $this->query->update($fields, $filter);
    }

    public function delete(User $user) {
        $filter = array(
            0 => "user.userid = {$user->id}"
        );

        $this->query->delete($filter);
    }
}