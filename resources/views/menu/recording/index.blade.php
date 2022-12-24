@extends('layouts.master')
@section('heading', 'Recording')
@section('page')
  <li class="breadcrumb-item active">Recording</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">
                  Filter Data Per Kandang
                  </h3>
               </div>
              <div class="card-body">
                <form action="/recording/search" method="GET" enctype="multipart/form-data">
                  @csrf
                  <div class="row filter-row">
                      <div class="col-lg-3">
                          <div class="form-group form-focus">
                              <select class="form-control" id="id_kandang" name="id_kandang">
                                  <option value="">-- Kode Kandang --</option>
                               @foreach ($kandang as $k)
                                  <option value="{{ $k->id }}">{{ $k->kd_kandang }}</option>
                              @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-0.5">
                        <div class="text text-center">
                          <label>From</label>
                        </div>
                    </div>
                      <div class="col-lg-3">
                        <div class="form-group form-focus">
                            <input type="date" class="form-control" id="fromDate" name="fromDate">
                        </div>
                    </div>
                    <div class="col-lg-0.5"> 
                      <div class="text text-center">
                        <label>to</label>
                      </div>
                  </div>
                    <div class="col-lg-3">
                      <div class="form-group form-focus">
                          <input type="date" class="form-control" id="toDate" name="toDate">
                      </div>
                  </div>
                      <div class="col-lg-0.5">
                          <button type="submit" class="btn btn-warning" style="margin-right: 4px; margin-left: 4px;"><i class="fa fa-search"></i> Cari</button>
                      </div>
                      <div class="col-lg-0.5">
                        <a href="{{ route('recording') }}" class="btn btn-danger" style="margin-right: 4px; margin-left: 4px;"><i class="fa fa-undo"></i> Reset </a>
                    </div>
                  </div>
              </form>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-olive card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                      @if(auth()->user()->role_id == 2)
                      <a href="/recording/create" class="btn btn-olive btn-sm" style="float: left;">
                        <i class="fa fa-plus"></i> Tambah Recording
                      </a>
                      <h3 class="text text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#printModalrecording"> 
                          <i class="fa fa-print"></i>  
                          Print
                        </button>
                      @else
                        <h3 class="text text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#printModalrecording"> 
                          <i class="fa fa-print"></i>  
                          Print
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exportModalrecording"> 
                          Export
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importModalrecording"> 
                          Import
                        </button>
                 @endif
                 </div>
                <div class="card-body"> 
                <div class="table-responsive">
                @if(auth()->user()->role_id == 2)
                <table id="recording-datatable" class="table table-bordered table-sm" style="width:100%">
                  <thead>
                      <tr class="table-secondary">
                          <th rowspan="2">Kandang</th>
                          <th rowspan="2">Tanggal</th>
                          <th class="text-center" colspan="3">Populasi</th>
                          <th class="text-center" colspan="2">Pakan</th>
                          <th class="text-center" colspan="2">Produksi Telur</th>
                          <th rowspan="2">HD (%)</th>
                          <th rowspan="2">FCR</th>
                      </tr>
                      <tr class="table-secondary">
                          <th>Hidup</th>
                          <th>Afkir</th>
                          <th>Mati</th>
                          <th>Nama</th>
                          <th>Total</th>
                          <th>Jumlah</th>
                          <th>Berat</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($result as $data )
                      <tr>
                          <td>{{$data->kd_kandang}}</td>
                          <td>{{date('d-m-Y', strtotime($data->tanggal))}}</td>
                          <td>{{$data->ayam_hidup}}</td>
                          <td>{{$data->ayam_afkir}}</td>
                          <td>{{$data->ayam_mati}}</td>
                          <td>{{$data->nama}}</td>
                          <td>{{number_format($data->tot_pakan)}} Kg</td>
                          <td>{{$data->tot_telur}} Butir</td>
                          <td>{{$data->berat_telur}} Kg</td>
                          <td>{{$data->hd}} </td>
                          <td>{{$data->fcr}}</td>
                      </tr>
                          @endforeach
                  </tbody>
              </table> 
                @else
                <table id="recording-datatable" class="table table-bordered table-sm" style="width:100%">
                  <thead>
                      <tr class="table-secondary">
                          <th rowspan="2">Petugas</th>
                          <th rowspan="2">Kandang</th>
                          <th rowspan="2">Tanggal</th>
                          <th class="text-center" colspan="3">Populasi</th>
                          <th class="text-center" colspan="2">Pakan</th>
                          <th class="text-center" colspan="2">Produksi Telur</th>
                          <th rowspan="2">HD (%)</th>
                          <th rowspan="2">FCR</th>
                          <th rowspan="2">Aksi</th>
                      </tr>
                      <tr class="table-secondary">
                          <th>Hidup</th>
                          <th>Afkir</th>
                          <th>Mati</th>
                          <th>Nama</th>
                          <th>Total</th>
                          <th>Jumlah</th>
                          <th>Berat</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($result as $data )
                      <tr>
                          <td>{{$data->name}}</td>
                          <td>{{$data->kd_kandang}}</td>
                          <td>{{date('d-m-Y', strtotime($data->tanggal))}}</td>
                          <td>{{$data->ayam_hidup}}</td>
                          <td>{{$data->ayam_afkir}}</td>
                          <td>{{$data->ayam_mati}}</td>
                          <td>{{$data->nama}}</td>
                          <td>{{number_format($data->tot_pakan)}} Kg</td>
                          <td>{{$data->tot_telur}} Butir</td>
                          <td>{{$data->berat_telur}} Kg</td>
                          <td>{{$data->hd}}</td>
                          <td>{{$data->fcr}}</td>
                          <td>
                            <a href="#" class="btn btn-danger btn-sm delete-out" pakanid="{{$data->id_pakan}}" pakanjml="{{$data->tot_pakan}}" recording-id="{{$data->id}}"><i class="nav-icon fas fa-trash"></i></a>
                          </td>
                      </tr>
                          @endforeach
                  </tbody>
              </table> 
                @endif
              </div>
            </div>

            {{-- Export Modal --}}
            @foreach ($kandang as $rec )
            <div class="modal fade" id="exportModalrecording" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="modal-header">
                      <a href="/recording/recording_export" class="btn btn-success btn-sm" style="float: right;">
                        Export All
                      </a>
                    </div>
                    <table class="table">
                      @foreach ($kandang as $rec )
                      <tr>
                        <th>Kandang</th>
                        <td>:</td>
                        <td>{{$rec->kd_kandang}}</td>
                        <th>
                          <a href="/recording/recording_export/{{$rec->id}}" class="btn btn-success btn-sm" style="float: right;">
                            Export 
                          </a>
                        </th>
                    </tr>
                      @endforeach
                  </table>
                  </div>
                </div>
              </div>
            </div>
            @endforeach 

             {{-- Import Modal --}}
             <div class="modal fade" id="importModalrecording" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('recording_import') }}" method="post" enctype="multipart/form-data">
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
          
            {{-- Import Modal --}}
            <div class="modal fade" id="printModalrecording" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="/recording/cetak_recording" target="_blank" method="GET" enctype="multipart/form-data">
                      @csrf
                      <div class="row filter-row">
                          <div class="col-lg-12">
                              <div class="form-group form-focus">
                                <label>Kode Kandang</label>
                                  <select class="form-control" id="id_kandang" name="id_kandang" required="required">
                                      <option value="">-- Kode Kandang --</option>
                                   @foreach ($kandang as $k)
                                      <option value="{{ $k->id }}">{{ $k->kd_kandang }}</option>
                                  @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group form-focus">
                              <label>From :</label>
                                <input type="date" class="form-control" id="tgl_awal" name="tgl_awal">
                            </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group form-focus">
                            <label>to :</label>
                              <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-print"></i> Cetak</button>
                      </div>
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
  $('.delete-out').click(function(){
    var recording_id = $(this).attr('recording-id');
    var pakanid = $(this).attr('pakanid');
    var pakanjml = $(this).attr('pakanjml');
    swal({
      title: "Hapus Data Recording",
      text: "Yakin akan menghapus data recording ini ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      console.log(willDelete);
      if (willDelete) {
          window.location = "/recording/"+recording_id+"/"+pakanid+"/"+pakanjml+"/delete"
      }
    });
  });
</script>

  <script>
    $(document).ready( function () {
    $('#recording-datatable').DataTable();
  } );
  </script>

@endsection