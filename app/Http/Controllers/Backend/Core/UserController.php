<?php

namespace App\Http\Controllers\Backend\Core;

use App\Http\Controllers\Base\BaseController;
use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::with("group","details")->get();
        //dd($users[0]->group[0]);
        return view('admin.pages.user.index',['users'=>$users ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $groups = Group::all();
        $type = $request->type ?? "create";
        return view('admin.pages.user.create',[ "groups"=>$groups,"type" => $type]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->storeValidation($request);

        try {
            DB::beginTransaction();
            $userName = $this->generateUserName($request->group_id);
            $password = $this->generatePassword($userName);

            $user = $request->only('email');
            $user['username'] = $userName;
            $user['password'] = Hash::make($password);


            $file = $request->avatar;
            if(!empty($file)){
                $user['avatar'] = $this->upload($file , "user/avatar");
            }

            $details = $request->except("avatar","email","group_id");
            $student = User::create($user);
            $student->details()->create($details);
            $group = $request->only("group_id");
            $group["user_id"] = $student->id;

            UserGroup::create($group);

            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();
            $notification = array(
                'messege' => "something went wrong!!!",
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

        $notification = [
            'messege' => 'Student Create Successfully!',
            'alert-type' => 'success'
        ];
        return Redirect()->route('User.index')->with($notification);
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


    public function storeValidation (Request $request){
        $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'dob' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'parent_contact_number' => 'required|regex:/(01)[0-9]{9}/',
            'contact_number' => 'nullable|regex:/(01)[0-9]{9}/',
            'father_occupation' => 'required',

            'present_address' => 'required',
            'permanent_address' => 'required',
            'group_id' => 'required|numeric',
        ]);
    }


    public function generateUserName($id){
        $newId = now()->format('Y').str_pad($id, 3, '0', STR_PAD_LEFT);
        $group = group::with('student')->find($id);
        if(count($group->student) == 0){
            $newId .= str_pad(1, 3, '0', STR_PAD_LEFT);
        }else{

        }
        return $newId;
    }

    public function generatePassword($userName){
        return $userName .Str::random(3);
    }
}
