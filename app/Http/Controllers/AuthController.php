<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        if(!Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->back();
        }

        return redirect()->route('home');
    }

    public function getRegister(){
        $roles = DB::table('roles')->get();

        return view('admin.register', ['roles' => $roles]);
    }

    public function postRegister(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'password' => 'required|alpha_num|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role_id' => $request->role,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back();
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
