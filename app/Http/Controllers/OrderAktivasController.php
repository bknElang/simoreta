<?php

namespace App\Http\Controllers;

use App\Models\OrderAktiva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderAktivasController extends Controller
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

        $aktivas = DB::table('aktivas')
            ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('aktiva.myStatus', ['aktivas' => $aktivas, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $aktivas = DB::table('aktivas')
                ->where('user_id', '=', $currUser->id)
                ->whereBetween('orderDate', [$request->from, $request->to])
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('aktiva.myStatus', ['aktivas' => $aktivas, 'layout' => $layout]);
    }

    public function todoindex()
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $aktivas = DB::table('aktivas')
                ->join('users', 'aktivas.user_id', '=', 'users.id')
                ->select('aktivas.*', 'users.name AS uName')
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('aktiva.todo', ['aktivas' => $aktivas, 'layout' => $layout]);
    }

    public function todosearch(Request $request)
    {
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $aktivas = DB::table('aktivas')
                ->join('users', 'aktivas.user_id', '=', 'users.id')
                ->select('aktivas.*', 'users.name AS uName')
                ->whereBetween('orderDate', [$request->from, $request->to])
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('aktiva.todo', ['aktivas' => $aktivas, 'layout' => $layout]);
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

        return view('aktiva.orderForm', ['layout' => $layout, 'currUser' => $currUser]);
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
            'spesifikasi' => 'required',
            'keterangan' => 'required',
        ]);

        OrderAktiva::create([
            'user_id' => $currUser->id,
            'jenisBarang' => $request->jenis,
            'spesifikasi' => $request->spesifikasi,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('successOrder', 'Order Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderAktiva  $orderAktiva
     * @return \Illuminate\Http\Response
     */
    public function show(OrderAktiva $orderAktiva)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('aktiva.showAktiva', ['layout' => $layout, 'currUser' => $currUser, 'orderAktiva' => $orderAktiva]);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderAktiva  $orderAktiva
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderAktiva $orderAktiva)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('aktiva.editForm', ['layout' => $layout, 'currUser' => $currUser, 'orderAktiva' => $orderAktiva]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderAktiva  $orderAktiva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderAktiva $orderAktiva)
    {
        //
        OrderAktiva::where('id', $orderAktiva->id)
        ->update([
            'status' => 'IN PROGRESS',
            'statusDetail' => $request->statusDetail
        ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(OrderAktiva $orderAktiva)
    {
        //
        OrderAktiva::where('id', $orderAktiva->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderAktiva  $orderAktiva
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderAktiva $orderAktiva)
    {
        //
    }
}
