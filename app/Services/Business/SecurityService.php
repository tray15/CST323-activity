<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;
use Exception;

class SecurityService
{
    private $dao;
    
    function __construct() {
        $this->dao = new SecurityDAO();
    }
    public function login(UserModel $user)
    {
        try {
            $query = $this->dao->findByUser($user);
            return (isset($query->id));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}