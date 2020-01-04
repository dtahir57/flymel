<?php

namespace App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;
use Session;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $roles=Role::all();
        return view('admin.usermanagement.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        return view('admin.usermanagement.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role=new Role;
        $role->name=$request->name;
        $role->save();
        $role->givePermissionTo($request->permissions);
        if($role)
        {
            Session::flash('created','Role Created Successfuly');
            return redirect()->route('role.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::find($id);
        $permissions=Permission::all();
        return view('admin.usermanagement.role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role=Role::find($id);
        $role->name=$request->name;
        $role->update();
        $role->syncPermissions($request->permissions);
        if($role)
        {
            Session::flash('created','Role Updated Successfuly');
            return redirect()->route('role.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::find($id)->delete();
        if($role)
        {
            Session::flash('deleted','Role Deleted Successfuly');
            return redirect()->route('role.index');
        }
    }
}