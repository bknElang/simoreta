<?php

namespace App\Http\Controllers;

use App\Models\OrderKiriman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderKirimansController extends Controller
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

        $kirimans = DB::table('kirimans')
                ->where('user_id', '=', $currUser->id)
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('kiriman.myStatus', ['kirimans' => $kirimans, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $kirimans = DB::table('kirimans')
                    ->where('user_id', '=', $currUser->id)
                    ->whereBetween('orderDate', [$request->from, $request->to])
                    ->orderByRaw('orderDate DESC')
                    ->paginate(10);

        return view('kiriman.myStatus', ['kirimans' => $kirimans, 'layout' => $layout]);
    }

    public function authindex()
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $kirimans = DB::table('kirimans')
                ->join('users', 'kirimans.user_id', '=', 'users.id')
                ->where('hc_id', '=', $currUser->id)
                ->where('kirimans.status', '=', 'Waiting for Approval')
                ->select('kirimans.*', 'users.name AS uName')
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('kiriman.auth', ['kirimans' => $kirimans, 'layout' => $layout]);
    }

    public function authsearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $kirimans = DB::table('kirimans')
                ->join('users', 'kirimans.user_id', '=', 'users.id')
                ->select('kirimans.*', 'users.name AS uName')
                ->where('hc_id', '=', $currUser->id)
                ->where('kirimans.status', '=', 'Waiting for Approval')
                ->whereBetween('orderDate', [$request->from, $request->to])
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('kiriman.auth', ['kirimans' => $kirimans, 'layout' => $layout]);
    }

    public function todoindex()
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $kirimans = DB::table('kirimans')
                ->join('users', 'kirimans.user_id', '=', 'users.id')
                ->select('kirimans.*', 'users.name AS uName')
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('kiriman.todo', ['kirimans' => $kirimans, 'layout' => $layout]);
    }

    public function todosearch(Request $request)
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $kirimans = DB::table('kirimans')
                ->join('users', 'kirimans.user_id', '=', 'users.id')
                ->select('kirimans.*', 'users.name AS uName')
                ->whereBetween('orderDate', [$request->from, $request->to])
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('kiriman.todo', ['kirimans' => $kirimans, 'layout' => $layout]);
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

        return view('kiriman.orderForm', ['layout' => $layout, 'currUser' => $currUser, 'hcs' => $hcs]);
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

        if($request->pertanggungan == "Ya"){
            $request->validate([
                'dokumen' => 'required',
                'asuransi' => 'required',
                'namaTujuan' => 'required',
                'namaPenerima' => 'required',
                'notelp' => 'required|numeric',
                'alamat' => 'required',
                'pertanggungan' => 'required|numeric',
            ]);
        }else{
            $request->validate([
                'dokumen' => 'required',
                'asuransi' => 'required',
                'namaTujuan' => 'required',
                'namaPenerima' => 'required',
                'notelp' => 'required|numeric',
                'alamat' => 'required',
            ]);
        }

        $file = $request->file('dokumen');
        $fileName = $file->getClientOriginalName();
        $uploadName = time() . '-' . $fileName;
        $request->file('dokumen')->move('kiriman_File', $uploadName);

        OrderKiriman::create([
            'user_id' => $currUser->id,
            'jenisKiriman' => $request->jenisKiriman,
            'asuransi' => $request->asuransi,
            'pertanggungan' => $request->pertanggungan,
            'namaDebitur' => $request->namaTujuan,
            'namaPIC' => $request->namaPenerima,
            'alamat' => $request->alamat,
            'noPenerima' => $request->notelp,
            'dokumen' => $uploadName,
            'hc_id' => $request->hcname
        ]);

        return redirect()->back()->with('successOrder', 'Order Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderKiriman  $orderKiriman
     * @return \Illuminate\Http\Response
     */
    public function show(OrderKiriman $orderKiriman)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderKiriman->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('kiriman.showKiriman', ['layout' => $layout, 'currUser' => $currUser, 'orderKiriman' => $orderKiriman]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderKiriman  $orderKiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderKiriman $orderKiriman)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderKiriman->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('kiriman.editForm', ['layout' => $layout, 'currUser' => $currUser, 'orderKiriman' => $orderKiriman]);
    }

    public function authdetail(OrderKiriman $orderKiriman)
    {
        //
        $currUser = User::firstWhere('id', '=', $orderKiriman->user_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('kiriman.authDetail', ['layout' => $layout, 'currUser' => $currUser, 'orderKiriman' => $orderKiriman]);
    }

    public function approve(OrderKiriman $orderKiriman)
    {
        //
        OrderKiriman::where('id', $orderKiriman->id)
            ->update([
                'status' => 'PENDING'
            ]);

        return redirect()->back()->with('success', 'Order Approved');
    }

    public function reject(OrderKiriman $orderKiriman)
    {
        //
        OrderKiriman::where('id', $orderKiriman->id)
            ->update([
                'status' => 'REJECTED'
            ]);

        return redirect()->back()->with('success', 'Order Rejected');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderKiriman  $orderKiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderKiriman $orderKiriman)
    {
        //
        OrderKiriman::where('id', $orderKiriman->id)
        ->update([
            'status' => 'IN PROGRESS',
            'statusDetail' => $request->statusDetail
        ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(OrderKiriman $orderKiriman)
    {
        //
        OrderKiriman::where('id', $orderKiriman->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderKiriman  $orderKiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderKiriman $orderKiriman)
    {
        //
    }
}
