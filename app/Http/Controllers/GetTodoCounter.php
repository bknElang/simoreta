<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetTodoCounter extends Controller
{
    //LOGISTIK
    public function getPendingLogistik($month, $year)
    {
        $pendingAktiva = DB::table('aktivas')
            ->where('status', '=', 'PENDING')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $pendingATK = DB::table('kebutuhanapks')
            ->where('status', '=', 'PENDING')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('created_at', $year)
            ->count();

        $pendingCar = DB::table('orderkendaraans')
            ->where('status', '=', 'PENDING')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $pendingReimbursement = DB::table('orderreimbursements')
            ->where('status', '=', 'PENDING')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $pendingKiriman = DB::table('kirimans')
            ->where('status', '=', 'PENDING')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $arrayPending = [$pendingAktiva, $pendingATK, $pendingCar, $pendingReimbursement, $pendingKiriman];

        return $arrayPending;
    }
    public function getProgressLogistik($month, $year)
    {

        $progressAktiva = DB::table('aktivas')
            ->where('status', '=', 'IN PROGRESS')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $progressATK = DB::table('kebutuhanapks')
            ->where('status', '=', 'IN PROGRESS')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('created_at', $year)
            ->count();

        $progressCar = DB::table('orderkendaraans')
            ->where('status', '=', 'IN PROGRESS')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $progressReimbursement = DB::table('orderreimbursements')
            ->where('status', '=', 'IN PROGRESS')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $progressKiriman = DB::table('kirimans')
            ->where('status', '=', 'IN PROGRESS')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $arrayProgress = [$progressAktiva, $progressATK, $progressCar, $progressReimbursement, $progressKiriman];

        return $arrayProgress;
    }
    public function getFinishLogistik($month, $year)
    {
        $finishedAktiva = DB::table('aktivas')
            ->where('status', '=', 'FINISHED')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $finishedATK = DB::table('kebutuhanapks')
            ->where('status', '=', 'FINISHED')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('created_at', $year)
            ->count();

        $finishedCar = DB::table('orderkendaraans')
            ->where('status', '=', 'FINISHED')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $finishedReimbursement = DB::table('orderreimbursements')
            ->where('status', '=', 'FINISHED')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $finishedKiriman = DB::table('kirimans')
            ->where('status', '=', 'FINISHED')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $arrayFinished = [$finishedAktiva, $finishedATK, $finishedCar, $finishedReimbursement, $finishedKiriman];

        return $arrayFinished;
    }


    //PEMBUKUAN
    public function getPendingBuku($month, $year)
    {
        $month = date('m');

        $pendingManual = DB::table('manuals')
            ->where('status', '=', 'PENDING')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $pendingAAK = DB::table('aaks')
            ->where('status', '=', 'PENDING')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();


        $arrayPending = [$pendingManual, $pendingAAK];

        return $arrayPending;
    }

    public function getProgressBuku($month, $year)
    {
        $month = date('m');

        $progressManual = DB::table('manuals')
            ->where('status', '=', 'IN PROGRESS')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $progressAAK = DB::table('aaks')
            ->where('status', '=', 'IN PROGRESS')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $arrayProgress = [$progressManual, $progressAAK];

        return $arrayProgress;
    }

    public function getFinishBuku($month, $year)
    {
        $month = date('m');

        $finishManual = DB::table('manuals')
            ->where('status', '=', 'FINISHED')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();

        $finishAAK = DB::table('aaks')
            ->where('status', '=', 'FINISHED')
            ->whereMonth('orderDate', '=', $month)
            ->whereYear('orderDate', $year)
            ->count();


        $arrayFinish = [$finishManual, $finishAAK];

        return $arrayFinish;
    }
}
