<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetMyCounter extends Controller
{
    //
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
}
