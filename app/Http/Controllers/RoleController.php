<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.role', compact('roles'));
    }

    public function postRole(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('status', 'success create role');
    }

    public function putRole(Request $request, $id)
    {
        $role = Role::find($id);

        $role->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'success update role');
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);

        $role->delete();

        return redirect()->back()->with('status', 'success delete role');
    }
}
