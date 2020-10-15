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

        $mypendinglogistik = $this->pendingLogistik($user);
        $myprogresslogistik = $this->progressLogistik($user);
        $myfinishlogistik = $this->finishLogistik($user);

        $mypendingbuku = $this->pendingBuku($user);
        $myprogressbuku = $this->progressBuku($user);
        $myfinishbuku = $this->finishBuku($user);

        $mypendingsic = $this->pendingSic($user);
        $myprogresssic = $this->progressSic($user);
        $myfinishsic = $this->finishSic($user);

        if ($user->role_id == 1) {
            return view('admin.homeAdmin');
        } else if ($user->role_id == 2) {
            return view('apk.logistik.homeAPK');
        } else if ($user->role_id == 3) {
            return view('apk.pembukuan.homeAPK');
        } else if ($user->role_id == 4) {
            return view('apk.sic.homeAPK');
        } else if ($user->role_id == 5) {
            return view('nonapkhc.homeNonAPKHC', [
                'pendinglogistik' => $mypendinglogistik,
                'progresslogistik' => $myprogresslogistik,
                'finishedlogistik' => $myfinishlogistik,

                'pendingbuku' => $mypendingbuku,
                'progressbuku' => $myprogressbuku,
                'finishedbuku' => $myfinishbuku,

                'pendingsic' => $mypendingsic,
                'progresssic' => $myprogresssic,
                'finishedsic' => $myfinishsic,
            ]);
        } else if ($user->role_id == 6) {
            return view('nonapk.homeNonAPK', [
                'pendinglogistik' => $mypendinglogistik, 
                'progresslogistik' => $myprogresslogistik, 
                'finishedlogistik' => $myfinishlogistik,

                'pendingbuku' => $mypendingbuku, 
                'progressbuku' => $myprogressbuku, 
                'finishedbuku' => $myfinishbuku,

                'pendingsic' => $mypendingsic,
                'progresssic' => $myprogresssic,
                'finishedsic' => $myfinishsic,
                ]);
        }
    }

    public function pendingLogistik(User $user)
    {
        $month = date('m');

        //PENDING LOGISTIK
        $pendingAktiva = DB::table('aktivas')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $pendingATK = DB::table('kebutuhanapks')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $pendingCar = DB::table('orderkendaraans')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $pendingReimbursement = DB::table('orderreimbursements')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $pendingKiriman = DB::table('kirimans')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $arrayPending = [$pendingAktiva, $pendingATK, $pendingCar, $pendingReimbursement, $pendingKiriman];

        return $arrayPending;
    }

    public function progressLogistik(User $user)
    {
        $month = date('m');

        //IN PROGRESS LOGISTIK
        $progressAktiva = DB::table('aktivas')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $progressATK = DB::table('kebutuhanapks')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $progressCar = DB::table('orderkendaraans')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $progressReimbursement = DB::table('orderreimbursements')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $progressKiriman = DB::table('kirimans')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $arrayProgress = [$progressAktiva, $progressATK, $progressCar, $progressReimbursement, $progressKiriman];

        return $arrayProgress;
    }

    public function finishLogistik(User $user)
    {
        $month = date('m');

        //FINISHED LOGISTIK
        $finishedAktiva = DB::table('aktivas')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $finishedATK = DB::table('kebutuhanapks')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $finishedCar = DB::table('orderkendaraans')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $finishedReimbursement = DB::table('orderreimbursements')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $finishedKiriman = DB::table('kirimans')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $arrayFinished = [$finishedAktiva, $finishedATK, $finishedCar, $finishedReimbursement, $finishedKiriman];

        return $arrayFinished;
    }

    public function pendingBuku(User $user)
    {
        $month = date('m');

        //FINISHED LOGISTIK
        $pendingManual = DB::table('manuals')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $pendingAAK = DB::table('aaks')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();


        $arrayPending = [$pendingManual, $pendingAAK];

        return $arrayPending;
    }

    public function progressBuku(User $user)
    {
        $month = date('m');

        //FINISHED LOGISTIK
        $progressManual = DB::table('manuals')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $progressAAK = DB::table('aaks')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();


        $arrayProgress = [$progressManual, $progressAAK];

        return $arrayProgress;
    }

    public function finishBuku(User $user)
    {
        $month = date('m');

        //FINISHED LOGISTIK
        $finishManual = DB::table('manuals')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $finishAAK = DB::table('aaks')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();


        $arrayFinish = [$finishManual, $finishAAK];

        return $arrayFinish;
    }

    public function pendingSic(User $user)
    {
        $month = date('m');

        //PENDING SIC
        $pendingFixAplikasi = DB::table('orderfixaplikasi')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $pendingFixComputer = DB::table('orderfixcomputer')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $pendingFixHardware = DB::table('orderfixhardware')
                    ->where('status', '=', 'PENDING')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $arrayPending = [$pendingFixAplikasi, $pendingFixComputer, $pendingFixHardware];

        return $arrayPending;
    }

    public function progressSic(User $user)
    {
        $month = date('m');

        //IN PROGRESS SIC
        $progressFixAplikasi = DB::table('orderfixaplikasi')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $progressFixComputer = DB::table('orderfixcomputer')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $progressFixHardware = DB::table('orderfixhardware')
                    ->where('status', '=', 'IN PROGRESS')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $arrayProgress = [$progressFixAplikasi, $progressFixComputer, $progressFixHardware];

        return $arrayProgress;
    }

    public function finishSic(User $user)
    {
        $month = date('m');

        //FINISHED SIC
        $finishedFixAplikasi = DB::table('orderfixaplikasi')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $finishedFixComputer = DB::table('orderfixcomputer')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $finishedFixHardware = DB::table('orderfixhardware')
                    ->where('status', '=', 'FINISHED')
                    ->where('user_id', '=', $user->id)
                    ->whereMonth('orderDate', '=', $month)
                    ->count();

        $arrayFinished = [$finishedFixAplikasi, $finishedFixComputer, $finishedFixHardware];

        return $arrayFinished;
    }
}
