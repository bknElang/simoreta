<?php

namespace App\Http\Controllers;

use App\Models\AtkDetail;
use App\Models\OrderATK;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderATKsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function myindex()
    {
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderatk = DB::table('kebutuhanapks')
            ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('kebutuhanAPK.myStatus', ['orderatks' => $orderatk, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderatk = DB::table('kebutuhanapks')
                    ->where('user_id', '=', $currUser->id)
                    ->whereBetween('orderDate', [$request->from, $request->to])
                    ->orderByRaw('orderDate DESC')
                    ->paginate(10);

        return view('kebutuhanAPK.myStatus', ['orderatks' => $orderatk, 'layout' => $layout]);
    }

    public function authindex(){
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderatks = DB::table('kebutuhanapks')
                        ->join('users', 'kebutuhanapks.user_id', '=', 'users.id')
                        ->select('kebutuhanapks.*', 'users.name AS uName')
                        ->where('hc_id', '=', $currUser->id)
                        ->where('kebutuhanapks.status', '=', 'Waiting for Approval')
                        ->orderByRaw('orderDate DESC')
                        ->paginate(10);

        return view('kebutuhanAPK.auth', ['orderatks' => $orderatks, 'layout' => $layout]);
    }

    public function authsearch(Request $request){
        $currUser = Auth::user();

        
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderatks = DB::table('kebutuhanapks')
                        ->join('users', 'kebutuhanapks.user_id', '=', 'users.id')
                        ->select('kebutuhanapks.*', 'users.name AS uName')
                        ->where('kebutuhanapks.hc_id', '=', $currUser->id)
                        ->where('kebutuhanapks.status', '=', 'Waiting for Approval')
                        ->whereBetween('orderDate', [$request->from, $request->to])
                        ->orderByRaw('orderDate DESC')
                        ->paginate(10);

        return view('kebutuhanAPK.auth', ['orderatks' => $orderatks, 'layout' => $layout]);
    }

    public function todoindex(){
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderatks = DB::table('kebutuhanapks')
                        ->join('users', 'kebutuhanapks.user_id', '=', 'users.id')
                        ->select('kebutuhanapks.*', 'users.name AS uName')
                        ->orderByRaw('orderDate DESC')
                        ->paginate(10);

        return view('kebutuhanAPK.todo', ['orderatks' => $orderatks, 'layout' => $layout]);
    }

    public function todosearch(Request $request){
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderatks = DB::table('kebutuhanapks')
                        ->join('users', 'kebutuhanapks.user_id', '=', 'users.id')
                        ->select('kebutuhanapks.*', 'users.name AS uName')
                        -> whereBetween('orderDate', [$request->from, $request->to])
                        ->orderByRaw('orderDate DESC')
                        ->paginate(10);

        return view('kebutuhanAPK.todo', ['orderatks' => $orderatks, 'layout' => $layout]);
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

        $hcs = User::where('role_id', 5)->get();

        return view('kebutuhanAPK.orderForm', ['layout' => $layout, 'currUser' =>$currUser, 'hcs' => $hcs]);
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
            'keterangan' => 'required',
        ]);

        $orderATK = OrderATK::create([
            'user_id' => $currUser->id,
            'keterangan' => $request->keterangan,
            'hc_id' => $request->hcname,
        ]);

        $orderID = $orderATK->id;

        foreach ($request->nama as $key => $value) {
            AtkDetail::create([
                'atk_id' => $orderID,
                'name' => $request->nama[$key],
                'jumlah' => $request->jumlah[$key],
                'spesifikasi' => $request->spesifikasi[$key],
            ]);
        }

        return redirect()->back()->with('successOrder', 'Order Success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderATK  $orderATK
     * @return \Illuminate\Http\Response
     */
    public function show(OrderATK $orderATK)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderATK->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $detailatks = DB::table('atkdetails')
            ->where('atk_id', '=', $orderATK->id)
            ->get();

        return view('kebutuhanAPK.showAPK', ['layout' => $layout, 'currUser' => $currUser, 'orderatk' => $orderATK, 'detailatks' => $detailatks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderATK  $orderATK
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderATK $orderATK)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderATK->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $detailatks = DB::table('atkdetails')
            ->where('atk_id', '=', $orderATK->id)
            ->get();

        return view('kebutuhanAPK.editForm', ['layout' => $layout, 'currUser' => $currUser, 'orderatk' => $orderATK, 'detailatks' => $detailatks]);
    }

    public function authdetail(OrderATK $orderATK)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderATK->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $detailatks = DB::table('atkdetails')
                    ->where('atk_id', '=', $orderATK->id)
                    ->get();

        return view('kebutuhanAPK.authDetail', ['layout' => $layout, 'currUser' => $currUser, 'orderatk' =>$orderATK, 'detailatks' => $detailatks]);
    }

    public function approve(OrderATK $orderATK)
    {
        //
        OrderATK::where('id', $orderATK->id)
            ->update([
                'status' => 'PENDING'
            ]);

        return redirect()->back()->with('success', 'Order Approved');
    }

    public function reject(OrderATK $orderATK)
    {
        //
        OrderATK::where('id', $orderATK->id)
            ->update([
                'status' => 'REJECTED'
            ]);

        return redirect()->back()->with('success', 'Order Rejected');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderATK  $orderATK
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderATK $orderATK)
    {
        //
        OrderATK::where('id', $orderATK->id)
            ->update([
                'status' => 'IN PROGRESS',
                'statusDetail' => $request->statusDetail
            ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(OrderATK $orderATK)
    {
        //
        OrderATK::where('id', $orderATK->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderATK  $orderATK
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderATK $orderATK)
    {
        //
    }
}