<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Populasi;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Models\Recording;
use DB;
use Auth;

date_default_timezone_set('Asia/Jakarta');

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $id_kandang['id_kandang'] = $request->id_kandang;
        
        $kandang = Kandang::all();

            $populasi = Populasi::where('status_aym', '=', 'produktif')->count();

            $pakan = Pakan::select('stok')->sum('stok');

            $produksi = Produksi::sum('jml_telur');

            $date = date('Y-m-d');
            $telur_today = Produksi::where('tgl_produksi', '=', $date)->sum('jml_telur');

            $produktif = Populasi::where('status_aym', '=', 'produktif')->get()->count();
            $afkir = Populasi::where('status_aym', '=', 'afkir')->get()->count();
            $mati = Populasi::where('status_aym', '=', 'mati')->get()->count();
            $pakan_keluar = Recording::sum('tot_pakan');

            $hari = Produksi::select(DB::raw("DATE(tgl_produksi) as date"))
            ->GroupBy(DB::raw("DATE(tgl_produksi)"))
            ->pluck('date');
            
            $telur = Produksi::select(DB::raw("CAST(SUM(jml_telur) as int) as jml_telur"))
            ->GroupBy(DB::raw("DATE(tgl_produksi)"))
            ->pluck('jml_telur');


            return view('dashboard', compact('telur', 'id_kandang', 'kandang', 'hari','populasi', 'pakan_keluar', 'produktif', 'afkir', 'mati', 'pakan', 'produksi', 'telur_today'));
    }

    public function ajax(Request $request)
    {

        $id_kandang['id_kandang'] = $request->id_kandang;
        $ajax_kandang             = Populasi::where('id_kandang', $id_kandang)->where('status_aym', '=', 'produktif')->get()->count();
        
        $kandang    = Kandang::where('id', $id_kandang)->select('kd_kandang')->get();
        
        $date = date('Y-m-d');
        $telur_today = Produksi::where('id_kandang', $id_kandang)->where('tgl_produksi', '=', $date)->sum('jml_telur');

        $produksi = Produksi::sum('jml_telur');

        $pakan = Pakan::select('stok')->sum('stok');

        $hari = Produksi::where('id_kandang', $id_kandang)->select(DB::raw("DATE(tgl_produksi) as date"))
        ->GroupBy(DB::raw("DATE(tgl_produksi)"))
        ->pluck('date');
        
        $telur = Produksi::where('id_kandang', $id_kandang)->select(DB::raw("CAST(SUM(jml_telur) as int) as jml_telur"))
        ->GroupBy(DB::raw("DATE(tgl_produksi)"))
        ->pluck('jml_telur');

        $produktif = Populasi::where('id_kandang', $id_kandang)->where('status_aym', '=', 'produktif')->get()->count();
        $afkir = Populasi::where('id_kandang', $id_kandang)->where('status_aym', '=', 'afkir')->get()->count();
        $mati = Populasi::where('id_kandang', $id_kandang)->where('status_aym', '=', 'mati')->get()->count();
        $pakan_keluar = Recording::sum('tot_pakan');


        return view('ajax', compact('ajax_kandang', 'kandang', 'telur_today', 'produksi', 'pakan', 'hari', 'telur', 'produktif', 'afkir', 'mati', 'pakan_keluar'));
    }

}