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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModalkandang">
                      <i class="fa fa-plus"></i>  
                      Data
                    </button>
                 </div>
                <div class="card-body">   
                <div class="table-responsive">
                <table id="kandang-datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kandang</th>
                            <th>Tanggal Chickin</th>
                            <th>Kapasitas</th>
                            <th>Populasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php $no=1; @endphp
                        @foreach ($kandang as $data )
                        <tr>
                          <td>{{$no++}}</td>
                            <td>{{$data->kd_kandang}}</td>
                            <td>{{ date('d F Y', strtotime($data->tgl_chickin))}}</td>
                            <td>{{$data->kapasitas}} Ekor</td>
                            <td>
                              <a href="/kandang/{{$data->id}}/detail" class="btn btn-info btn-sm"></i>Lihat Populasi</a>
                            </td>
                            <td>
                              @if($data->status == 'aktif')
                              <a href="/kandang/{{$data->id}}/upStatus" class="btn btn-success btn-sm" kandang-id="{{$data->id}}"><i class="nav-icon fas fa-unlock"></i></a>
                               @else
                              <a href="/kandang/{{$data->id}}/upStatus" class="btn btn-secondary btn-sm" kandang-id="{{$data->id}}"><i class="nav-icon fas fa-lock"></i></a>
                              @endif
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModalkandang{{$data->id}}">
                              <i class="fa fa-edit"></i>
                            </button>
                            <a href="#" class="btn btn-danger btn-sm delete" kandang-id="{{$data->id}}"><i class="nav-icon fas fa-trash"></i></a>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
                </div>
              </div>

                {{-- Modal Tambah Data --}}
                <div class="modal fade" id="addModalkandang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="/kandang/store" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label>Kode Kandang</label>
                                  <input type="text" name="kd_kandang" class="form-control" id="kd_kandang" placeholder="XX000" required>
                                  @error('kd_kandang')
                                  <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal ChickIn</label>
                                    <input type="date" name="tgl_chickin" value="{{ old('tgl_chickin') }}" class="form-control" id="tgl_chickin" required>
                                </div>
                                <div class="form-group">
                                    <label>Kapasitas</label>
                                    <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" class="form-control" id="kapasitas" placeholder="0" required>
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

                  
                  {{-- Modal Edit Data --}}
                  @foreach ($kandang as $edit)
                    <div class="modal fade" id="editModalkandang{{$edit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="/kandang/{{$edit->id}}/update" method="POST">
                                @csrf
                                <div class="form-group">
                                <label>Kode kandang</label>
                                  <input type="text" name="kd_kandang" value="{{$edit->kd_kandang}}" class="form-control" id="kd_kandang" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal ChickIn</label>
                                    <input type="date" name="tgl_chickin" value="{{$edit->tgl_chickin}}" class="form-control" id="tgl_chickin" required>
                                </div>
                                <div class="form-group">
                                    <label>Umur</label>
                                    <input type="number" name="kapasitas" value="{{$edit->kapasitas}}" class="form-control" id="kapasitas" required>
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
                  @endforeach
@include('sweetalert::alert')
@endsection


@section('footer')
    @if (count($errors) > 0)
        <script type="text/javascript">
          $( document ).ready(function() {
              $('#addModalkandang').modal('show');
          });
        </script>
    @endif

    <script>
    $('.delete').click(function(){
      var kandang_id = $(this).attr('kandang-id');
      swal({
        title: "Hapus Data !",
        text: "Yakin akan menghapus data ayam ini ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        console.log(willDelete);
        if (willDelete) {
            window.location = "/kandang/"+kandang_id+"/delete"
        }
      });
    });
  </script>

  <script>
    $(document).ready( function () {
    $('#kandang-datatable').DataTable();
  } );
  </script>

@endsection