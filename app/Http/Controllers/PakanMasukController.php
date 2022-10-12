<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakan;
use App\Models\PakanMasuk;
use DB;

date_default_timezone_set('Asia/Jakarta');

class PakanMasukController extends Controller
{
    public function index()
    {
        $pakan_in = PakanMasuk::join('pakan', 'pakan.id', '=', 'pakan_masuk.id_pakan')
                    ->select('pakan_masuk.*', 'pakan.nama', 'pakan.perusahaan')
                    ->get();

        return view('admin.stok.index', compact('pakan_in'));
    }

    public function create(Request $request)
    {
        $pakan    = Pakan::all();

        return view('admin.stok.add', compact('pakan'));
    }

    public function ajax(Request $request)
    {
        $id_pakan['id_pakan'] = $request->id_pakan;
        $ajax_pakan           = Pakan::where('id', $id_pakan)->get();

        return view('admin.stok.ajax', compact('ajax_pakan'));
    }
    
    public function store(Request $request)
    {
        PakanMasuk::create([
            'id_pakan'      => $request->id_pakan,
            'jml_pakan'     => $request->jml_pakan,
            'tgl_masuk'     => $request->tgl_masuk,
        ]);

        $pakan = Pakan::find($request->id_pakan);
        
        $pakan->stok += $request->jml_pakan;
        $pakan->save();

        return redirect('/stok-pakan')->with('toast_success', 'Data berhasil ditambahkan!');
    } 

    public function delete(Request $request, $id, $p_id, $p_jml)
    {
        $cek_stok = Pakan::whereId($p_id)->value('stok'); 
        $total = $cek_stok - $p_jml;
        $update_stok = Pakan::whereId($p_id)->update(['stok' => $total]);
        
        $pakan_in = PakanMasuk::whereId($id)->delete();

        return redirect('/stok-pakan')->with('toast_warning','Data berhasil dihapus!');
    }

    public function trash()
    {
    	$stok_trash = PakanMasuk::join('pakan', 'pakan.id', '=', 'pakan_masuk.id_pakan')
                      ->select('pakan_masuk.*', 'pakan.nama', 'pakan.perusahaan')
                      ->onlyTrashed()
                      ->get();
    	return view('admin.stok.trash', compact('stok_trash'));
    }

    public function restore(Request $request, $id, $p_id, $p_jml)
    {
        $cek_stok = Pakan::whereId($p_id)->value('stok'); 
        $total = $cek_stok + $p_jml;
        $update_stok = Pakan::whereId($p_id)->update(['stok' => $total]);
        
        $restore = PakanMasuk::onlyTrashed()->where('id',$id);
    	$restore->restore();

    	return redirect('/stok-pakan/trash')->with('toast_success', 'Data berhasil dikembalikan!');
    }

    public function delete_kill($id)
    {      
    	$delete = PakanMasuk::onlyTrashed()->where('id',$id);
    	$delete->forceDelete();
 
    	return redirect('/stok-pakan/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function delete_all()
    {
    	$delete = PakanMasuk::onlyTrashed();
    	$delete->forceDelete();
 
    	return redirect('/stok-pakan/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }
}
