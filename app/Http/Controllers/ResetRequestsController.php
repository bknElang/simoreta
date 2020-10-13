<?php

namespace App\Http\Controllers;

use App\Models\ResetRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ResetRequestsController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResetRequest  $resetRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ResetRequest $resetRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResetRequest  $resetRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ResetRequest $resetRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResetRequest  $resetRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResetRequest $resetRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResetRequest  $resetRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ResetRequest $resetRequest)
    {
        //
        $password = time();

        User::where('id', $request->userID)
            ->update([
                'password' => bcrypt($password)
            ]);

        ResetRequest::destroy($resetRequest->id);

        return redirect()->back()->with('success', 'New Password: ' . $password. ' for user ID: '. $request->userID);
    }
}
