<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function Home(){
        $user = Auth::user();

        if($user->role_id == 1){
            return view('admin.homeAdmin');
        }else if($user->role_id == 2){
            return view('apk.logistik.homeAPK');
        }else if($user->role_id == 3){
            return view('apk.pembukuan.homeAPK');
        }else if($user->role_id == 4){
            return view('apk.sic.homeAPK');
        }else if($user->role_id == 5){
            return view('homeNonAPK');
        }
    }
}
