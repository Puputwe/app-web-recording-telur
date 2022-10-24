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
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
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

        return view('menu.produksi.index', compact('produksi', 'populasi', 'kandang')); 

    }

    public function store(Request $request)
    {
        $date = date('Y-m-d');
        
        $produksi = new Produksi;
        $produksi->id_users    = $request->input('id_users');
        $produksi->id_populasi = $request->input('id_populasi');
        $produksi->id_kandang  = $request->input('id_kandang');
        $produksi->jml_telur   = $request->input('jml_telur');
        $produksi->keterangan  = $request->input('keterangan');
        $produksi->tgl_produksi = $date;
        $produksi->save();

        return redirect('/produksi')->with('toast_success', 'Data berhasil ditambahkan!');      
    }

    public function store_all(Request $request)
    {

        $id_users    = $request->id_users;
        $id_populasi = $request->id_populasi;
        $id_kandang  = $request->id_kandang;
        $jml_telur   = $request->jml_telur;

        for ($i=0; $i < count($id_populasi); $i++) {
                $data = [
                   'id_users'  => $id_users[$i],
                   'id_populasi'  => $id_populasi[$i],
                   'id_kandang'   => $id_kandang[$i],
                   'jml_telur'    => $jml_telur[$i],
                ];
                DB::table('produksi')->insert($data);
        }
       
        return redirect('/produksi')->with('toast_success', 'Data berhasil ditambahkan!');      
    }

    public function qrScannerAyam(){

        $kandang = Kandang::where('status', '=', 'aktif')->get();

        return view('menu.produksi.qrscanner', compact('kandang'));
    }

    public function qrScannerKandang(){

        $kandang = Kandang::where('status', '=', 'aktif')->get();

        return view('menu.produksi.qr_scanner', compact('kandang'));
    }

    public function form_ayam($id)
    {
        $enkripsi= Crypt::decrypt($id);
        
        $populasi = Populasi::where('id', $enkripsi)->first();

        $total_telur = Produksi::where('id_populasi', $enkripsi)->sum('jml_telur');
        if($populasi){
            return view('menu.produksi.add_produksi', compact('populasi', 'total_telur'));  
          }else{
            return back()->with('warning', 'Qr Code tidak terdaftar!');  
          }
    }

    public function form_produksi($id)
    {
        $enkripsi = Crypt::decrypt($id);
        
        $get_kandang    = Kandang::where('id', $enkripsi)->select('kd_kandang')->get();
        $populasi = Populasi::where('id_kandang', $enkripsi)->where('status', '=', 'produktif')->get();

        $kandang = Kandang::where('id', $enkripsi)->first();

        if($kandang){
            return view('menu.produksi.produksi', compact('kandang', 'get_kandang', 'populasi'));  
          }else{
            return back()->with('warning', 'Maaf, kode QR tidak terdaftar!');  
          }
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
    	return view('menu.produksi.trash', compact('produksi_trash'));
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
