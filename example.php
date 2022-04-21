<?php

class User
{
    protected $name;
    protected $login;
    protected $password;

    public function __construct($name, $login, $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }

    public function getInfo() {
        echo 'Here is a user ' . $this->name . ' with login ' . $this->login . ' and password ' . $this->password . '.<br>';
    }

    public function __clone() {
        $name = 'User';
        $login = 'User';
        $password = 'qwerty';
    }
}

class SuperUser extends User
{
    public $character;

    public function __construct($name, $login, $password, $character)
    {
        $this->character = $character;
        parent::__construct($name, $login, $password);
    }

    public function getInfo()
    {
        echo 'Here is a user ' . $this->name . ' with login ' . $this->login . ' and password ' . $this->password . '. Character is ' . $this->character . '.<br>';
    }
}

$userMisha = new User('Misha', 'mishka', '123456');
$userVlad = new User('Vlad', 'vladik', '1111');
$userVova = new User('Vova', 'vovchik', '050505');

$userMisha->getInfo();
$userVlad->getInfo();
$userVova->getInfo();

$clonedUser = clone $userMisha;
$clonedUser->getInfo();

$newSuperUser = new SuperUser('Amin', 'admin', 'qwerty', 'admin');
$newSuperUser->getInfo();

