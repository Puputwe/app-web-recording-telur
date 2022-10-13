<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Populasi;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Models\Recording;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use DB;

class FormController extends Controller
{
    public function index(){
        
        $populasi = Populasi::where('status', '=', 'produktif')->count();

        $pakan = Pakan::select('stok')->sum('stok');

        $produksi = Produksi::sum('jml_telur');

        $date = date('Y-m-d');
        $telur_today = Produksi::where('tgl_produksi', '=', $date)->sum('jml_telur');

        $produktif = Populasi::where('status', '=', 'produktif')->get()->count();
        $afkir = Populasi::where('status', '=', 'afkir')->get()->count();
        $mati = Populasi::where('status', '=', 'mati')->get()->count();
        $pakan_keluar = Recording::sum('jml_pakan');

        $hari = Produksi::select(DB::raw("DATE(tgl_produksi) as date"))
        ->GroupBy(DB::raw("DATE(tgl_produksi)"))
        ->pluck('date');
        
        $telur = Produksi::select(DB::raw("CAST(SUM(jml_telur) as int) as jml_telur"))
        ->GroupBy(DB::raw("DATE(tgl_produksi)"))
        ->pluck('jml_telur');

        return view('user.dashboard', compact('telur', 'hari','populasi', 'pakan_keluar', 'produktif', 'afkir', 'mati', 'pakan', 'produksi', 'telur_today'));
    }
    
    public function produksiTelur(Request $request){

        $kandang = Kandang::where('status', '=', 'aktif')->get();
        $produksi = Produksi::join('populasi', 'populasi.id', '=', 'produksi.id_populasi')
                ->join('kandang', 'kandang.id', '=', 'produksi.id_kandang')
                ->OrderBy('tgl_produksi', 'asc')
                ->select('produksi.*', 'kandang.kd_kandang', 'populasi.kd_ayam')
                ->get();

        $id_kandang = $request->id_kandang;
        $get_kandang    = Kandang::where('id', $id_kandang)->select('kd_kandang')->get();
        $populasi = Populasi::where('id_kandang', $id_kandang)->where('status', '=', 'produktif')->get();

        return view('user.recording.produksi', compact('kandang', 'populasi', 'id_kandang', 'get_kandang', 'produksi'));
    }

    public function qrScanner(){

        $kandang = Kandang::where('status', '=', 'aktif')->get();

        $date = date('Y-m-d');
        $populasi =  $produksi = Produksi::join('populasi', 'populasi.id', '=', 'produksi.id_populasi')
        ->join('kandang', 'kandang.id', '=', 'produksi.id_kandang')
        ->where('tgl_produksi', '=', $date)
        ->select('produksi.*', 'kandang.kd_kandang', 'populasi.kd_ayam')
        ->get();

        return view('user.recording.qrscanner', compact('kandang', 'populasi', 'produksi'));
    }

    public function formProduksi($id)
    {
       // $enkripsi= Crypt::decrypt($id);
        
        $populasi = Populasi::where('id', $id)->first();

        $total_telur = Produksi::where('id_populasi', $id)->sum('jml_telur');
        if($populasi){
            return view('user.recording.add_produksi', compact('populasi', 'total_telur'));  
          }else{
            return back()->with('warning', 'Qr Code tidak terdaftar!');  
          }
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

        return redirect('/scan/produksi')->with('toast_success', 'Data berhasil ditambahkan!');      
    }

    public function storeAll(Request $request)
    {

        $id_users    = $request->id_users;
        $id_populasi = $request->id_populasi;
        $id_kandang  = $request->id_kandang;
        $jml_telur   = $request->jml_telur;
        $keterangan  = $request->keterangan;

        for ($i=0; $i < count($id_populasi); $i++) {
                $data = [
                   'id_users'  => $id_users[$i],
                   'id_populasi'  => $id_populasi[$i],
                   'id_kandang'   => $id_kandang[$i],
                   'jml_telur'    => $jml_telur[$i],
                   'keterangan'   => $keterangan[$i],
                ];
                DB::table('produksi')->insert($data);
        }
       
        return redirect('/produksi/telur')->with('toast_success', 'Data berhasil ditambahkan!');      
    }

    public function createPerforma(Request $request)
    {
        $kandang = Kandang::where('status', '=', 'aktif')->get();
        $pakan   = Pakan::all();
        $user    = User::all();

        return view('user.recording.performa', compact('kandang', 'pakan', 'user'));
    }

