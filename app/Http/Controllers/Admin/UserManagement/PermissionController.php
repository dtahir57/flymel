<?php

namespace App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;
use Session;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $permissions=Permission::all();
        return view('admin.usermanagement.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usermanagement.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission=new Permission;
        $permission->name=$request->name;
        $permission->save();
        if($permission)
        {
            Session::flash('created','Permission Created Successfuly');
            return redirect()->route('permission.index');
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
        $permission=Permission::find($id);
        return view('admin.usermanagement.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission=Permission::find($id);
        $permission->name=$request->name;
        $permission->update();
        if($permission)
        {
            Session::flash('updated','Permission Updated Successfuly');
            return redirect()->route('permission.index');
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
        $permission=Permission::find($id)->delete();
        if($permission)
        {
            Session::flash('deleted','Permission Deleted Successfuly');
            return redirect()->route('permission.index');
        }
    }
}
