<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=0.1">
	<title>Recording Telur</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="background-color: white" onload="window.print()">
	
    <style>
	.line-title{
        border: 0;
        border-style: inset;
        border-top: 1px solid #000;
        font-family: 'Times New Roman', Times, serif;
    }
	</style>

<div class="row">
    <div class="col-12">
            <div class="card-body">
                <table style="width: 100%; margin-bottom: 1cm">
                    <tr>
                        <td align="center">
                            <span style="line-height: 1.6; font-weight:bold;">
                                CATATAN HARIAN TELUR AYAM 
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <span style="line-height: 1.6; font-weight:bold;">
                                KWT KEMBANG WONO
                            </span>
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; margin-bottom: 1cm" border="0">
                     <tr>
                        @foreach ($get_kandang as $k )
                         <th>Kandang</th>
                         <td>:</td>
                         <td>{{$k->kd_kandang}}</td>
                         @endforeach
                         <th>Total Telur</th>
                         <td>:</td>
                         <td>{{$total_telur}} Butir</td>
                     </tr>
                     <tr>
                         <th>Populasi Awal</th>
                         <td>:</td>
                         <td>{{$get_populasi}} Ekor</td>
                         <th>Berat  Telur Total</th>
                         <td>:</td>
                         <td>{{$berat_telur}} Kg</td>
                     </tr>
                     <tr>
                        @if ($tgl_awal AND $tgl_akhir)                    
                            <th>Periode</th>
                            <td>:</td>
                            <td>{{ date('d F Y', strtotime($tgl_awal)) }} s/d {{ date('d F Y', strtotime($tgl_akhir))}}</td> 
                        @else
                            <th>Periode</th>
                            <td>:</td>
                            <td>-</td>
                        @endif
                       <th>Total Pakan</th>
                       <td>:</td>
                       <td>{{$total_pakan}} Kg</td>
                   </tr>
            </table>

            <table class="table table-bordered" >
                    <thead align="center">
                        <tr>
                            <th rowspan="2">Kandang</th>
                            <th rowspan="2">Tanggal</th>
                            <th class="text-center" colspan="3">Populasi</th>
                            <th class="text-center" colspan="2">Pakan</th>
                            <th class="text-center" colspan="2">Produksi Telur</th>
                            <th rowspan="2">HD</th>
                            <th rowspan="2">FCR</th>
                        </tr>
                        <tr>
                            <th>Hidup</th>
                            <th>Afkir</th>
                            <th>Mati</th>
                            <th>Jenis</th>
                            <th>Total</th>
                            <th>Jumlah</th>
                            <th>Berat</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach ($recording as $item )
                        <tr>
                            <td>{{$item->kd_kandang}}</td>
                            <td>{{date('d-m-Y', strtotime($item->tanggal))}}</td>
                            <td>{{$item->ayam_hidup}}</td>
                            <td>{{$item->ayam_afkir}}</td>
                            <td>{{$item->ayam_mati}}</td>
                            <td>{{$item->jenis}}</td>
                            <td>{{number_format($item->jml_pakan)}} Kg</td>
                            <td>{{$item->jml_telur}} Butir</td>
                            <td>{{$item->berat_telur}} Kg</td>
                            <td>{{number_format($item->hd)}} %</td>
                            <td>{{number_format($item->fcr)}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>