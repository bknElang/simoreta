<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\OrderRequestJob;
use App\Models\Role;
use App\Models\User;
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
            ->join('roles', 'requestjobs.roles_to_id', '=', 'roles.id')
            ->select('requestjobs.*', 'roles.name AS rName')
            ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);
        
        return view('requestjob.myStatus', ['requestjobs' => $requestjobs, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();


        $requestjobs = DB::table('requestjobs')
            ->join('roles', 'requestjobs.roles_to_id', '=', 'roles.id')
            ->select('requestjobs.*', 'roles.name AS rName')
            ->where('user_id', '=', $currUser->id)
            ->whereBetween('orderDate', [$request->from, $request->to])
            ->orderByRaw('orderDate DESC')
            ->paginate(10);
        
        return view('requestjob.myStatus', ['requestjobs' => $requestjobs, 'layout' => $layout]);
    }

    public function authindex(){
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $requestjobs = DB::table('requestjobs')
                    ->join('users', 'requestjobs.user_id', '=', 'users.id')
                    ->select('requestjobs.*', 'users.name AS uName')
                    ->where('hc_id', '=', $currUser->id)
                    ->where('status', '=', 'Waiting for Approval')
                    ->orderByRaw('orderDate DESC')
                    ->paginate(10);

        return view('requestjob.auth', ['requestjobs' => $requestjobs, 'layout' => $layout]);
    }

    public function authsearch(Request $request){
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $requestjobs = DB::table('requestjobs')
                    ->join('users', 'requestjobs.user_id', '=', 'users.id')
                    ->select('requestjobs.*', 'users.name AS uName')
                    ->where('hc_id', '=', $currUser->id)
                    ->where('status', '=', 'Waiting for Approval')
                    ->whereBetween('orderDate', [$request->from, $request->to])
                    ->orderByRaw('orderDate DESC')
                    ->paginate(10);

        return view('requestjob.auth', ['requestjobs' => $requestjobs, 'layout' => $layout]);
    }

    public function todoindex(){
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $requestjobs = DB::table('requestjobs')
                    ->join('users', 'requestjobs.user_id', '=', 'users.id')
                    ->select('requestjobs.*', 'users.name AS uName')
                    ->where('requestjobs.status', '!=', 'Waiting for Approval')
                    ->where('requestjobs.status', '!=', 'REJECTED')
                    ->where('requestjobs.roles_to_id', '=', $currUser->role_id)
                    ->orderByRaw('orderDate DESC')
                    ->paginate(10);

        return view('requestjob.todo', ['requestjobs' => $requestjobs, 'layout' => $layout]);
    }

    public function todosearch(Request $request){
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $requestjobs = DB::table('requestjobs')
                    ->join('users', 'requestjobs.user_id', '=', 'users.id')
                    ->select('requestjobs.*', 'users.name AS uName')
                    ->where('requestjobs.status', '!=', 'Waiting for Approval')
                    ->where('requestjobs.status', '!=', 'REJECTED')
                    ->where('requestjobs.roles_to_id', '=', $currUser->role_id)
                    ->whereBetween('orderDate', [$request->from, $request->to])
                    ->orderByRaw('orderDate DESC')
                    ->paginate(10);

        return view('requestjob.todo', ['requestjobs' => $requestjobs, 'layout' => $layout]);
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

        $hcs = User::where('role_id', 5)->get();

        return view('requestjob.orderForm', ['layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'role' => $role, 'jenis' => $jenis, 'roles' => $roles, 'hcs' => $hcs]);
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
            'hc_id' => $request->hcname,
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
        $currUser = User::firstWhere('id', '=', $orderRequestJob->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();
        $roleto = Role::find($orderRequestJob->roles_to_id);
        $role = Role::find($currUser->role_id);

        return view('requestjob.showJob', ['layout' => $layout, 'currUser' => $currUser, 'orderRequestJob' => $orderRequestJob, 'roleto' => $roleto, 'role' => $role]);
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
        $currUser = User::firstWhere('id', '=', $orderRequestJob->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();
        $roleto = Role::find($orderRequestJob->roles_to_id);
        $role = Role::find($currUser->role_id);
        $roles = DB::table('roles')
                ->where(function ($query) {
                 $query ->where('id', 2)
                        ->orWhere('id', 3)
                        ->orWhere('id', 4);
                })
                ->get();

        return view('requestjob.editForm', ['layout' => $layout, 'currUser' => $currUser, 'orderRequestJob' => $orderRequestJob, 'roleto' => $roleto, 'role' => $role, 'roles' => $roles]);
    }

    public function authdetail(OrderRequestJob $orderRequestJob)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderRequestJob->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();
        $roleto = Role::find($orderRequestJob->roles_to_id);
        $role = Role::find($currUser->role_id);

        return view('requestjob.authDetail', ['layout' => $layout, 'currUser' => $currUser, 'orderRequestJob' => $orderRequestJob, 'roleto' => $roleto, 'role' => $role]);
    }

    public function approve(OrderRequestJob $orderRequestJob)
    {
        //
        OrderRequestJob::where('id', $orderRequestJob->id)
            ->update([
                'status' => 'PENDING'
            ]);

        return redirect()->back()->with('success', 'Order Approved');
    }

    public function reject(OrderRequestJob $orderRequestJob)
    {
        //
        OrderRequestJob::where('id', $orderRequestJob->id)
            ->update([
                'status' => 'REJECTED'
            ]);

        return redirect()->back()->with('success', 'Order Rejected');
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

        OrderRequestJob::where('id', $orderRequestJob->id)
            ->update([
                'status' => 'IN PROGRESS',
                'statusDetail' => $request->statusDetail
            ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(OrderRequestJob $orderRequestJob)
    {
        //
        OrderRequestJob::where('id', $orderRequestJob->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    public function change(Request $request, OrderRequestJob $orderRequestJob)
    {
        //
        OrderRequestJob::where('id', $orderRequestJob->id)
            ->update([
                'roles_to_id' => $request->unitAPK
            ]);

        return redirect('/todojob')->with('successChange', 'Assigned division changed for Job with ID '. $orderRequestJob->id.'!');
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
