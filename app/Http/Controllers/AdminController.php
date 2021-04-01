<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct() {        
        $this->middleware('author', ['only' => ['create', 'store', 'edit', 'update']]);
    }

    public function index() {
        return view('admin.index');
    }

    public function showUsers() {
        $users = User::all();

        return view('admin.showUsers', compact('users'));
    }

    public function promote($id) {        
        $user = User::findOrFail($id);
        if($user->role_id >= 2) {
            $user->role_id -= 1;
            $user = $user->update();       
            return back();
        }  
        return back();             
    }
    
    public function demote($id) {        
        $user = User::findOrFail($id);
        if($user->role_id <= 2) {
            $user->role_id += 1;
            $user = $user->update();       
            return back();
        }  
        return back();             
    }

    
}
