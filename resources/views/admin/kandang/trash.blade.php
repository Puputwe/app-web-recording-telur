@extends('layouts.master')
@section('heading', 'Kandang')
@section('page')
  <li class="breadcrumb-item active">Kandang</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="/kandang/delete_all" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
                 </div>
                <div class="card-body">   
                <table id="kandang-datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kandang</th>
                            <th>Tanggal Chickin</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php $no=1; @endphp
                        @foreach ($kandang_trash as $data )
                        <tr>
                          <td>{{$no++}}</td>
                            <td>{{$data->kd_kandang}}</td>
                            <td>{{ date('d F Y', strtotime($data->tgl_chickin))}}</td>
                            <td>{{$data->kapasitas}} Ekor</td>
                            <td>
                                <a href="/kandang/restore/{{$data->id}}" class="btn btn-success btn-sm">Restore</a>
                                <a href="/kandang/delete_kill/{{$data->id}}" class="btn btn-danger btn-sm">Hapus Permanen</a>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
@include('sweetalert::alert')
@endsection

@section('footer')
  <script>
    $(document).ready( function () {
    $('#kandang-datatable').DataTable();
  } );
  </script>

@endsection