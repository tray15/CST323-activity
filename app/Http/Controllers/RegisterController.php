<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\Business\CrudService;
use Illuminate\Http\Request;
use App\Services\Utility\MyLogger2;

class RegisterController extends Controller
{
    public function createUser()
    {
        return view('register');
    }
    
    public function saveUser(Request $request)
    {
        $logger = new MyLogger2();
        
        $logger->info("Entering RegisterController::saveUser()");
        
        $service = new CrudService();
        $username = $request->get("username");
        $password = $request->get('password');
        
        $logger->info("Attempting RegisterController::saveUser() with parameters:", array(
            "username" => $username,
            "password" => $password
        ));
        
        $this->validateForm($request);
        
        $user = new UserModel($username, $password);
        if ($service->create($user)) {
            $logger->info("RegisterController::saveUser() successful");
            return view('login');
        } else {
            $logger->info("RegisterController::saveUser() failed");
            return view('registerFailed');
        }
    }
    
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10'
        ];
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}