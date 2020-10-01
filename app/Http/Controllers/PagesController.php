<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function getLayout(){
        $currUser = Auth::user();

        if ($currUser->role_id == 1){
            $layout = 'layouts.admin.app';
        } elseif ($currUser->role_id == 2) {
            $layout = 'layouts.logistik.app';
        } elseif ($currUser->role_id == 3) {
            $layout = 'layouts.pembukuan.app';
        } elseif ($currUser->role_id == 4) {
            $layout = 'layouts.sic.app';
        } else {
            $layout = 'layouts.nonapk.app';
        }

        return $layout;
    }

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
            return view('nonapk.homeNonAPK');
        }
    }

    public function myorder(){
        $layout = $this->getLayout();
        $currUser = Auth::user();
        return view('user.myStatus', ['layout' => $layout, 'currUser' => $currUser]);
    }

    public function todolist(){
        $layout = $this->getLayout();
        $currUser = Auth::user();
        return view('user.todo', ['layout' => $layout, 'currUser' => $currUser]);
    }

}
