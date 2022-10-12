<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProduksiExport;
use App\Imports\ProduksiImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Populasi;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Models\User;
use Str;
Use Alert;
use DB;

date_default_timezone_set('Asia/Jakarta');

class ProduksiController extends Controller
{
    public function index(Request $request)
    {
        $produksi = Produksi::join('populasi', 'populasi.id', '=', 'produksi.id_populasi')
                    ->join('kandang', 'kandang.id', '=', 'produksi.id_kandang')
                    ->join('users', 'users.id', '=', 'produksi.id_users')
                    ->select('produksi.*', 'kandang.kd_kandang', 'populasi.kd_ayam', 'users.name')
                    ->get();

        $kandang = Kandang::where('status', '=', 'aktif')->get();

        $populasi = Populasi::where('status', '=', 'produktif')->get();

        return view('admin.produksi.index', compact('produksi', 'populasi', 'kandang')); 

    }

    public function store(Request $request)
    {
        $produksi = new Produksi;
        $produksi->id_users  = $request->input('id_users');
        $produksi->id_populasi  = $request->input('id_populasi');
        $produksi->id_kandang  = $request->input('id_kandang');
        $produksi->tgl_produksi = $request->input('tgl_produksi');
        $produksi->jml_telur   = $request->input('jml_telur');
        $produksi->keterangan  = $request->input('keterangan');
        $produksi->save();

        return redirect('/produksi')->with('toast_success', 'Data berhasil ditambahkan!');      
    }

    public function delete($id)
    {
       
        $produksi = Produksi::whereId($id)->delete();


        return redirect('/produksi')->with('toast_warning', 'Data berhasil dihapus!');
    }

    public function trash()
    {
    	$produksi_trash = Produksi::join('populasi', 'populasi.id', '=', 'produksi.id_populasi')
                            ->join('kandang', 'kandang.id', '=', 'produksi.id_kandang')
                            ->select('produksi.*', 'kandang.kd_kandang', 'populasi.kd_ayam')
                            ->onlyTrashed()
                            ->get();
    	return view('admin.produksi.trash', compact('produksi_trash'));
    }

    public function restore($id)
    {
        $restore = Produksi::onlyTrashed()->where('id',$id);
    	$restore->restore();

    	return redirect('/produksi/trash')->with('toast_success', 'Data berhasil dikembalikan!');
    }

    public function delete_kill($id)
    {      
    	$delete = Produksi::onlyTrashed()->where('id',$id);
    	$delete->forceDelete();
 
    	return redirect('/produksi/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function delete_all()
    {
    	$delete = Produksi::onlyTrashed();
    	$delete->forceDelete();
 
    	return redirect('/produksi/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function produksi_export()
    {   
        return Excel::download(new ProduksiExport, 'produksi.xlsx');
    }

    public function produksi_import(Request $request)
    {  
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_import', $nama_file);
        Excel::import(new ProduksiImport, public_path('/file_import/' . $nama_file));

        return redirect()->back()->with('success', 'Data Produksi Berhasil Diimport!');
    }

}
