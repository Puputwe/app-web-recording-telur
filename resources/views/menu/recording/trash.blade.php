@extends('layouts.master')
@section('heading', 'Trash Recording')
@section('page')
  <li class="breadcrumb-item active">Trash Recording</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-olive card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                      <a href="/recording/delete_all" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
                 </div>
                <div class="card-body"> 
                <div class="table-responsive">
                <table id="recording-datatable" class="table table-bordered tabel-sm" style="width:100%">
                    <thead>
                        <tr class="table-secondary">
                            <th rowspan="2">Kandang</th>
                            <th rowspan="2">Tanggal</th>
                            <th class="text-center" colspan="3">Populasi</th>
                            <th class="text-center" colspan="2">Pakan</th>
                            <th class="text-center" colspan="2">Produksi Telur</th>
                            <th rowspan="2">HD</th>
                            <th rowspan="2">FCR</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr class="table-secondary"> 
                            <th>Hidup</th>
                            <th>Afkir</th>
                            <th>Mati</th>
                            <th>Jenis</th>
                            <th>Total</th>
                            <th>Jumlah</th>
                            <th>Berat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recording_trash as $data )
                        <tr>
                            <td>{{$data->kd_kandang}}</td>
                            <td>{{date('d-m-Y', strtotime($data->tanggal))}}</td>
                            <td>{{$data->ayam_hidup}}</td>
                            <td>{{$data->ayam_afkir}}</td>
                            <td>{{$data->ayam_mati}}</td>
                            <td>{{$data->jenis}}</td>
                            <td>{{number_format($data->tot_pakan)}} Kg</td>
                            <td>{{$data->tot_telur}} Butir</td>
                            <td>{{$data->berat_telur}} Kg</td>
                            <td>{{number_format($data->hd)}} %</td>
                            <td>{{number_format($data->fcr)}} Kg</td>
                            <td>
                                <a href="/recording/{{$data->id}}/{{$data->id_pakan}}/{{$data->tot_pakan}}/restore" class="btn btn-success btn-sm">Restore</a>
								                <a href="/recording/delete_kill/{{$data->id}}" class="btn btn-danger btn-sm">Hapus Permanen</a>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table> 
              </div>
            </div>
@include('sweetalert::alert')
@endsection

@section('footer')
  <script>
    $(document).ready( function () {
    $('#recording-datatable').DataTable();
  } );
  </script>

@endsection