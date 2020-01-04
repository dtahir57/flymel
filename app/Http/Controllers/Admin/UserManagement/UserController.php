<?php

namespace App\Http\Controllers\Admin\UserManagement;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Super_User']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.usermanagement.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('admin.usermanagement.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        $user->assignRole($request->roles);
        if($user)
        {
            Session::flash('created','User Created Successfuly');
            return redirect()->route('user.index');
        }
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
        $roles=Role::all();
        $user=User::find($id);
        return view('admin.usermanagement.user.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->update();
        $user->syncRoles($request->roles);
        if($user)
        {
            Session::flash('created','User Updated Successfuly');
            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id)->delete();
        if($user)
        {
            Session::flash('deleted','User Deleted Successfuly');
            return redirect()->route('user.index');
        }
    }
}
