<?php

namespace App\Http\Controllers;

use App\Models\AssignKendaraan;
use App\Models\OrderKendaraan;
use Illuminate\Http\Request;

class AssignKendaraansController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validatedData = $request->validate([
            'namadriver' => 'required',
            'nomordriver' => 'required|numeric',
            'jeniskendaraan' => 'required',
            'platnomor' => 'required',
            'pinpenumpang' => 'required'
        ]);

        $assignKendaraan = AssignKendaraan::create([
            'namaDriver' => $request->namadriver,
            'nohpDriver' => $request->nomordriver,
            'jenisKendaraan' => $request->jeniskendaraan,
            'plateNumber' => $request->platnomor,
            'pinPenumpang' => $request->pinpenumpang,
        ]);

        $assignID = $assignKendaraan->id;

        OrderKendaraan::where('id', $request->orderID)
                    ->update([
                        'assign_id' => $assignID,
                        'status' => 'FINISHED'
                    ]);

        return redirect()->back()->with('successAssign', 'Assign Driver Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignKendaraan  $assignKendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(AssignKendaraan $assignKendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignKendaraan  $assignKendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignKendaraan $assignKendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignKendaraan  $assignKendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignKendaraan $assignKendaraan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignKendaraan  $assignKendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignKendaraan $assignKendaraan)
    {
        //
    }
}
