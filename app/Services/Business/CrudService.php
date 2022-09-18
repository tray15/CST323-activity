<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Models\UserUpdateModel;
use App\Services\Data\CrudDAO;
use Illuminate\Support\Facades\DB;
use Exception;

class CrudService
{
    private $dao;
    
    function __construct() {
        $this->dao = new CrudDAO();
    }
    
    public function listAllUsers() {
        $users = $this->dao->list();
        return $users;
    }
    public function findByUser(UserModel $user)
    {
        try {
            $response = DB::table('users')->where('username', $user->getUsername())
            ->where('password', $user->getPassword())
            ->first();
            return $response;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function create(UserModel $user)
    {
        if ($this->dao->findByUser($user)) {
            return view('registerFailed');
        } else {
            return $this->dao->save($user);
        }
    }
    public function canEditUser($id) {
        $user = $this->dao->getUser($id);
        if ($user == false) {
            return null;
        }
        return $user;
    }
    
    public function deleteUser($id)
    {
        $result = $this->dao->delete($id);
        return $result;
    }
    
    public function modifyUser(UserUpdateModel $user)
    {
        $exists = $this->dao->getUser($user->getId());
        $un = $user->getUsername();
        
        if (!($exists->username == $un)) {
            $result = $this->dao->update($user->getId(), [
                'username' => $user->getUsername(),
            ]);
            return $result;
        }
        return true;
    }
}
