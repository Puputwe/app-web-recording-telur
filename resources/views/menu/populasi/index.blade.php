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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModalpopulasi">
                      <i class="fa fa-plus"></i>  
                      Data
                    </button>
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
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModalpopulasi{{$data->id}}">
                                <i class="fa fa-eye"></i>
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
                              <div class="form-group">
                              <label>Kode kandang</label>
                                <select name="id_kandang" class="form-control" id="id_kandang" required>
                                  <option value="">-- Pilih Kandang --</option>
                                    @foreach ($kandang as $k)
                                      <option value="{{ $k->id }}">{{ $k->kd_kandang }}
                                        </option>
                                    @endforeach
                              </select>
                              </div>
                              <div class="form-group">
                                <label>Kode Ayam</label>
                                <input type="text" name="kd_ayam" class="form-control" id="kd_ayam" placeholder="XX000" required>
                              </div>
                              <div class="form-group">
                                  <label>Tanggal Tetas</label>
                                  <input type="date" name="tgl_tetas" class="form-control" id="tgl_tetas" placeholder="0" required>
                              </div>
                              <div class="form-group">
                                  <label>Status</label>
                                      <select name="status_aym" class="form-control" id="status_aym" required>
                                          <option value="">-- Pilih Status --</option>
                                          <option value="produktif">Produktif</option>
                                          <option value="afkir">Afkir</option>
                                          <option value="mati">Mati</option>
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
                                    <select name="status_aym" class="form-control" id="status_aym" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option {{ ($edit->status_aym) == 'produktif' ? 'selected' : '' }}  value="produktif">Produktif</option>
                                        <option {{ ($edit->status_aym) == 'afkir' ? 'selected' : '' }}  value="afkir">Afkir</option>
                                        <option {{ ($edit->status_aym) == 'mati' ? 'selected' : '' }}  value="mati">Mati</option>
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

                  @foreach ($populasi as $detail)
                  {{-- Modal Detail Data --}}
                    <div class="modal fade" id="detailModalpopulasi{{$detail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Detail Ayam</h5>
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