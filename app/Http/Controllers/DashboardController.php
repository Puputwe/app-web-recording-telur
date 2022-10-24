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


            return view('dashboard', compact('telur', 'hari','populasi', 'pakan_keluar', 'produktif', 'afkir', 'mati', 'pakan', 'produksi', 'telur_today'));
    }
}