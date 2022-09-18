<?php
namespace App\Models;

class UserUpdateModel
{
    private $id;
    private $username;
    private $password;

    function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    public function getId() 
    {
        return $this->id;
    }
    
    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
}

