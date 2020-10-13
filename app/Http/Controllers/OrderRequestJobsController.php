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

    public function todoindex(){
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $requestjobs = DB::table('requestjobs')
                    ->join('users', 'requestjobs.user_id', '=', 'users.id')
                    ->select('requestjobs.*', 'users.name AS uName')
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
        $currUser = Auth::user();

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
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();
        $roleto = Role::find($orderRequestJob->roles_to_id);
        $role = Role::find($currUser->role_id);

        return view('requestjob.editForm', ['layout' => $layout, 'currUser' => $currUser, 'orderRequestJob' => $orderRequestJob, 'roleto' => $roleto, 'role' => $role]);
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
