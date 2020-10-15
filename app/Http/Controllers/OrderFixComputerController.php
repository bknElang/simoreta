<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\JenisKomponenComputer;
use App\Models\OrderFixComputer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderFixComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myindex()
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixcomputer = DB::table('orderfixcomputer')
            ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixcomputer.myStatus', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixcomputer = DB::table('orderfixcomputer')
            ->where('user_id', '=', $currUser->id)
            ->whereBetween('orderDate', [$request->from, $request->to])
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixcomputer.myStatus', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout]);
    }

    public function authindex()
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixcomputer = DB::table('orderfixcomputer')
                            ->join('users', 'orderfixcomputer.user_id', '=', 'users.id')
                            ->select('orderfixcomputer.*', 'users.name AS uName')
                            ->where('hc_id', '=', $currUser->id)
                            ->where('status', '=', 'Waiting for Approval')
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('fixcomputer.auth', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout]);
    }

    public function authsearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderreimbursements = DB::table('orderfixcomputer')
                            ->join('users', 'orderfixcomputer.user_id', '=', 'users.id')
                            ->select('orderfixcomputer.*', 'users.name AS uName')
                            ->where('hc_id', '=', $currUser->id)
                            ->where('status', '=', 'Waiting for Approval')
                            ->whereBetween('orderDate', [$request->from, $request->to])
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('fixcomputer.auth', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout]);
    }

    public function todoindex()
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderreimbursements = DB::table('orderfixcomputer')
            ->join('users', 'orderfixcomputer.user_id', '=', 'users.id')
            ->select('orderfixcomputer.*', 'users.name AS uName')
            ->where('orderfixcomputer.status', '!=', 'Waiting for Approval')
            ->where('orderfixcomputer.status', '!=', 'REJECTED')
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixcomputer.todo', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout]);
    }

    public function todosearch(Request $request)
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderreimbursements = DB::table('orderfixcomputer')
            ->join('users', 'orderfixcomputer.user_id', '=', 'users.id')
            ->select('orderfixcomputer.*', 'users.name AS uName')
            ->where('orderfixcomputer.status', '!=', 'Waiting for Approval')
            ->where('orderfixcomputer.status', '!=', 'REJECTED')
            ->whereBetween('orderDate', [$request->from, $request->to])
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixcomputer.todo', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout]);
    }

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

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        $jenis = DB::table('jeniskomponencomputer')->get();

        $hcs = User::where('role_id', 5)->get();

        return view('fixcomputer.orderForm', ['layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'role' => $role, 'jenis' => $jenis, 'hcs' => $hcs]);
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
            'jenis' => 'required'
        ]);

        OrderFixComputer::create([
            'user_id' => $currUser->id,
            'keterangan' => $request->keterangan,
            'jenis_id' => $request->jenis,
            'hc_id' => $request->hcname
        ]);

        return redirect()->back()->with('successOrder', 'Order Successfull!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderFixComputer  $orderfixcomputer
     * @return \Illuminate\Http\Response
     */
    public function show(OrderFixComputer $orderfixcomputer)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderfixcomputer->user_id);

        $jenis = JenisKomponenKomputer::find($orderfixcomputer->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('fixcomputer.showFixComputer', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout, 'currUser' => $currUser, 'jenis' => $jenis, 'cabang' => $cabang, 'role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderFixComputer  $orderfixcomputer
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderFixComputer $orderfixcomputer)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderfixcomputer->user_id);

        $jenis = JenisKomponenKomputer::find($orderfixcomputer->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('fixcomputer.editForm', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'jenis' => $jenis, 'role' => $role]);
    }

    public function authdetail(OrderFixComputer $orderfixcomputer)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderfixcomputer->user_id);

        $jenis = JenisKomponenKomputer::find($orderfixcomputer->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('fixcomputer.authDetail', ['orderfixcomputer' => $orderfixcomputer, 'layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'jenis' => $jenis, 'role' => $role]);
    }

    public function approve(OrderFixComputer $orderfixcomputer)
    {
        //
        OrderFixComputer::where('id', $orderfixcomputer->id)
            ->update([
                'status' => 'PENDING'
            ]);

        return redirect()->back()->with('success', 'Order Approved');
    }

    public function reject(OrderFixComputer $orderfixcomputer)
    {
        //
        OrderFixComputer::where('id', $orderfixcomputer->id)
            ->update([
                'status' => 'REJECTED'
            ]);

        return redirect()->back()->with('success', 'Order Rejected');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderFixComputer  $orderfixcomputer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderFixComputer $orderfixcomputer)
    {
        //
        OrderFixComputer::where('id', $orderfixcomputer->id)
            ->update([
                'status' => 'IN PROGRESS',
                'statusDetail' => $request->statusDetail
            ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(OrderFixComputer $orderfixcomputer)
    {
        //
        OrderFixComputer::where('id', $orderfixcomputer->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderFixComputer  $orderfixcomputer
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderFixComputer $orderfixcomputer)
    {
        //
    }
}
