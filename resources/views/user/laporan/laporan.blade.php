@extends('layouts.master-user')
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
                <form action="/laporan/search" method="GET" enctype="multipart/form-data">
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
                        <a href="{{ route('laporanPerforma') }}" class="btn btn-danger" style="margin-right: 4px; margin-left: 4px;"><i class="fa fa-undo"></i> Reset </a>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan recording performa ayam
                 </div>
                <div class="card-body"> 
                <div class="table-responsive">
                <table id="recording-datatable" class="table table-striped table-bordered tabel-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th rowspan="2">Kandang</th>
                            <th rowspan="2">Tanggal</th>
                            <th class="text-center" colspan="3">Populasi</th>
                            <th class="text-center" colspan="2">Pakan</th>
                            <th class="text-center" colspan="2">Produksi Telur</th>
                            <th rowspan="2">HD</th>
                            <th rowspan="2">FCR</th>
                        </tr>
                        <tr>
                            <th>Hidup</th>
                            <th>Afkir</th>
                            <th>Mati</th>
                            <th>Jenis</th>
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
                            <td>{{$data->jenis}}</td>
                            <td>{{number_format($data->jml_pakan)}} Kg</td>
                            <td>{{$data->jml_telur}} Butir</td>
                            <td>{{$data->berat_telur}} Kg</td>
                            <td>{{$data->hd}} %</td>
                            <td>{{$data->fcr}} </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table> 
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
    $('#recording-datatable').DataTable();
  } );
  </script>

@endsection