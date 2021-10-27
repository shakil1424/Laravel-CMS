<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.permissions.index',['permissions'=>Permission::all()]);
    }

    public function store()
    {
        request()->validate(['name' => ['required']]);
        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            ]);
    }

    public function update(Permission $permission)
    {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');
        if ($permission->isDirty('name')) {
            Session::flash('permission-updated', 'permission updated: ' . request('name'));
            $permission->save();
        } else {
            Session::flash('permission-updated', 'Nothing is updated');
        }

        return back();
    }

    public function destroy(Permission $permission)
    {
        //$this->authorize('delete', $user);
        $permission->delete();
        Session::flash('permission-deleted', 'Permission is deleted');
        return back();
    }
}
