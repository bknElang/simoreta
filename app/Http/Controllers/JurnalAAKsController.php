<?php

namespace App\Http\Controllers;

use App\Models\JurnalAAK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JurnalAAKsController extends Controller
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

        $aaks = DB::table('aaks')
            ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('jurnalAAK.myStatus', ['aaks' => $aaks, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $aaks = DB::table('aaks')
                ->where('user_id', '=', $currUser->id)
                ->whereBetween('orderDate', [$request->from, $request->to])
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('jurnalAAK.myStatus', ['aaks' => $aaks, 'layout' => $layout]);
    }

    public function todoindex()
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $aaks = DB::table('aaks')
                ->join('users', 'aaks.user_id', '=', 'users.id')
                ->select('aaks.*', 'users.name AS uName')
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('jurnalAAK.todo', ['aaks' => $aaks, 'layout' => $layout]);
    }
    
    public function todosearch(Request $request)
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $aaks = DB::table('aaks')
                ->join('users', 'aaks.user_id', '=', 'users.id')
                ->select('aaks.*', 'users.name AS uName')
                ->whereBetween('orderDate', [$request->from, $request->to])
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('jurnalAAK.todo', ['aaks' => $aaks, 'layout' => $layout]);
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

        return view('jurnalAAK.orderForm', ['layout' => $layout, 'currUser' => $currUser]);
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

        $request->validate([
            'fileUpload' => 'required',
        ]);

        $file = $request->file('fileUpload');
        $fileName = $file->getClientOriginalName();
        $uploadName = time() . '-' . $fileName;
        $request->file('fileUpload')->move('jurnal_AAK', $uploadName);

        JurnalAAK::create([
            'user_id' => $currUser->id,
            'filename' => $uploadName,
        ]);

        return redirect()->back()->with('successOrder', 'Order Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JurnalAAK  $jurnalAAK
     * @return \Illuminate\Http\Response
     */
    public function show(JurnalAAK $jurnalAAK)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('jurnalAAK.showManual', ['layout' => $layout, 'currUser' => $currUser, 'jurnalAAK' => $jurnalAAK]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JurnalAAK  $jurnalAAK
     * @return \Illuminate\Http\Response
     */
    public function edit(JurnalAAK $jurnalAAK)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('jurnalAAK.editForm', ['layout' => $layout, 'currUser' => $currUser, 'jurnalAAK' => $jurnalAAK]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JurnalAAK  $jurnalAAK
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JurnalAAK $jurnalAAK)
    {
        //
        JurnalAAK::where('id', $jurnalAAK->id)
        ->update([
            'status' => 'IN PROGRESS',
            'statusDetail' => $request->statusDetail
        ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(JurnalAAK $jurnalAAK)
    {
        //
        JurnalAAK::where('id', $jurnalAAK->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JurnalAAK  $jurnalAAK
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurnalAAK $jurnalAAK)
    {
        //
    }
}
