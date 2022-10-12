<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::join('role', 'role.id', '=', 'users.role_id')
                ->select('users.*', 'role.role')
                ->get();
        
        $role = Role::all();

        return view('admin.user.index', compact('user', 'role'));
    }
    public function create(Request $request)
    {
        $role_id = Role::all();
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'status'    => 'aktif',
            'created_at'=> $request->created_at,
            'updated_at'=> $request->updated_at,
        ]);
        return redirect('/user')->with('success', 'Data berhasil ditambahkan!');
    }

    
    public function update(Request $request, $id)
    {
        $role = Role::all();
        $user = User::find($id);

        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->password   = Hash::make($request->password);
        $user->role_id    = $request->role_id;
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;

        $user->save();

        return redirect('/user')->with('success', 'Data berhasil diupdate!');
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/user')->with('success', 'Data berhasil dihapus!');
    }

    public function upStatus($id)
    { 
        $user = \DB::table('users')->where('id', $id)->first();

        $status_sekarang = $user->status;

        if($status_sekarang == 'aktif'){
            \DB::table('users')->where('id', $id)->update([
                'status'=>'non-aktif'
            ]);
        }else{
            \DB::table('users')->where('id', $id)->update([
                'status'=> 'aktif'
            ]);
        }

        return redirect('/user')->with('success', 'Data berhasil diubah!');
    }

    public function trash()
    {
    	$user_trash = User::join('role', 'role.id', '=', 'users.role_id')
                            ->select('users.*', 'role.role')
                            ->onlyTrashed()
                            ->get();
    	return view('admin.user.trash', compact('user_trash'));
    }

    public function restore($id)
    {
        $restore = User::onlyTrashed()->where('id',$id);
    	$restore->restore();

    	return redirect('/user/trash')->with('toast_success', 'Data berhasil dikembalikan!');
    }

    public function delete_kill($id)
    {      
    	$delete = User::onlyTrashed()->where('id',$id);
    	$delete->forceDelete();
 
    	return redirect('/user/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function delete_all()
    {
    	$delete = User::onlyTrashed();
    	$delete->forceDelete();
 
    	return redirect('/user/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

}
