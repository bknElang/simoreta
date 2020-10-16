<?php

namespace App\Http\Controllers;

use App\Models\ResetRequest;
use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        if(Auth::attempt(['NIP' => $request->nip, 'password' => $request->password])){
            $current = new Datetime();
            if($request->nip != 'superadmin'){
                $user = Auth::user();
                $lastLog = new Datetime($user->lastLogin);
                $interval = $lastLog->diff($current);

                if ($interval->days > 13) {
                    Auth::logout();
                    return redirect()->back()->with('error', 'User inactive');
                }

                $lastPass= new Datetime($user->lastChangedPassword);
                $intervalpassword = $lastPass->diff($current);

                if ($intervalpassword->days > 27){
                    return redirect()->route('changepassword', ['user' => $user->id]);
                }
            }
           
            User::where('NIP', $request->nip)
                ->update([
                'lastLogin' => $current
                ]);
            
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Wrong NIP or password');
    }

    public function getRegister(){
        $roles = DB::table('roles')->get();
        $cabangs = DB::table('cabangs')->get();

        return view('admin.register', ['roles' => $roles, 'cabangs' => $cabangs]);
    }

    public function postRegister(Request $request){
        $validatedData = $request->validate([
            'nip' => 'required',
            'nohp' => 'required|numeric',
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
        ]);

        $password = time();

        User::create([
            'NIP' => $request->nip,
            'nohp' => $request->nohp,
            'name' => $request->name,
            'email' => $request->email,
            'cabang_id' => $request->cabang,
            'role_id' => $request->role,
            'password' => bcrypt($password)
        ]);

        return redirect()->back()->with('registerSuccess','User Registered. Password: '. $password);
    }

    public function getReset(){
        return view('forgotPassword');
    }

    public function postReset(Request $request){
        $validatedData = $request->validate([
            'nip' => 'exists:users,nip',
            'niphc' => 'exists:users,nip'
        ]);

        $user = User::firstWhere('NIP', '=', $request->nip);
        $userhc = User::firstWhere('NIP', '=', $request->niphc);
    
        ResetRequest::create([
            'user_id' => $user->id,
            'hc_id' => $userhc->id,
            'status' => 'Waiting for Approval'
        ]);

        return redirect()->back()->with('success', 'Reset Requested!');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

    public function viewResetAdmin(){
        $resets = DB::table('resetrequests')
            ->join('users', 'resetrequests.user_id', '=', 'users.id')
            ->select('resetrequests.id AS resetID', 'users.*')
            ->where('resetrequests.status', '=', 'PENDING')
            ->paginate(10);

        return view('admin.viewForgot', ['resets' => $resets]);
    }

    public function viewResetHC(){
        $resets = DB::table('resetrequests')
            ->join('users', 'resetrequests.user_id', '=', 'users.id')
            ->select('resetrequests.id AS resetID', 'users.*')
            ->where('resetrequests.status', '=', 'Waiting for Approval')
            ->paginate(10);

        return view('nonapkhc.viewForgot', ['resets' => $resets]);
    }

    public function approve(ResetRequest $resetRequest){
        ResetRequest::where('id', $resetRequest->id)
            ->update([
                'status' => 'PENDING',
            ]);

        return redirect()->back()->with('success', 'Password reset request approved');
        
    }
}
