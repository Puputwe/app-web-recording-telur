@extends('layouts.master')
@section('heading', 'Trash Populasi')
@section('page')
  <li class="breadcrumb-item active">Trash Populasi</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-olive card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="/populasi/delete_all" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
                 </div>
                <div class="card-body">   
                  <div class="table-responsive">
                <table id="populasi-datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr class="table-secondary">
                            <th>No</th>
                            <th>Kode Ayam</th>
                            <th>Umur</th>
                            <th>QR Code</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php $no=1; @endphp
                        @foreach ($populasi_trash as $data )
                        <tr>
                          <td>{{$no++}}</td>
                            <td>{{$data->kd_ayam}}</td>
                            <td>{{\Carbon\Carbon::parse($data->tgl_tetas)->diffInDays()}} Hari</td>
                            <td class="text text-center">{!! QrCode::size(50)->generate($data->kd_ayam); !!}</td>
                            <td class="text text-center">
                              @if ($data->status_aym == 'produktif')
                              <span class="badge bg-success" >produktif</span>
                              @elseif ($data->status_aym == 'afkir')
                                  <span class="badge bg-danger">afkir</span>
                              @elseif ($data->status_aym == 'mati')
                                  <span class="badge bg-secondary">mati</span>                                     
                              @endif  
                            </td>
                            <td>
                                <a href="/populasi/restore/{{$data->id}}" class="btn btn-success btn-sm">Restore</a>
                                <a href="/populasi/delete_kill/{{$data->id}}" class="btn btn-danger btn-sm">Hapus Permanen</a>
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
    $('#populasi-datatable').DataTable();
  } );
  </script>

@endsection