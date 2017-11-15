<?php
namespace Anitop\Entity;

class User extends Entity {
    public $name;
    public $email;
    public $password;
    public $birth;

    public function __construct(string $name, string $email, string $password, DateTime $birth) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->birth = $birth;
    }
}