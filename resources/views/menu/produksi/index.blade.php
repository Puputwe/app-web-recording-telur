@extends('layouts.master')
@section('heading', 'Produksi')
@section('page')
  <li class="breadcrumb-item active">Produksi</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-olive card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                      @if(auth()->user()->role_id == 2)
                      <a href="{{ route('qrScanner') }}" class="btn btn-primary btn-sm" style="float: left;">
                        <i class="fa fa-qrcode"></i> Ayam
                      </a>
                      <a href="{{ route('QR_Scanner') }}" class="btn btn-danger btn-sm" style="float: left; margin-left: 4px;">
                        <i class="fa fa-qrcode"></i> Kandang
                      </a>
                      @else
                      <h3 class="text text-right">
                        <a href="/produksi/produksi_export" class="btn btn-success btn-sm" style="float: right;">
                          Export 
                        </a>
                        <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right: 4px; margin-left: 4px;" data-toggle="modal" data-target="#importModalproduksi"> 
                          Import
                        </button>
                      @endif
                    {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModalproduksi">
                      <i class="fa fa-plus"></i>  
                      Data
                    </button> --}}
                 </div>
                <div class="card-body">   
                <div class="table-responsive">
                @if(auth()->user()->role_id == 2)
                <table id="produksi-datatable" class="table table-bordered" style="width:100%">
                  <thead>
                      <tr class="table-secondary">
                          <th>No</th>
                          <th>Kode Ayam</th>
                          <th>Tanggal Produksi</th>
                          <th>Telur</th>
                          <th>Keterangan</th>
                      </tr>
                  </thead>
                  <tbody>
                     @php $no=1; @endphp
                      @foreach ($produksi as $data )
                      <tr>
                        <td>{{$no++}}</td>
                          <td>{{$data->kd_ayam}}</td>
                          <td>{{date('d-m-Y', strtotime($data->tgl_produksi))}}</td>
                          <td>{{$data->jml_telur}} Butir</td>
                          <td>{{$data->keterangan}}</td>
                      </tr>
                          @endforeach
                  </tbody>
                </table>
                @else
                <table id="produksi-datatable" class="table table-bordered" style="width:100%">
                  <thead>
                      <tr class="table-secondary">
                          <th>No</th>
                          <th>Petugas</th>
                          <th>Kode Ayam</th>
                          <th>Tanggal Produksi</th>
                          <th>Telur</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                     @php $no=1; @endphp
                      @foreach ($produksi as $data )
                      <tr>
                        <td>{{$no++}}</td>
                          <td>{{$data->name}}</td>
                          <td>{{$data->kd_ayam}}</td>
                          <td>{{date('d-m-Y', strtotime($data->tgl_produksi))}}</td>
                          <td>{{$data->jml_telur}} Butir</td>
                          <td>{{$data->keterangan}}</td>
                          <td>
                          <a href="#" class="btn btn-danger btn-sm delete-in" produksi_id="{{$data->id}}"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                          </td>
                      </tr>
                          @endforeach
                  </tbody>
                </table>
                @endif
                </div>
              </div>

                {{-- Modal Tambah Data --}}
                <div class="modal fade" id="addModalproduksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="/produksi/store" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold text-small">Tanggal Produksi<span class="text-olive ml-1">*</span></label>
                                    <input type="date" name="tgl_produksi" class="form-control" id="tgl_produksi" required>
                                </div>
                                <div class="form-group">
                                  <label class="font-weight-bold text-small">Kode Kandang<span class="text-olive ml-1">*</span></label>
                                  <select name="id_kandang" class="form-control" id="id_kandang" required>
                                      <option value="">-- Kode Kandang --</option>
                                      @foreach ($kandang as $k)
                                          <option value="{{ $k->id }}">{{ $k->kd_kandang}}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-small">Kode Ayam<span class="text-olive ml-1">*</span></label>
                                    <select name="id_populasi" class="form-control" id="id_populasi" required>
                                        <option value="">-- Kode Ayam --</option>
                                        @foreach ($populasi as $k)
                                            <option value="{{ $k->id }}">{{ $k->kd_ayam}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-small">Bertelur ?<span class="text-olive ml-1">*</span></label>
                                    <div>
                                    <input type="checkbox" name="jml_telur" value="1">  Ya
                                    <input type="checkbox" name="jml_telur" value="0">  Tidak
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <textarea type="text"  name="keterangan" class="form-control" id="keterangan"
                                        placeholder="*anda dapat memberikan catatan berupa kondisi ayam saat ini"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                  </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div> 

                  {{-- Import Modal --}}
               <div class="modal fade" id="importModalproduksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('produksi_import') }}" method="post" enctype="multipart/form-data">
                      @csrf
                            <div class="form-group">
                              <input type="file" name="file" id="file">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm">Import</button>
                              </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div> 
@include('sweetalert::alert')
@endsection


@section('footer')
<script>
  $('.delete-in').click(function(){
    var produksi_id = $(this).attr('produksi_id');
    swal({
      title: "Hapus Data Produksi",
      text: "Yakin akan menghapus data produksi ini ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      console.log(willDelete);
      if (willDelete) {
          window.location = "/produksi/"+produksi_id+"/delete"
      }
    });
  });
</script>

  <script>
    $(document).ready( function () {
    $('#produksi-datatable').DataTable();
  } );
  </script>

@endsection