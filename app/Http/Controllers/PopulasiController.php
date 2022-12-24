<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PopulasiImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Populasi;
use App\Models\Kandang;
use App\Models\Produksi;
use Str;
use Validator;
Use Alert;
use DB;

date_default_timezone_set('Asia/Jakarta');

class PopulasiController extends Controller
{
    public function index(Request $id)
    {
        $populasi = Populasi::join('kandang', 'kandang.id', '=', 'populasi.id_kandang')
                    ->select('populasi.*', 'kandang.kd_kandang')
                    ->get();
        $kandang = Kandang::all();
        
        $total_telur = produksi::select(DB::raw("CAST(SUM(jml_telur) as int) as telur"))
        ->GroupBy(DB::raw("id_populasi", "asc"))
        ->get('telur');

        return view('menu.populasi.index', compact('populasi', 'kandang', 'total_telur')); 

    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'kd_ayam'    => 'required|unique:populasi'
        ]);
        
        $kandang= Kandang::all();

        $populasi = new Populasi;
        $populasi->id_kandang    = $request->input('id_kandang');
        $populasi->kd_ayam       = $request->input('kd_ayam');
        $populasi->tgl_tetas     = $request->input('tgl_tetas');
        $populasi->status_aym        = $request->input('status_aym');
        $populasi->save();

        return back()->with('toast_success', 'Data berhasil ditambahkan!');
          
    }

    public function edit($id)
    {
        $populasi = Populasi::find($id);
    }

    public function update(Request $request, $id)
    {
        $kandang = Kandang::all();

        $populasi = Populasi::find($id);
        $populasi->kd_ayam       = $request->input('kd_ayam');
        $populasi->id_kandang    = $request->input('id_kandang');
        $populasi->tgl_tetas     = $request->input('tgl_tetas');
        $populasi->status_aym        = $request->input('status_aym');
        $populasi->update();

        return back()->with('toast_info', 'Data berhasil diupdate!');
        
    }

    public function delete($id)
    {
        $populasi = Populasi::find($id);
        $populasi->delete();

        return back()->with('toast_warning', 'Data berhasil dihapus!');
    }

    public function trash()
    {
    	$populasi_trash = Populasi::join('kandang', 'kandang.id', '=', 'populasi.id_kandang')
                            ->select('populasi.*', 'kandang.kd_kandang')
                            ->onlyTrashed()
                            ->get();
    	return view('menu.populasi.trash', compact('populasi_trash'));
    }

    public function restore($id)
    {
        $restore = Populasi::onlyTrashed()->where('id',$id);
    	$restore->restore();

    	return redirect('/populasi/trash')->with('toast_success', 'Data berhasil dikembalikan!');
    }

    public function delete_kill($id)
    {      
    	$delete = Populasi::onlyTrashed()->where('id',$id);
    	$delete->forceDelete();
 
    	return redirect('/populasi/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function delete_all()
    {
    	$delete = Populasi::onlyTrashed();
    	$delete->forceDelete();
 
    	return redirect('/populasi/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function importpopulasi(Request $request)
    {   
        $file = $request->file('file');
        $namaFile = rand() . $file->getClientOriginalName();
        $file->move('DataPopulasi', $namaFile);

        Excel::import(new PopulasiImport, public_path('/DataPopulasi/'.$namaFile));
        return redirect()->back()->with('success', 'Data Populasi Berhasil Diimport!');
    }
}