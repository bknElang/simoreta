<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\OrderRequestJob;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRequestJobsController extends Controller
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
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $requestjobs = DB::table('requestjobs')
        ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);
        
        return view('requestjob.myStatus', ['requestjobs' => $requestjobs, 'layout' => $layout]);
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

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        $roles = DB::table('roles')->get();

        $jenis = DB::table('jenisreimbursements')->get();

        return view('requestjob.orderForm', ['layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'role' => $role, 'jenis' => $jenis, 'roles' => $roles]);
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
            'jenis' => 'required',
            'keterangan' => 'required'
        ]);

        OrderRequestJob::create([
            'user_id' => $currUser->id,
            'roles_to_id' => $request->unitAPK,
            'jenis' => $request->jenis,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('successOrder', 'Order Successfull!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderRequestJob  $orderRequestJob
     * @return \Illuminate\Http\Response
     */
    public function show(OrderRequestJob $orderRequestJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderRequestJob  $orderRequestJob
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderRequestJob $orderRequestJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderRequestJob  $orderRequestJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderRequestJob $orderRequestJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderRequestJob  $orderRequestJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderRequestJob $orderRequestJob)
    {
        //
    }
}
