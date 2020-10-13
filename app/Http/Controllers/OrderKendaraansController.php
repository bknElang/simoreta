<?php

namespace App\Http\Controllers;

use App\Models\AssignKendaraan;
use App\Models\OrderKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderKendaraansController extends Controller
{   
    public PagesController $pageController;

    public function myindex(){

        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderkendaraans = DB::table('orderkendaraans')
                            ->where('user_id', '=', $currUser->id)
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('kendaraan.myStatus', ['orderkendaraans' => $orderkendaraans, 'layout' => $layout]);
    }

    public function mysearch(Request $request){

        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderkendaraans = DB::table('orderkendaraans')
                            ->where('user_id', '=', $currUser->id)
                            ->whereBetween('orderDate', [$request->from, $request->to])
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('kendaraan.myStatus', ['orderkendaraans' => $orderkendaraans, 'layout' => $layout]);
    }

    public function todoindex(){
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderkendaraans = DB::table('orderkendaraans')
                            ->join('users', 'orderkendaraans.user_id', '=', 'users.id')
                            ->select('orderkendaraans.*', 'users.name AS uName')
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('kendaraan.todo', ['orderkendaraans' => $orderkendaraans, 'layout' => $layout]);
    }

    public function searchtodo(Request $request){
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderkendaraans = DB::table('orderkendaraans')
                            ->join('users', 'orderkendaraans.user_id', '=', 'users.id')
                            ->select('orderkendaraans.*', 'users.name AS uName')
                            ->whereBetween('orderDate', [$request->from, $request->to])
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('kendaraan.todo', ['orderkendaraans' => $orderkendaraans, 'layout' => $layout]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('kendaraan.orderForm', ['layout' => $layout, 'currUser' => $currUser]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $currUser = Auth::user();

        $validatedData = $request->validate([
            'pickuplocation' => 'required',
            'destination' => 'required',
            'jumlah' => 'required'
        ]);

        OrderKendaraan::create([
            'user_id' => $currUser->id,
            'useDatetime' => $request->dateofuse,
            'finishDatetime' => $request->datefinished,
            'pickupAddress' => $request->pickuplocation,
            'destinationAddress' => $request->destination,
            'necessity' => $request->needs,
            'totalPassanger' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('successOrder', 'Order Successfull!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderKendaraan  $orderKendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(OrderKendaraan $orderKendaraan)
    {
        //
        $currUser = Auth::user();

        $assign = AssignKendaraan::find($orderKendaraan->assign_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('kendaraan.showKendaraan', ['orderkendaraan' => $orderKendaraan, 'layout' => $layout, 'currUser' => $currUser, 'assign' => $assign]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderKendaraan  $orderKendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderKendaraan $orderKendaraan)
    {
        //
        $currUser = Auth::user();

        $assign = AssignKendaraan::find($orderKendaraan->assign_id);
        
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('kendaraan.assignKendaraan', ['orderkendaraan' => $orderKendaraan, 'layout' => $layout, 'currUser' => $currUser, 'assignKendaraan' => $assign]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderKendaraan  $orderKendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderKendaraan $orderKendaraan)
    {
        //
        OrderKendaraan::where('id', $orderKendaraan->id)
            ->update([
                'keterangan' => $request->keterangan
            ]);

        return redirect()->back()->with('successNote', 'Notes Updated!');
    }

    public function finish(OrderKendaraan $orderKendaraan)
    {
        //
        OrderKendaraan::where('id', $orderKendaraan->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('successFinish', 'Order Finished!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderKendaraan  $orderKendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderKendaraan $orderKendaraan)
    {
        //
    }
}
