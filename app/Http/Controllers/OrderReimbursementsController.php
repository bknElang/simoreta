<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\JenisReimbursement;
use App\Models\OrderReimbursement;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderReimbursementsController extends Controller
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

        $orderreimbursements = DB::table('orderreimbursements')
            ->where('user_id', '=', $currUser->id)
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('reimbursement.myStatus', ['orderreimbursements' => $orderreimbursements, 'layout' => $layout]);
    }

    public function todoindex()
    {
        //
        $layout = 'layouts.logistik.app';

        $orderreimbursements = DB::table('orderreimbursements')
            ->join('users', 'orderreimbursements.user_id', '=', 'users.id')
            ->select('orderreimbursements.*', 'users.name AS uName')
            ->orderByRaw('orderDate DESC')
            ->paginate(10);

        return view('reimbursement.todo', ['orderreimbursements' => $orderreimbursements, 'layout' => $layout]);
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

        $jenis = DB::table('jenisreimbursements')->get();

        return view('reimbursement.orderForm', ['layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'role' => $role, 'jenis' => $jenis]);
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
            'namarekening' => 'required',
            'nomorrekening' => 'required',
            'bankrekening' =>' required',
            'nominal' => 'required|Numeric',
        ]);

        OrderReimbursement::create([
            'user_id' => $currUser->id,
            'keterangan' => $request->keterangan,
            'namaRek' => $request->namarekening,
            'nomorRek' => $request->nomorrekening,
            'bankRek' => $request->bankrekening,
            'nominal' => $request->nominal,
            'jenis_id' => $request->jenis
        ]);

        return redirect()->back()->with('successOrder', 'Order Successfull!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderReimbursement  $orderReimbursement
     * @return \Illuminate\Http\Response
     */
    public function show(OrderReimbursement $orderReimbursement)
    {
        //
        $currUser = Auth::user();

        $jenis = JenisReimbursement::find($orderReimbursement->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('reimbursement.showReimbursement', ['orderreimbursement' => $orderReimbursement, 'layout' => $layout, 'currUser' => $currUser, 'jenis' => $jenis, 'cabang' => $cabang, 'role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderReimbursement  $orderReimbursement
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderReimbursement $orderReimbursement)
    {
        //
        $currUser = Auth::user();

        $jenis = JenisReimbursement::find($orderReimbursement->jenis_id);

        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $cabang = Cabang::find($currUser->cabang_id);
        $role = Role::find($currUser->role_id);

        return view('reimbursement.editForm', ['orderreimbursement' => $orderReimbursement, 'layout' => $layout, 'currUser' => $currUser, 'cabang' => $cabang, 'jenis' => $jenis, 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderReimbursement  $orderReimbursement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderReimbursement $orderReimbursement)
    {
        //
        OrderReimbursement::where('id', $orderReimbursement->id)
            ->update([
                'statusDetail' => $request->statusDetail
            ]);

        return redirect()->back()->with('successDetail', 'Details Updated!');
    }

    public function finish(Request $request, OrderReimbursement $orderReimbursement)
    {
        //
        OrderReimbursement::where('id', $orderReimbursement->id)
            ->update([
                'status' => 'FINISHED'
            ]);

        return redirect()->back()->with('success', 'Order Finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderReimbursement  $orderReimbursement
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderReimbursement $orderReimbursement)
    {
        //
    }
}
