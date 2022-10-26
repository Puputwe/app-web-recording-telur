@extends('layouts.master')
@section('heading', 'Trash Produksi')
@section('page')
  <li class="breadcrumb-item active">Trash Produksi</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-olive card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="/produksi/delete_all" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
                 </div>
                <div class="card-body">   
                <div class="table-responsive">
                <table id="produksi-datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr class="table-secondary">
                            <th>No</th>
                            <th>Kode Ayam</th>
                            <th>Tanggal Produksi</th>
                            <th>Telur</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php $no=1; @endphp
                        @foreach ($produksi_trash as $data )
                        <tr>
                          <td>{{$no++}}</td>
                            <td>{{$data->kd_ayam}}</td>
                            <td>{{date('d-m-Y', strtotime($data->tgl_produksi))}}</td>
                            <td>{{$data->jml_telur}} Butir</td>
                            <td>{{$data->keterangan}}</td>
                            <td>
                              <a href="/produksi/{{$data->id}}/restore" class="btn btn-success btn-sm">Restore</a>
								              <a href="/produksi/delete_kill/{{$data->id}}" class="btn btn-danger btn-sm">Hapus Permanen</a>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection


@section('footer')
  <script>
    $(document).ready( function () {
    $('#produksi-datatable').DataTable();
  } );
  </script>

@endsection