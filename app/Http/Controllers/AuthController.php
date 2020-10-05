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
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->back()->with('error', 'Wrong email or password');
        }

        return redirect()->route('home');
    }

    public function getRegister(){
        $roles = DB::table('roles')->get();
        $cabangs = DB::table('cabangs')->get();

        return view('admin.register', ['roles' => $roles, 'cabangs' => $cabangs]);
    }

    public function postRegister(Request $request){
        $validatedData = $request->validate([
            'nip' => 'required|numeric',
            'nohp' => 'required|numeric',
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|alpha_num|confirmed'
        ]);

        User::create([
            'NIP' => $request->nip,
            'nohp' => $request->nohp,
            'name' => $request->name,
            'email' => $request->email,
            'cabang_id' => $request->cabang,
            'role_id' => $request->role,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with('registerSuccess','User Registered');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
