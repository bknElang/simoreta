<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\JenisAplikasi;
use App\Models\OrderFixAplikasi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderFixAplikasiController extends Controller
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

        $orderfixaplikasi = DB::table('orderfixaplikasi')
            ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixaplikasi.myStatus', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixaplikasi = DB::table('orderfixaplikasi')
            ->where('user_id', '=', $currUser->id)
            ->whereBetween('orderDate', [$request->from, $request->to])
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixaplikasi.myStatus', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout]);
    }

    public function authindex()
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixaplikasi = DB::table('orderfixaplikasi')
                            ->join('users', 'orderfixaplikasi.user_id', '=', 'users.id')
                            ->select('orderfixaplikasi.*', 'users.name AS uName')
                            ->where('hc_id', '=', $currUser->id)
                            ->where('status', '=', 'Waiting for Approval')
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('fixaplikasi.auth', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout]);
    }

    public function authsearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixaplikasi = DB::table('orderfixaplikasi')
                            ->join('users', 'orderfixaplikasi.user_id', '=', 'users.id')
                            ->select('orderfixaplikasi.*', 'users.name AS uName')
                            ->where('hc_id', '=', $currUser->id)
                            ->where('status', '=', 'Waiting for Approval')
                            ->whereBetween('orderDate', [$request->from, $request->to])
                            ->orderByRaw('orderDate DESC')
                            ->paginate(10);

        return view('fixaplikasi.auth', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout]);
    }

    public function todoindex()
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixaplikasi = DB::table('orderfixaplikasi')
            ->join('users', 'orderfixaplikasi.user_id', '=', 'users.id')
            ->select('orderfixaplikasi.*', 'users.name AS uName')
            ->where('orderfixaplikasi.status', '!=', 'Waiting for Approval')
            ->where('orderfixaplikasi.status', '!=', 'REJECTED')
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixaplikasi.todo', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout]);
    }

    public function todosearch(Request $request)
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $orderfixaplikasi = DB::table('orderfixaplikasi')
            ->join('users', 'orderfixaplikasi.user_id', '=', 'users.id')
            ->select('orderfixaplikasi.*', 'users.name AS uName')
            ->where('orderfixaplikasi.status', '!=', 'Waiting for Approval')
            ->where('orderfixaplikasi.status', '!=', 'REJECTED')
            ->whereBetween('orderDate', [$request->from, $request->to])
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('fixaplikasi.todo', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout]);
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

        $jenis = DB::table('jenisaplikasi')->get();

        $hcs = User::where('role_id', 5)->get();

        return view('fixaplikasi.orderForm', ['layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'role' => $role, 'jenis' => $jenis, 'hcs' => $hcs]);
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

        OrderFixAplikasi::create([
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
     * @param  \App\Models\OrderFixAplikasi  $orderfixaplikasi
     * @return \Illuminate\Http\Response
     */
    public function show(OrderFixAplikasi $orderfixaplikasi)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderfixaplikasi->user_id);

        $jenis = JenisAplikasi::find($orderfixaplikasi->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('fixaplikasi.showFixAplikasi', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout, 'currUser' => $currUser, 'jenis' => $jenis, 'cabang' => $cabang, 'role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderFixAplikasi  $orderfixaplikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderFixAplikasi $orderfixaplikasi)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderfixaplikasi->user_id);

        $jenis = JenisAplikasi::find($orderfixaplikasi->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('fixaplikasi.editForm', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'jenis' => $jenis, 'role' => $role]);
    }

    public function authdetail(OrderFixAplikasi $orderfixaplikasi)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderfixaplikasi->user_id);

        $jenis = JenisAplikasi::find($orderfixaplikasi->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('fixaplikasi.authDetail', ['orderfixaplikasi' => $orderfixaplikasi, 'layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'jenis' => $jenis, 'role' => $role]);
    }

    public function approve(OrderFixAplikasi $orderfixaplikasi)
    {
        //
        OrderFixAplikasi::where('id', $orderfixaplikasi->id)
            ->update([
                'status' => 'PENDING'
            ]);

        return redirect()->back()->with('success', 'Order Approved');
    }

    public function reject(OrderFixAplikasi $orderfixaplikasi)
    {
        //
        OrderFixAplikasi::where('id', $orderfixaplikasi->id)
            ->update([
                'status' => 'REJECTED'
            ]);

        return redirect()->back()->with('success', 'Order Rejected');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderFixAplikasi  $orderfixaplikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderFixAplikasi $orderfixaplikasi)
    {
        //
        OrderFixAplikasi::where('id', $orderfixaplikasi->id)
            ->update([
                'status' => 'IN PROGRESS',
                'statusDetail' => $request->statusDetail
            ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(OrderFixAplikasi $orderfixaplikasi)
    {
        //
        OrderFixAplikasi::where('id', $orderfixaplikasi->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderFixAplikasi  $orderfixaplikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderFixAplikasi $orderfixaplikasi)
    {
        //
    }
}
