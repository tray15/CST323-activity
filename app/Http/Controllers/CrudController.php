<?php

namespace App\Http\Controllers;

use App\Models\UserUpdateModel;
use App\Services\Business\CrudService;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    
    public function index()
    {
        $service = new CrudService();
        $users = $service->listAllUsers();

        return view('allUsers')->with('users', $users);
    }
    
    public function delete($id)
    {
        $service = new CrudService();
        
        $service->deleteUser($id);
        return redirect('allUsers');
    }
    
    public function doUserUpdate(Request $request, $id) {
        $username = $request->input('username');
        
        $user = new UserUpdateModel($id, $username);
        
        $service = new CrudService();
        $service->modifyUser($user);
        return redirect('allUsers');
    }
    
    public function edit($id) {
        $service = new CrudService();
        $user = $service->canEditUser($id);
        if (isset($user)) {
            return view('userEdit')->with('user', $user);
        }
        return redirect('index');
    }
}
