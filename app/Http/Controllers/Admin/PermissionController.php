<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(){
        return view('admin.permissions.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required','min:3']
        ]);
        Permission::create($validated);
        // route('admin.roles.index');
        return redirect(route('admin.permissions.index'))->with('message','Permission Insert successfully.');
    }

    public function edit(Permission $permission){
        $roles = Role::all();
        return view('admin.permissions.edit',compact('permission','roles'));
    }

    public function update(Request $request,Permission $permission){
        $validated = $request->validate([
            'name' => ['required','min:3']
        ]);
        $permission->update($validated);
        // route('admin.roles.index');
        return redirect(route('admin.permissions.index'))->with('message','Permission updated successfully.');
    }

    public function destroy(Permission $permission){
        $role->delete();
        return back()->with('message','Permission Deleted successfully.');
    }

    public function assignRole(Request $request,Permission $permission){
        // has role already
        if($permission->hasRole($request->role)){
            return back()->with('message','Role exists.');
        }
        $permission->assignRole($request->role);
        return back()->with('message','Role added successfully');
    }

    public function removeRole(Permission $permission,Role $role){
        // has permission already
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back()->with('message','Role removed.');
        }
        return back()->with('message','Role not exists.');

    }
}
