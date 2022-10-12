<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RecordingExport;
use App\Exports\RecordingAllExport;
use App\Imports\RecordingImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Recording;
use App\Models\Kandang;
use App\Models\Pakan;
use App\Models\Populasi;
use App\Models\Produksi;
use App\Models\User;
use DB;

date_default_timezone_set('Asia/Jakarta');

class RecordingController extends Controller
{
    public function index(Request $request)
    {
        $recording = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                    ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                    ->join('users', 'pakan.id', '=', 'data_recording.id_pakan')
                    ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis', 'users.name')
                    ->get();

        $kandang = Kandang::where('status', '=', 'aktif')->get();
        $pakan   = Pakan::all();
        $id_kandang = $request->id_kandang;
        $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                  ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                  ->join('users', 'users.id', '=', 'data_recording.id_users')
                  ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis', 'users.name')
                  ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
                  ->get();
        
        return view('admin.recording.index', compact('recording', 'kandang', 'pakan', 'result', 'id_kandang'));
    }
    
    public function create(Request $request)
    {
        $kandang = Kandang::where('status', '=', 'aktif')->get();
        $pakan   = Pakan::all();
        $user    = User::all();

        return view('admin.recording.add', compact('kandang', 'pakan', 'user'));
    }

    public function store(Request $request)
    {
        $pakan = Pakan::find($request->id_pakan);
        
        if($pakan->stok < $request->jml_pakan)
        {
            return redirect('/recording/create')->with('error', 'Jumlah Pakan Melebihi Stok!');
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

        return redirect('/recording')->with('toast_success', 'Data berhasil ditambahkan!');
    } 

    public function delete(Request $request, $id, $p_id, $p_jml)
    {
        $cek_stok = Pakan::whereId($p_id)->value('stok'); 
        $total = $cek_stok + $p_jml;
        $update_stok = Pakan::whereId($p_id)->update(['stok' => $total]);
        
        $recording = Recording::whereId($id)->delete();

        return redirect('/recording')->with('toast_warning', 'Data berhasil dihapus!');
    }

    public function trash()
    {
    	$recording_trash = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                            ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                            ->join('users', 'pakan.id', '=', 'data_recording.id_pakan')
                            ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis', 'users.name')
                            ->onlyTrashed()
                            ->get();
    	return view('admin.recording.trash', compact('recording_trash'));
    }

    public function restore(Request $request, $id, $p_id, $p_jml)
    {
        $cek_stok = Pakan::whereId($p_id)->value('stok'); 
        $total = $cek_stok - $p_jml;
        $update_stok = Pakan::whereId($p_id)->update(['stok' => $total]);
        
        $restore = Recording::onlyTrashed()->where('id',$id);
    	$restore->restore();

    	return redirect('/recording/trash')->with('toast_success', 'Data berhasil dikembalikan!');
    }

    public function delete_kill($id)
    {      
    	$delete = Recording::onlyTrashed()->where('id',$id);
    	$delete->forceDelete();
 
    	return redirect('/recording/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function delete_all()
    {
    	$delete = Recording::onlyTrashed();
    	$delete->forceDelete();
 
    	return redirect('/recording/trash')->with('toast_warning', 'Data berhasil dihapus permanen!');
    }

    public function ajax(Request $request)
    {

        $id_kandang['id_kandang'] = $request->id_kandang;
        $ajax_kandang             = Kandang::where('id', $id_kandang)->get();

        $id_pakan['id_pakan'] = $request->id_pakan;
        $ajax_pakan           = Pakan::where('id', $id_pakan)->get();

        return view('admin.recording.ajax', compact('ajax_kandang', 'ajax_pakan'));
    }

    public function searchRecording(Request $request)
    {
        $recording = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                    ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                    ->join('users', 'pakan.id', '=', 'data_recording.id_pakan')
                    ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis', 'users.name')
                    ->get();

        $kandang = Kandang::where('status', '=', 'aktif')->get();
        $fromDate = $request->input('fromDate');
        $toDate   = $request->input('toDate');

        $id_kandang = $request->id_kandang;
         if($request->id_kandang)
         {
             $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                       ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->join('users', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis', 'users.name')
                       ->where('id_kandang', 'LIKE', '%'.$request->id_kandang.'%')
                       ->get();
         }
         if( $request->fromDate && $request->toDate ){
             $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                       ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->join('users', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis', 'users.name')
                       ->where('tanggal', '>=', $request->fromDate)
                       ->where('tanggal', '<=', $request->toDate)
                       ->get();
         }
         if($request->id_kandang && $request->fromDate && $request->fromDate )
         {
             $result = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                       ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->join('users', 'pakan.id', '=', 'data_recording.id_pakan')
                       ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis', 'users.name')
                       ->where('id_kandang', 'LIKE', '%'.$request->id_kandang.'%')
                       ->where('tanggal', '>=', $request->fromDate)
                       ->where('tanggal', '<=', $request->toDate)
                       ->get();
         }
        
        return view('admin.recording.index', compact('recording', 'result', 'kandang'));
    }

    public function recording_export(Request $request)
    {   
        return Excel::download(new RecordingExport($request->id), 'recording.xlsx');
    }

    public function recording_export_all()
    {   
        return Excel::download(new RecordingAllExport, 'recording_all.xlsx');
    }

    public function recording_import(Request $request)
    {   
        $file = $request->file('file');
        $namaFile = rand() . $file->getClientOriginalName();
        $file->move('file_import', $namaFile);

        Excel::import(new RecordingImport, public_path('/file_import/'.$namaFile));
        return redirect()->back()->with('success', 'Data Recording Berhasil Diimport!');
    }

    public function cetak_recording(Request $request)
    {
         $recording = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                    ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                    ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                    ->get();

        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $id_kandang = $request->id_kandang;

        if($id_kandang AND $tgl_awal AND $tgl_akhir){
            $recording = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                        ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                        ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                        ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
                        ->whereBetween('data_recording.tanggal', [$tgl_awal,$tgl_akhir])
                        ->get();

            $get_kandang    = Kandang::where('id', $id_kandang)->select('kd_kandang')->get();
            $get_populasi   = Populasi::where('id_kandang', $id_kandang)->count();
            $total_telur    = Recording::where('id_kandang', $id_kandang)->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])
                              ->sum('jml_telur');
            $berat_telur    = Recording::where('id_kandang', $id_kandang)->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])
                              ->sum('berat_telur');
            $total_pakan    = Recording::where('id_kandang', $id_kandang)->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])
                              ->sum('jml_pakan');
        }else{
            $recording = Recording::join('kandang', 'kandang.id', '=', 'data_recording.id_kandang')
                        ->join('pakan', 'pakan.id', '=', 'data_recording.id_pakan')
                        ->select('data_recording.*', 'kandang.kd_kandang', 'pakan.nama', 'pakan.jenis')
                        ->where('id_kandang', 'LIKE', '%'.$id_kandang.'%')
                        ->get();
            
            $get_kandang    = Kandang::where('id', $id_kandang)->select('kd_kandang')->get();
            $get_populasi   = Populasi::where('id_kandang', $id_kandang)->count();
            $total_telur    = Recording::where('id_kandang', $id_kandang)
                              ->sum('jml_telur');
            $berat_telur    = Recording::where('id_kandang', $id_kandang)
                              ->sum('berat_telur');
            $total_pakan    = Recording::where('id_kandang', $id_kandang)
                              ->sum('jml_pakan');
            
        }
        return view('admin.recording.cetak_recording', compact('recording', 'tgl_awal', 'tgl_akhir', 'id_kandang', 'get_kandang', 'get_populasi', 'total_telur', 'berat_telur', 'total_pakan'));
    }

    public function grafik(Request $request)
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

        return view('admin.recording.grafik', compact('populasi', 'ayam', 'kandang', 'telur', 'standart_hd', 'standart_fcr', 'bulan', 'get_kandang', 'id_kandang'));
    }
}
