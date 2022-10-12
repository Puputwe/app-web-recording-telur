<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PopulasiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Kandang;
use App\Models\Populasi;
use App\Models\Produksi;
use Str;
use DB;
Use Alert;

date_default_timezone_set('Asia/Jakarta');

class KandangController extends Controller
{
    public function index()
    {
        $kandang = Kandang::all();

        return view('admin.kandang.index', compact('kandang')); 
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kd_kandang'    => 'required|unique:kandang',
        ], [
            'kd_kandang.required' => 'Kode kandang sudah terdaftar',
        ]); 

        $kandang = new Kandang;
        $kandang->kd_kandang    = $request->input('kd_kandang');
        $kandang->tgl_chickin   = $request->input('tgl_chickin');
        $kandang->kapasitas     = $request->input('kapasitas');
        $kandang->status        = 'aktif';
        $kandang->save();

        return redirect('/kandang')->with('toast_success', 'Data berhasil ditambahkan!');

    }

    public function edit($id)
    {
        $kandang = Kandang::find($id);

    }

    public function update(Request $request, $id)
    {
        $kandang = Kandang::find($id);
        $kandang->kd_kandang    = $request->input('kd_kandang');
        $kandang->tgl_chickin   = $request->input('tgl_chickin');
        $kandang->kapasitas     = $request->input('kapasitas');
        $kandang->update();

        return redirect('/kandang')->with('toast_info', 'Data berhasil diupdate!');
 
    }

    public function delete($id)
    {
        $kandang = Kandang::find($id);
        $kandang->delete();

        return redirect('/kandang')->with('toast_warning', 'Data berhasil dihapus!');
    }

    public function trash()
    {
    	$kandang_trash = Kandang::onlyTrashed()->get();
    	return view('admin.kandang.trash', compact('kandang_trash'));
    }

    public function restore($id)
    {
        $restore = Kandang::onlyTrashed()->where('id',$id);
    	$restore->restore();

    	return redirect('/kandang/trash')->with('toast_success', 'Data berhasil dikembalikan!');
    }

    public function delete_kill($id)
    {      
    	$delete = Kandang::onlyTrashed()->where('id',$id);
    	$delete->forceDelete();
 
    	return redirect('/kandang/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function delete_all()
    {
    	$delete = Kandang::onlyTrashed();
    	$delete->forceDelete();
 
    	return redirect('/kandang/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function upStatus($id)
    { 
        $kandang = \DB::table('kandang')->where('id', $id)->first();

        $status_sekarang = $kandang->status;

        if($status_sekarang == 'aktif'){
            \DB::table('kandang')->where('id', $id)->update([
                'status'=>'non-aktif'
            ]);
            return redirect('/kandang')->with('warning', 'Status Kandang Tidak Atif!');
        }else{
            \DB::table('kandang')->where('id', $id)->update([
                'status'=> 'aktif'
            ]);
        }
        return redirect('/kandang')->with('success', 'Status Kandang Aktif');
    }
    
    public function detail($id)
    {
        $kandang = Kandang::where('id', $id)->where('status', '=', 'aktif')->get();
        $info = Kandang::where('id', $id)->get();
        $populasi = Populasi::OrderBy('id', 'asc')->where('id_kandang',  $id)->get();
        $produktif = Populasi::where('id_kandang', $id)->where('status', '=', 'produktif')->get()->count();
        $afkir = Populasi::where('id_kandang', $id)->where('status', '=', 'afkir')->get()->count();
        $mati = Populasi::where('id_kandang', $id)->where('status', '=', 'mati')->get()->count();
        $telur = Produksi::where('id_kandang', $id)->sum('jml_telur');
        $total_telur = Produksi::where('id_populasi', $id)->sum('jml_telur');
 
        return view('admin.kandang.detail', compact('kandang', 'populasi', 'info', 'produktif', 'afkir', 'mati', 'telur', 'total_telur')); 

    }

    public function populasiexport(Request $request)
    {   
        return Excel::download(new PopulasiExport($request->id), 'populasi.xlsx');
    }

    public function cetak_populasi($id)
    {
        $info = Kandang::where('id', $id)->get();
        $populasi = Populasi::OrderBy('kd_ayam', 'asc')->where('id_kandang',  $id)->get();
        $produktif = Populasi::where('id_kandang', $id)->where('status', '=', 'produktif')->get()->count();
        $afkir = Populasi::where('id_kandang', $id)->where('status', '=', 'afkir')->get()->count();
        $mati = Populasi::where('id_kandang', $id)->where('status', '=', 'mati')->get()->count();
        $telur = Produksi::where('id_kandang', $id)->sum('jml_telur');


        return view('admin.kandang.cetak_populasi', compact('populasi', 'info', 'produktif', 'afkir', 'mati', 'telur'));
    }
}
