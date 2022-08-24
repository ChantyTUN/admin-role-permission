<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::whereNotIN('name',['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }
    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required','min:3']
        ]);
        Role::create($validated);
        // route('admin.roles.index');
        return redirect(route('admin.roles.index'))->with('message','Role Insert successfully.');
    }

    public function edit(Role $role){
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    public function update(Request $request,Role $role){
        $validated = $request->validate([
            'name' => ['required','min:3']
        ]);
        $role->update($validated);
        // route('admin.roles.index');
        return redirect(route('admin.roles.index'))->with('message','Role Updated successfully.');
    }

    public function destroy(Role $role){
        $role->delete();
        return back()->with('message','Role Deleted successfully.');
    }
    
    public function givePermission(Request $request, Role $role){
        // has permission already
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message','Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message','Permission added successfully');
    }

    public function revokePermission(Role $role, Permission $permission){
        // has permission already
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission revoked.');
        }
        return back()->with('message','Permission not exists.');

    }


}
