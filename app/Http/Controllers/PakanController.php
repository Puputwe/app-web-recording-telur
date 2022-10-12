<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakan;
use Validator;

date_default_timezone_set('Asia/Jakarta');

class PakanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::all();
        
        return view('admin.pakan.index', compact('pakan'));
    }

    public function store(Request $request)
    {   
        
        $this->validate($request,[
            'nama'     => 'required|unique:pakan',
        ]);

        Pakan::create([
            'nama'        => $request->nama,
            'jenis'       => $request->jenis,
            'perusahaan'  => $request->perusahaan,
            'stok'        => $request->stok,
            'keterangan'  => $request->keterangan,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
        
        return redirect('/pakan')->with('toast_success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
      
        $pakan = Pakan::find($id);
        
         $pakan->nama       = $request->nama;
         $pakan->jenis      = $request->jenis;
         $pakan->perusahaan = $request->perusahaan;
         $pakan->stok       = $request->stok;
         $pakan->keterangan = $request->keterangan;
         $pakan->updated_at = date('Y-m-d H:i:s');

         $pakan->save();

        return redirect('/pakan')->with('toast_info', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $pakan = Pakan::find($id);
        $pakan->delete();

        return redirect('/pakan')->with('toast_warning', 'Data berhasil dihapus!');
    }

    public function trash()
    {
    	$pakan_trash = Pakan::onlyTrashed()->get();
    	return view('admin.pakan.trash', compact('pakan_trash'));
    }

    public function restore($id)
    {
        $restore = Pakan::onlyTrashed()->where('id',$id);
    	$restore->restore();

    	return redirect('/pakan/trash')->with('toast_success', 'Data berhasil dikembalikan!');
    }

    public function delete_kill($id)
    {      
    	$delete = Pakan::onlyTrashed()->where('id',$id);
    	$delete->forceDelete();
 
    	return redirect('/pakan/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function delete_all()
    {
    	$delete = Pakan::onlyTrashed();
    	$delete->forceDelete();
 
    	return redirect('/pakan/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }
}
