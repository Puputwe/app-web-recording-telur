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
                      <a href="/stok-pakan/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Tambah Data</a>
                 </div>
                <div class="card-body">  
                <div class="table-responsive"> 
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
                        @foreach ($pakan_in as $in )
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$in->nama}}</td>
                            <td>{{$in->perusahaan}}</td>
                            <td>{{number_format($in->jml_pakan)}} Kg</td>
                            <td>{{ date('d F Y', strtotime($in->tgl_masuk))}}</td>
                            <td>
                              <a href="#" class="btn btn-danger btn-sm delete-in" pakanid="{{$in->id_pakan}}" pakanjml="{{$in->jml_pakan}}" pakanIn-id="{{$in->id}}"><i class="nav-icon fas fa-trash"></i></a>
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
    $('.delete-in').click(function(){
      var pakanIn_id = $(this).attr('pakanIn-id');
      var pakanid = $(this).attr('pakanid');
      var pakanjml = $(this).attr('pakanjml');
      swal({
        title: "Hapus Pakan Masuk",
        text: "Yakin akan menghapus data pakan masuk ini ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        console.log(willDelete);
        if (willDelete) {
            window.location = "/stok-pakan/"+pakanIn_id+"/"+pakanid+"/"+pakanjml+"/delete"
        }
      });
    });
  </script>

  <script>
    $(document).ready( function () {
    $('#pakanIn-datatable').DataTable();
  } );
  </script>

@endsection