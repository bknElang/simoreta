<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function getLayout()
    {
        $currUser = Auth::user();

        if ($currUser->role_id == 1) {
            $layout = 'layouts.admin.app';
        } elseif ($currUser->role_id == 2) {
            $layout = 'layouts.logistik.app';
        } elseif ($currUser->role_id == 3) {
            $layout = 'layouts.pembukuan.app';
        } elseif ($currUser->role_id == 4) {
            $layout = 'layouts.sic.app';
        } elseif ($currUser->role_id == 5) {
            $layout = 'layouts.nonapkhc.app';
        } elseif ($currUser->role_id == 6) {
            $layout = 'layouts.nonapk.app';
        }

        return $layout;
    }

    public function Home()
    {
        $user = Auth::user();

        $getMyCounter = new GetMyCounter;

        $mypendinglogistik = $getMyCounter->pendingLogistik($user);
        $myprogresslogistik = $getMyCounter->progressLogistik($user);
        $myfinishlogistik = $getMyCounter->finishLogistik($user);

        $mypendingbuku = $getMyCounter->pendingBuku($user);
        $myprogressbuku = $getMyCounter->progressBuku($user);
        $myfinishbuku = $getMyCounter->finishBuku($user);

        if ($user->role_id == 1) {
            return view('admin.homeAdmin');

        } else if ($user->role_id == 2) {
            return view('apk.logistik.homeAPK', [
                'pendingbuku' => $mypendingbuku,
                'progressbuku' => $myprogressbuku,
                'finishedbuku' => $myfinishbuku
            ]);

        } else if ($user->role_id == 3) {
            return view('apk.pembukuan.homeAPK', [
                'pendinglogistik' => $mypendinglogistik,
                'progresslogistik' => $myprogresslogistik,
                'finishedlogistik' => $myfinishlogistik,
            ]);

        } else if ($user->role_id == 4) {
            return view('apk.sic.homeAPK', [
                'pendinglogistik' => $mypendinglogistik,
                'progresslogistik' => $myprogresslogistik,
                'finishedlogistik' => $myfinishlogistik,

                'pendingbuku' => $mypendingbuku,
                'progressbuku' => $myprogressbuku,
                'finishedbuku' => $myfinishbuku
            ]);
        } else if ($user->role_id == 5) {
            return view('nonapkhc.homeNonAPKHC', [
                'pendinglogistik' => $mypendinglogistik,
                'progresslogistik' => $myprogresslogistik,
                'finishedlogistik' => $myfinishlogistik,

                'pendingbuku' => $mypendingbuku,
                'progressbuku' => $myprogressbuku,
                'finishedbuku' => $myfinishbuku
            ]);
        } else if ($user->role_id == 6) {
            return view('nonapk.homeNonAPK', [
                'pendinglogistik' => $mypendinglogistik, 
                'progresslogistik' => $myprogresslogistik, 
                'finishedlogistik' => $myfinishlogistik,

                'pendingbuku' => $mypendingbuku, 
                'progressbuku' => $myprogressbuku, 
                'finishedbuku' => $myfinishbuku
                ]);
        }
    }


}
