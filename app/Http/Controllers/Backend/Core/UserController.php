<?php

namespace App\Http\Controllers\Backend\Core;

use App\Http\Controllers\Base\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::all();
        return view('admin.pages.user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $role = Role::where('guard_name','web')->get();
        return view('admin.pages.user.create',['role'=> $role]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|max:255|min:6',
        ]);

        $data = $request->except('avatar','password');
        $data['password'] = Hash::make($request->password);
        $file = $request->avatar;

        if(!empty($file)){
          $data['avatar'] = $this->upload($file , "user/avatar");
        }

        User::create($data);

        $notification = array(
            'messege' => 'User Create Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.user.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,'.$id,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id

     */
    public function destroy($id)
    {
        User::destroy($id);
        $notification = array(
            'messege' => 'User Account delete Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function changeStatus($id , $status){
        $user = User::find($id);
        $user->status = $status;
        $user->save();

        $notification = array(
            'messege' => 'User Status Changed!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
