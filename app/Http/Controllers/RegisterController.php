<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\Business\CrudService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function createUser()
    {
        return view('register');
    }
    
    public function saveUser(Request $request)
    {
        $service = new CrudService();
        $username = $request->get("username");
        $password = $request->get('password');
        
        $this->validateForm($request);
        
        $user = new UserModel($username, $password);
        if ($service->create($user)) {
            return view('login');
        } else {
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