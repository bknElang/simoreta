<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function changepassword(User $user)
    {
        //
        $pagesController = new PagesController();
        $layout = $pagesController->getLayout();

        $currDate = new DateTime ();

        $getUpdate = new DateTime($user->lastChangedPassword);
        $deadline = $getUpdate->modify('+30 day');

        $interval = $currDate->diff($deadline);

        return view('user.changePassword', ['user'=>$user, 'layout' => $layout, 'interval' => $interval]);
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
        User::where('id', $user->id)
            ->update([
                'cabang_id' => $request->cabang,
                'role_id' => $request->role,
            ]);

        return redirect()->back()->with('updateSuccess', 'Details Updated');
    }

    public function updatePassword(Request $request, User $user){
        if (!(Hash::check($request->oldPassword, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->oldPassword, $request->newPassword) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'newPassword' => 'required|alpha_num|min:6|confirmed'
        ]);

        $current = new Datetime();

        User::where('id', $user->id)
            ->update([
                'password' => bcrypt($request->newPassword),
                'lastChangedPassword' => $current
            ]);

        return redirect()->back()->with('success', 'Password Updated');
    }

    public function updateAvatar(Request $request, User $user){
        $request->validate([
            'file' => 'required|max:2048|image',
        ]);

        $imageName = $request->file('file')->getClientOriginalName();

        $uploadName = time().'-'.$user->NIP.'-'.$imageName;

        $request->file('file')->move('images',$uploadName);

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

    public function test(User $user){
        dd($user);
    }
}