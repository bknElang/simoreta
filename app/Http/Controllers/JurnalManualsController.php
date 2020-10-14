<?php

namespace App\Http\Controllers;

use App\Models\JurnalManual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JurnalManualsController extends Controller
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

        $manuals = DB::table('manuals')
        ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('jurnalManual.myStatus', ['manuals' => $manuals, 'layout' => $layout]);
    }

    public function mysearch(Request $request)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $manuals = DB::table('manuals')
            ->where('user_id', '=', $currUser->id)
            ->whereBetween('orderDate', [$request->from, $request->to])
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('jurnalManual.myStatus', ['manuals' => $manuals, 'layout' => $layout]);
    }

    public function todoindex()
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $manuals = DB::table('manuals')
                ->join('users', 'manuals.user_id', '=', 'users.id')
                ->select('manuals.*', 'users.name AS uName')
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('jurnalManual.todo', ['manuals' => $manuals, 'layout' => $layout]);
    }

    public function todosearch(Request $request)
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $manuals = DB::table('manuals')
                ->join('users', 'manuals.user_id', '=', 'users.id')
                ->select('manuals.*', 'users.name AS uName')
                ->whereBetween('orderDate', [$request->from, $request->to])
                ->orderByRaw('orderDate DESC')
                ->paginate(10);

        return view('jurnalManual.todo', ['manuals' => $manuals, 'layout' => $layout]);
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

        return view('jurnalManual.orderForm', ['layout' => $layout, 'currUser' => $currUser, 'hcs' => $hcs]);
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
        $uploadName = time() .'-'. $fileName;
        $request->file('fileUpload')->move('jurnal_Manual', $uploadName);

        JurnalManual::create([
            'user_id' => $currUser->id,
            'filename' => $uploadName,
            'hc_id' => $request->hcname,
        ]);

        return redirect()->back()->with('successOrder', 'Order Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JurnalManual  $jurnalManual
     * @return \Illuminate\Http\Response
     */
    public function show(JurnalManual $jurnalManual)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('jurnalManual.showManual', ['layout' => $layout, 'currUser' => $currUser, 'jurnalManual' => $jurnalManual]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JurnalManual  $jurnalManual
     * @return \Illuminate\Http\Response
     */
    public function edit(JurnalManual $jurnalManual)
    {
        //
        $currUser = Auth::user();

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        return view('jurnalManual.editForm', ['layout' => $layout, 'currUser' => $currUser, 'jurnalManual' => $jurnalManual]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JurnalManual  $jurnalManual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JurnalManual $jurnalManual)
    {
        //
        JurnalManual::where('id', $jurnalManual->id)
            ->update([
                'status' => 'IN PROGRESS',
                'statusDetail' => $request->statusDetail
            ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(JurnalManual $jurnalManual)
    {
        //
        JurnalManual::where('id', $jurnalManual->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JurnalManual  $jurnalManual
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurnalManual $jurnalManual)
    {
        //
    }
}
