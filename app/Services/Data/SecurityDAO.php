<?php
namespace App\Services\Data;

use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Exception;

class SecurityDAO
{
    
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
    
    //create user
    public function save(UserModel $user)
    {
        $response = DB::table('users')->insert([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
        ]);
        return $response;
    }
    
    //read users and put in array to list
    public function list($filter = []) {
        return DB::table('users')->where($filter)->get();
    }
    
    //update user
    public function update($id, $input) {
        DB::table('users')->wher('id', $id)->update($input);
        
        return $this->getUser($id);
    }
    
    //delete user
    public function delete($id) {
        return DB::table('users')->where('id', $id)->delete();
    }
}

