<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=0.1">
	<title>Daftar Populasi</title>
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
                <table style="width: 100%;">
                    <tr>
                        <td align="center">
                            <span style="line-height: 1.6; font-weight:bold;">
                                RECORDING TELUR AYAM KWT KEMBANG WONO
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <span style="line-height: 1.6; font-weight:bold;">
                                DAFTAR POPULASI
                            </span>
                        </td>
                    </tr>
                </table>
                
                 <div>
                    <table style="width: 100%; margin: 1cm;" border="0">
                        @foreach ($info as $d )
                         <tr>
                             <th>Kandang</th>
                             <td>:</td>
                             <td>{{$d->kd_kandang}}</td>
                             <th>Ayam Produktif</th>
                             <td>:</td>
                             <td>{{$produktif}} Ekor</td>
                         </tr>
                         <tr>
                             <th> Tanggal ChickIn</th>
                             <td>:</td>
                             <td>{{date('d F Y', strtotime($d->tgl_chickin))}}</td>
                             <th>Ayam Afkir</th>
                             <td>:</td>
                             <td>{{$afkir}} Ekor</td>
                         </tr>
                         <tr>
                             <th>Kapasitas</th>
                             <td>:</td>
                             <td>{{$d->kapasitas}}</td>
                             <th>Ayam Mati</th>
                             <td>:</td>
                             <td>{{$mati}} Ekor</td>
                         </tr>
                         <tr>
                           <th>Status Kandang</th>
                           <td>:</td>
                           <td>{{$d->status}}</td>
                           <th>Total Telur</th>
                           <td>:</td>
                           <td>{{$telur}} Butir</td>
                       </tr>
                       @endforeach
                </table>
            </div>
            <table class="table table-bordered" >
                <thead align="center">
                    <tr>
                        <th>No</th>
                        <th>Kode Ayam</th>
                        <th>Umur</th>
                        <th>QR Code</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php $no=1; @endphp
                    @foreach ($populasi as $data )
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$data->kd_ayam}}</td>
                        <td>{{\Carbon\Carbon::parse($data->tgl_tetas)->diffInDays()}} Hari</td>
                        <td class="text text-center">{!! QrCode::size(100)->generate(Crypt::encrypt($data->id)); !!}</td>
                        <td class="text text-center">{{$data->status_aym}}</td>
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