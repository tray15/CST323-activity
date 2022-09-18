<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\UserModel;
use App\Services\Business\CrudService;
use App\Services\Business\SecurityService;
use App\Services\Utility\MyLogger2;

class LoginController extends Controller
{
    public function index(Request $request) {
        $logger = new MyLogger2();
        try {
            $logger->info("Entering LoginController::index()");
            
            $this->validateForm($request);
            
            $service = new CrudService();
            $securityService = new SecurityService();
            
            $username = $request->input('username');
            $password = $request->input('password');
            
            $logger->info("User parameters are:", array(
                "username" => $username,
                "password" => $password
            ));

            $user = new UserModel($username, $password);
            $result = $securityService->login($user);
            
            if ($result) {
                $logger->info("Exiting LoginController()::index()");
                
                $users = $service->listAllUsers();
                
                return view('allUsers')->with('users', $users);
            } else
                $logger->info("Exiting LoginController()::index() with failure");
                
                return view('loginFailed');
        } catch (Exception $e) {
            $logger->error("Exception LoginController::index()" . $e->getMessage());
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
