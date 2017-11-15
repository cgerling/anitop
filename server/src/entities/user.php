<?php
require_once "./entity.php";

class User extends Entity {

    private $name;
    private $email;
    private $password;
    private $birth;

    public function __construct(string $name, string $email, string $password, DateTime $birth) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->birth = $birth;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @return DateTime
     */
    public function getBirth(): DateTime {
        return $this->birth;
    }

    /**
     * @param DateTime $birth
     */
    public function setBirth($birth) {
        $this->birth = $birth;
    }
}