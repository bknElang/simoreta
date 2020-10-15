<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporansController extends Controller
{
    //
    public function getPage(Request $request){
        $pcontroller = new PagesController();
        $layout = $pcontroller->getLayout();
        $month = date('m');
        $year = date('Y');

        $currUser = Auth::user();

        $getTodoCounter = new GetTodoCounter;

        if($currUser->role_id == 2){
            $todopendinglogistik = $getTodoCounter->getPendingLogistik($month, $year);
            $todoprogresslogistik = $getTodoCounter->getProgressLogistik($month, $year);
            $todofinishlogistik = $getTodoCounter->getFinishLogistik($month, $year);

            return view('apk.logistik.laporan', [
                'layout' => $layout,

                'pendinglogistik' => $todopendinglogistik,
                'progresslogistik' => $todoprogresslogistik,
                'finishedlogistik' => $todofinishlogistik, 
                
                'month' => 'this month']);
        }

        if($currUser->role_id == 3){
            $todopendingbuku = $getTodoCounter->getPendingBuku($month, $year);
            $todoprogressbuku = $getTodoCounter->getProgressBuku($month, $year);
            $todofinishbuku = $getTodoCounter->getFinishBuku($month, $year);

            return view('apk.pembukuan.laporan', [
                'layout' => $layout,

                'pendingbuku' => $todopendingbuku,
                'progressbuku' => $todoprogressbuku,
                'finishedbuku' => $todofinishbuku, 

                'month' => 'this month'
            ]);
        }

        if($currUser->role_id == 4) return view('apk.sic.laporan', ['layout' => $layout, 'month' => 'this month']);
    }

    public function search(Request $request){
        $pcontroller = new PagesController();
        $layout = $pcontroller->getLayout();

        if(empty($request->month)){
            $month = date('m');
            $year = date('Y');
            $output = "this month";
        }else{
            $month = substr($request->month, 5, 2);
            $year = substr($request->month, 0, 4);
            $output = $year . '-' . $month;
        }

        $currUser = Auth::user();

        $getTodoCounter = new GetTodoCounter;

        if($currUser->role_id == 2){
            $todopendinglogistik = $getTodoCounter->getPendingLogistik($month, $year);
            $todoprogresslogistik = $getTodoCounter->getProgressLogistik($month, $year);
            $todofinishlogistik = $getTodoCounter->getFinishLogistik($month, $year);

            return view('apk.logistik.laporan', [
                        'layout' => $layout, 

                        'pendinglogistik' => $todopendinglogistik, 
                        'progresslogistik' => $todoprogresslogistik, 
                        'finishedlogistik' => $todofinishlogistik, 

                        'month' => $output
                    ]);
        }

        if($currUser->role_id == 3){
            $todopendingbuku = $getTodoCounter->getPendingBuku($month, $year);
            $todoprogressbuku = $getTodoCounter->getProgressBuku($month, $year);
            $todofinishbuku = $getTodoCounter->getFinishBuku($month, $year);
            
            return view('apk.pembukuan.laporan', [
                        'layout' => $layout,

                        'pendingbuku' => $todopendingbuku,
                        'progressbuku' => $todoprogressbuku,
                        'finishedbuku' => $todofinishbuku,

                        'month' => $output
                    ]);
        }

        if($currUser->role_id == 4) return view('apk.sic.laporan', ['layout' => $layout]);
    }

}
