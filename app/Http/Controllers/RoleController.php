<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
    
        return view('admin.role.index', compact('role'));
    }

    public function store(Request $request)
    {
        Role::create($request->all());

        Alert::success('Success Title', 'Success Message');


        return redirect('/role')->with('toast_success', 'Data berhasil ditambahkan!');
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect('/role')->with('toast_warning', 'Data berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $user->role       = $request->role;

        $user->save();

        return redirect('/role')->with('toast_info', 'Data berhasil diupdate!');
    }
}