    public function storePerforma(Request $request)
    {
        $pakan = Pakan::find($request->id_pakan);
        
        if($pakan->stok < $request->jml_pakan)
        {
            return redirect('/recording/performa')->with('warning', 'Jumlah pakan melebihi stok!');
        }
        else
        {
        $recording = new Recording;
        $recording->id_users    = $request->input('id_users');
        $recording->id_kandang  = $request->input('id_kandang');
        $recording->id_pakan    = $request->input('id_pakan');
        $recording->tanggal     = $request->input('tanggal');
        $recording->jml_telur   = $request->input('jml_telur');
        $recording->berat_telur = $request->input('berat_telur');
        $recording->jml_pakan   = $request->input('jml_pakan');
        $recording->ayam_hidup  = $request->input('ayam_hidup');
        $recording->ayam_afkir  = $request->input('ayam_afkir');
        $recording->ayam_mati   = $request->input('ayam_mati');
        $recording->hd          = $request->input('hd');
        $recording->fcr         = $request->input('fcr');
        $recording->save();
        }

        $pakan->stok -= $request->jml_pakan;
        $pakan->save();

        return redirect('/recording/performa')->with('success', 'Data berhasil di submit!');
    } 

    public function ajaxPerforma(Request $request)
    {

        $id_kandang['id_kandang'] = $request->id_kandang;
        $ajax_kandang             = Kandang::where('id', $id_kandang)->get();

        $id_pakan['id_pakan'] = $request->id_pakan;
        $ajax_pakan           = Pakan::where('id', $id_pakan)->get();

        return view('user.recording.ajax', compact('ajax_kandang', 'ajax_pakan'));
    }

    public function laporanPerforma(Request $request)
    {

        $recording = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                    ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                    ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                    ->get();

        $kandang = Kandang::where('status', '=', 'aktif')->get();
        $pakan   = Pakan::all();
        $id_kandang = $request->id_kandang;
        $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                  ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                  ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                  ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
                  ->get();
        
        return view('user.laporan.laporan', compact('recording', 'kandang', 'pakan', 'result', 'id_kandang'));
    }

    public function searchLaporan(Request $request)
    {
        $recording = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                    ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                    ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                    ->get();

        $kandang = Kandang::where('status', '=', 'aktif')->get();
        $fromDate = $request->input('fromDate');
        $toDate   = $request->input('toDate');

        $id_kandang = $request->id_kandang;
         if($request->id_kandang)
         {
             $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                       ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                       ->where('id_kandang', 'LIKE', '%'.$request->id_kandang.'%')
                       ->get();
         }
         if( $request->fromDate && $request->toDate ){
             $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                       ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                       ->where('tanggal', '>=', $request->fromDate)
                       ->where('tanggal', '<=', $request->toDate)
                       ->get();
         }
         if($request->id_kandang && $request->fromDate && $request->fromDate )
         {
             $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                       ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                       ->where('id_kandang', 'LIKE', '%'.$request->id_kandang.'%')
                       ->where('tanggal', '>=', $request->fromDate)
                       ->where('tanggal', '<=', $request->toDate)
                       ->get();
         }
        
        return view('user.laporan.laporan', compact('recording', 'result', 'kandang'));
    }

    public function laporanGrafik(Request $request)
    {

        $populasi = Produksi::join('Populasi', 'populasi.id', '=', 'produksi.id_populasi')
        ->select('produksi.*', 'populasi.kd_ayam')
        ->get();
        $kandang = Kandang::where('status', '=', 'aktif')->get();

        $id_kandang = $request->id_kandang;

        $get_kandang    = Kandang::where('id', $id_kandang)->select('kd_kandang')->get();
        $standart_hd = Recording::select(DB::raw("CAST(SUM(hd) as int) as hd"))
        ->GroupBy(DB::raw("DATE(tanggal)"))
        ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
        ->pluck('hd');

        $standart_fcr = Recording::select(DB::raw("CAST(SUM(fcr) as int) as fcr"))
        ->GroupBy(DB::raw("DATE(tanggal)"))
        ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
        ->pluck('fcr');

        $bulan = Recording::select(DB::raw("DATE(tanggal) as date"))
        ->GroupBy(DB::raw("DATE(tanggal)"))
        ->pluck('date');

        $ayam = Populasi::select('kd_ayam')
        ->GroupBy(DB::raw("kd_ayam"))
        ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
        ->pluck('kd_ayam');

        $telur = produksi::select(DB::raw("CAST(SUM(jml_telur) as int) as telur"))
        ->GroupBy(DB::raw("id_populasi", "asc"))
        ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
        ->pluck('telur');

        return view('user.laporan.grafik', compact('populasi', 'ayam', 'kandang', 'telur', 'standart_hd', 'standart_fcr', 'bulan', 'get_kandang', 'id_kandang'));
    }
    

}
