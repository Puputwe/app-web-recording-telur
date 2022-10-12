@extends('layouts.master')
@section('heading', 'Stok Pakan')
@section('page')
  <li class="breadcrumb-item active">Stok Pakan</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="/stok-pakan/delete_all" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
                 </div>
                <div class="card-body">   
                <table id="pakanIn-datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pakan</th>
                            <th>Perusahaan</th>
                            <th>Jumlah Pakan Masuk</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php $no=1; @endphp
                        @foreach ($stok_trash as $data )
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->perusahaan}}</td>
                            <td>{{number_format($data->jml_pakan)}} Kg</td>
                            <td>{{ date('d F Y', strtotime($data->tgl_masuk))}}</td>
                            <td>
                                <a href="/stok-pakan/{{$data->id}}/{{$data->id_pakan}}/{{$data->jml_pakan}}/restore" class="btn btn-success btn-sm">Restore</a>
								<a href="/stok-pakan/delete_kill/{{$data->id}}" class="btn btn-danger btn-sm">Hapus Permanen</a>
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
    $('#pakanIn-datatable').DataTable();
  } );
  </script>

@endsection