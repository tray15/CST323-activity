<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;
use Exception;
use App\Services\Utility\MyLogger;

class SecurityService
{
    private $dao;
    private $logger;
    
    function __construct() {
        $this->dao = new SecurityDAO();
        $this->logger = new MyLogger();
    }
    public function login(UserModel $user)
    {
        $this->logger->info("Entering SecurityService::login()");
        try {
            $query = $this->dao->findByUser($user);
            return (isset($query->id));
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $this->logger->info("Exiting SecurityService::login()");
    }
}