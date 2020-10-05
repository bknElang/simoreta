<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->join('cabangs', 'users.cabang_id', '=', 'cabangs.id')
                ->select('users.*', 'roles.name AS rName', 'cabangs.name AS cName')
                ->paginate(10);

        return view('admin.viewUser', ['users' => $users]);
    }

    public function search(Request $request)
    {
        //
        $search = $request->get('search');
        $users = DB::table('users')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->join('cabangs', 'users.cabang_id', '=', 'cabangs.id')
                    ->where('users.name', 'LIKE', '%'.$search.'%')
                    ->select('users.*', 'roles.name AS rName', 'cabangs.name AS cName')
                    ->paginate(10);

        return view('admin.viewUser', ['users' => $users]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $roles = DB::table('roles')->get();
        $cabangs = DB::table('cabangs')->get();
        $currUser = Auth::user();

        //admin full edit
        if($currUser->role_id == 1){
            return view('admin.showUser', ['user'=>$user, 'roles'=>$roles, 'cabangs' => $cabangs]);
        }
        //other users only update password & avatar
        else{
            $pagesController = new PagesController();
            $layout = $pagesController->getLayout();

            return view('user.showDetail', ['user'=>$user, 'roles'=>$roles, 'cabangs' => $cabangs, 'layout' => $layout]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validatedData = $request->validate([
            'nip' => 'required|numeric',
            'nohp' => 'required|numeric',
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required|alpha_num|confirmed'
        ]);

        User::where('id', $user->id)
            ->update([
                'NIP' => $request->nip,
                'nohp' => $request->nohp,
                'name' => $request->name,
                'email' => $request->email,
                'cabang_id' => $request->cabang,
                'role_id' => $request->role,
                'password' => bcrypt($request->password)
            ]);

        return redirect()->back()->with('updateSuccess', 'Details Updated');

    }

    public function updateAvatar(Request $request, User $user){
        $request->validate([
            'image' => 'required|max:2048',
        ]);

        $imageName = $request->file('image')->getClientOriginalName();

        $uploadName = time().'-'.$user->username.'-'.$imageName;

        $request->file('image')->move('images',$uploadName);

        User::where('id', $user->id)
            ->update([
                'avatar' => $uploadName
            ]);

        return redirect()->back()->with('updateAvaSuccess', 'Avatar Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        User::destroy($user->id);
        return redirect('/users')->with('User Deleted!');
    }
}