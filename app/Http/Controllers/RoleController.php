<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function store()
    {
        request()->validate(['name' => ['required']]);
        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role' => $role]);
    }

    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');
        if ($role->isDirty('name')) {
            Session::flash('role-updated', 'Role updated: ' . request('name'));
            $role->save();
        } else {
            Session::flash('role-updated', 'Nothing is updated');
        }

        return back();
    }

    public function destroy(Role $role)
    {
        //$this->authorize('delete', $user);
        $role->delete();
        Session::flash('role-deleted', 'Role is deleted');
        return back();
    }
}
