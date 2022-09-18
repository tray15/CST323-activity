<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\UserModel;
use App\Services\Business\CrudService;
use App\Services\Business\SecurityService;

class LoginController extends Controller
{
    public function index(Request $request) {
        try {
            
            $this->validateForm($request);
            
            $service = new CrudService();
            $securityService = new SecurityService();
            
            $username = $request->input('username');
            $password = $request->input('password');

            $user = new UserModel($username, $password);
            $result = $securityService->login($user);
            
            if ($result) {
                $users = $service->listAllUsers();
                
                return view('allUsers')->with('users', $users);
            } else
                return view('loginFailed');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    private function validateForm(Request $request)
    {
        $rules = [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10'
        ];
        $this->validate($request, $rules);
    }
}
