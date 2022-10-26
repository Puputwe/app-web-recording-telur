@extends('layouts.master')
@section('heading', 'Populasi')
@section('page')
  <li class="breadcrumb-item active">Populasi</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">
                  <a href="{{ route('kandang') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back 
                  </a>
               </div>
              <div class="card-body">
                <div class="table-responsive">
                <h5>Informasi Kandang</h5>
               @foreach ($info as $d )
               <table class="table table-borderless">
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
                  <td>@if ($d->status == 'aktif')
                    <span class="badge bg-success" >Aktif</span>
                    @elseif ($d->status == 'non-aktif')
                        <span class="badge bg-secondary">Non-Aktif</span>                                   
                    @endif  </span></td>
                  <th>Total Telur</th>
                  <td>:</td>
                  <td>{{$telur}} Butir</td>
              </tr>
            </table>
               @endforeach
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card  card-olive card-outline">
                <div class="card-header">
                  <button type="button" class="btn btn-olive btn-sm" data-toggle="modal" data-target="#addModalpopulasi">
                    <i class="fa fa-plus"></i>  
                    Tambah Ayam
                  </button>
                   @foreach ($info as $pop )
                  <a href="/kandang/populasiexport/{{$pop->id}}" class="btn btn-success btn-sm" style="float: right;">
                    Export 
                  </a>
                  <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right: 4px; margin-left: 4px;" data-toggle="modal" data-target="#importModalpopulasi"> 
                    Import
                  </button>
                  <a href="/kandang/cetak_populasi/{{$pop->id}}" target="_blank" class="btn btn-secondary btn-sm" style="float: right;">
                    <i class="fa fa-print"></i>  
                      Print 
                    </a>
                   @endforeach
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
                        @foreach ($populasi as $data )
                        <tr>
                          <td>{{$no++}}</td>
                            <td>{{$data->kd_ayam}}</td>
                            <td>{{\Carbon\Carbon::parse($data->tgl_tetas)->diffInDays()}} Hari</td>
                            <td class="text text-center">{!! QrCode::size(50)->generate(Crypt::encrypt($data->id)); !!}</td>
                            <td class="text text-center">
                              @if ($data->status == 'produktif')
                              <span class="badge bg-success" >produktif</span>
                              @elseif ($data->status == 'afkir')
                                  <span class="badge bg-danger">afkir</span>
                              @elseif ($data->status == 'mati')
                                  <span class="badge bg-secondary">mati</span>                                     
                              @endif  
                            </td>
                            <td>
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModalpopulasi{{$data->id}}">
                                <i class="fa fa-qrcode"></i>
                              </button>
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModalpopulasi{{$data->id}}">
                              <i class="fa fa-edit"></i>
                            </button>
                            <a href="#" class="btn btn-danger btn-sm delete" populasi-id="{{$data->id}}"><i class="nav-icon fas fa-trash"></i></a>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
                </div>

                 {{-- Modal Tambah Populasi --}}
                 <div class="modal fade" id="addModalpopulasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form action="/populasi/store" method="POST">
                              @csrf
                              @foreach ($kandang as $k)
                                <input type="hidden" name="id_kandang" value="{{ $k->id }}" class="form-control" id="id_kandang"  required>
                               @endforeach
                              <div class="form-group">
                                <label>Kode Ayam</label>
                                <input type="text" name="kd_ayam" class="form-control" id="kd_ayam" placeholder="XX000" required>
                                @error('kd_ayam')
                                <div class="text-danger">{{ $message }}</div>
                               @enderror
                              </div>
                              <div class="form-group">
                                  <label>Tanggal Tetas</label>
                                  <input type="date" name="tgl_tetas" value="{{ old('tgl_tetas') }}" class="form-control" id="tgl_tetas" placeholder="0" required>
                              </div>
                              <div class="form-group">
                                  <label>Status</label>
                                      <select name="status" class="form-control" id="status" required>
                                          <option value="">-- Pilih Status --</option>
                                          <option value="produktif" {{ old('status') == 'produktif' ? 'selected' : '' }}>Produktif</option>
                                          <option value="afkir" {{ old('status') == 'afkir' ? 'selected' : '' }}>Afkir</option>
                                          <option value="mati" {{ old('status') == 'mati' ? 'selected' : '' }}>Mati</option>
                                      </select>
                                  </select>
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
                
                @foreach ($populasi as $edit)
                {{-- Modal Edit Data --}}
                  <div class="modal fade" id="editModalpopulasi{{$edit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form action="/populasi/{{$edit->id}}/update" method="POST">
                              @csrf
                              <input type="text" name="id_kandang" value="{{$edit->id_kandang}}" class="form-control" id="id_kandang" readonly hidden>
                              <div class="form-group">
                              <label>Kode Ayam</label>
                                <input type="text" name="kd_ayam" value="{{$edit->kd_ayam}}" class="form-control" id="kd_ayam" required>
                              </div>
                              <div class="form-group">
                                  <label>Tanggal Tetas</label>
                                  <input type="date" name="tgl_tetas" value="{{$edit->tgl_tetas}}" class="form-control" id="tgl_tetas" required>
                              </div>
                              <div class="form-group">
                                  <label>Status</label>
                                  <select name="status" class="form-control" id="status" required>
                                      <option value="">-- Pilih Status --</option>
                                      <option {{ ($edit->status) == 'produktif' ? 'selected' : '' }}  value="produktif">Produktif</option>
                                      <option {{ ($edit->status) == 'afkir' ? 'selected' : '' }}  value="afkir">Afkir</option>
                                      <option {{ ($edit->status) == 'mati' ? 'selected' : '' }}  value="mati">Mati</option>
                                  </select>
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

                {{-- Import Modal --}}
               <div class="modal fade" id="importModalpopulasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('importpopulasi') }}" method="post" enctype="multipart/form-data">
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

              {{-- Detail  Data --}}
              @foreach ($populasi as $detail)
                <div class="modal fade" id="detailModalpopulasi{{$detail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="/populasi/{{$detail->id}}/detail" method="GET">
                      <table style="width: 100%;" border="0">
                        <tr align="center">
                          <th>Kode Ayam : {{ $detail->kd_ayam}}</th>
                      </tr>
                      <tr>
                          <th class="text-center" colspan="2">{!! QrCode::size(150)->generate(Crypt::encrypt($detail->id)); !!}</th>
                      </tr>
                    </table>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
@include('sweetalert::alert')
@endsection


@section('footer')
<script src="{{ asset('js_export/export.js') }}"></script>

@if (count($errors) > 0)
<script type="text/javascript">
  $( document ).ready(function() {
      $('#addModalpopulasi').modal('show');
  });
</script>
@endif

<script>
  $('.delete').click(function(){
    var populasi_id = $(this).attr('populasi-id');
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
          window.location = "/populasi/"+populasi_id+"/delete"
      }
    });
  });
</script>

<script>
  $(document).ready( function () {
  $('#populasi-datatable').DataTable();
} );
</script>

@endsection