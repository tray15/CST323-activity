<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Models\UserUpdateModel;
use App\Services\Data\CrudDAO;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Services\Utility\MyLogger;

class CrudService
{
    private $dao;
    private $logger;
    
    function __construct() {
        $this->dao = new CrudDAO();
        $this->logger = new MyLogger();
    }
    
    public function listAllUsers() {
        $this->logger->info("Calling CrudService::listAllUsers()");
        $users = $this->dao->list();
        $this->logger->info("Exiting CrudService::listAllUsers()");
        return $users;
    }
    public function findByUser(UserModel $user)
    {
        $this->logger->info("Calling CrudService::findByUser()");
        try {
            $response = DB::table('users')->where('username', $user->getUsername())
            ->where('password', $user->getPassword())
            ->first();
            return $response;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $this->logger->info("Exiting CrudService::findByUser()");
    }
    
    public function create(UserModel $user)
    {
        $this->logger->info("Calling CrudService::create()");
        if ($this->dao->findByUser($user)) {
            return view('registerFailed');
        } else {
            return $this->dao->save($user);
        }
        $this->logger->info("Exiting CrudService::create()");
    }
    public function canEditUser($id) {
        $this->logger->info("Calling CrudService::canEditUser()");
        $user = $this->dao->getUser($id);
        if ($user == false) {
            return null;
        }
        $this->logger->info("Exiting CrudService::canEditUser()");
        return $user;
    }
    
    public function deleteUser($id)
    {
        $this->logger->info("Calling CrudService::deleteUser()");
        $result = $this->dao->delete($id);
        $this->logger->info("Exiting CrudService::deleteUser()");
        return $result;
    }
    
    public function modifyUser(UserUpdateModel $user)
    {
        $this->logger->info("Calling CrudService::modifyUser()");
        $exists = $this->dao->getUser($user->getId());
        $un = $user->getUsername();
        
        if (!($exists->username == $un)) {
            $this->logger->info("CrudService::modifyUser() updating user credentials");
            $result = $this->dao->update($user->getId(), [
                'username' => $user->getUsername(),
            ]);
            return $result;
        }
        $this->logger->info("Exiting CrudService::modifyUser()");
        return true;
    }
}
