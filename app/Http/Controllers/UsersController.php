<?php

namespace App\Http\Controllers;

use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
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

        $users = User::with(array('role'))->paginate(10);

        return view('admin.viewUser', ['users' => $users]);
    }

    public function search(Request $request)
    {
        //
        $search = $request->get('search');
        $users = User::with(array('role'))->where('name', 'LIKE', '%'.$search.'%')->paginate(10);

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
        $currUser = Auth::user();

        //admin full edit
        if($currUser->role_id == 1){
            return view('admin.showUser', ['user'=>$user, 'roles'=>$roles]);
        }
        //other users only update password
        elseif($currUser->role_id == 2){
            return view('apk.logistik.showDetail', ['user'=>$user, 'roles'=>$roles]);
        }
        elseif($currUser->role_id == 3){
            return view('apk.pembukuan.showDetail', ['user'=>$user, 'roles'=>$roles]);
        }
        elseif($currUser->role_id == 4){
            return view('apk.sic.showDetail', ['user'=>$user, 'roles'=>$roles]);
        }
        elseif($currUser->role_id == 5){
            return view('user.showDetail', ['user'=>$user, 'roles'=>$roles]);
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
            'name' => 'required|max:255',
            'username' => 'required',
            'password' => 'required|alpha_num|confirmed'
        ]);

        User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'role_id' => $request->role,
                'password' => bcrypt($request->password)
            ]);

        return redirect('/users/'.$user->id)->with('User Updated!');

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
    
        return redirect('/users/'.$user->id)->with('Avatar Updated!');
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