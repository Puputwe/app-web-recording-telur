@extends('layouts.master-user')
@section('heading', 'Recording telur')
@section('page')
  <li class="breadcrumb-item active">Recording telur</li>
@endsection

@section('content')
@if ($id_kandang)
<div class="container">
  <div class="row">
          <div class="card card-olive card-outline">
              <div class="card-header">
                  <h1 class="card-title">
                      @foreach ($get_kandang as $data )
                      <p><b>Kandang : </b> {{$data->kd_kandang}}</p>
                      <b>Tanggal : </b> {{Carbon\Carbon::now()->isoFormat('D MMMM Y');}}
                      @endforeach
                  </h1>
              </div>
                  <form action="/form/storeAll" enctype="multipart/form-data" method="POST">
                      <div class="card-body">
                          @csrf 
                          <div class="row">
                              @foreach ($populasi as $get)   
                              <table style="width: 40%; margin: 0.2cm;" border="0">  
                                  <tr>
                                      <th>{{$get->kd_ayam}}</th>
                                      <td> <input type="hidden" name="id_users[]" value="{{Auth::user()->id}}" class="form-control">
                                          <input type="hidden" name="id_populasi[]" value="{{$get->id}}" class="form-control">
                                          <input type="hidden" name="id_kandang[]" value="{{$get->id_kandang}}" class="form-control">
                                              <div class="input-group">
                                                  <span class="input-group-btn">
                                                      <button type="button" class="btn btn-danger btn-number btn-sm"  data-type="minus" data-field="quant[{{$get->id}}]">
                                                        <span class="fa fa-minus"></span>
                                                      </button>
                                                  </span>
                                                  <input type="text" id="quant[{{$get->id}}]" name="jml_telur[]" class="form-control form-control-sm input-number col-md-2" value="0" min="0" max="2">
                                                  <span class="input-group-btn">
                                                      <button type="button" class="btn btn-success btn-number btn-sm" data-type="plus" data-field="quant[{{$get->id}}]">
                                                          <span class="fa fa-plus"></span>
                                                      </button>
                                                  </span>
                                              </div>
                                      </td>
                                  </tr>
                              </table>
                              @endforeach
                              <div class="modal-footer col-lg-12">
                                <a href="/produksi/telur" class="btn btn-secondary btn-sm" style="float: right;"> 
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                              </div>
                          </div>
                      </div>
                  </form>
          </div>
      </div>
  </div>
</div>
@else
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">
                  Form data recording telur ayam
                  </h3>
               </div>
              <div class="card-body">
                <form action="/produksi/telur" method="GET" enctype="multipart/form-data">
                  @csrf
                  <div class="row filter-row">
                      <div class="col-lg-6">
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
                          <button type="submit" class="btn btn-primary" style="margin-right: 4px; margin-left: 4px;"><i class="fa fa-search"></i> Cari</button>
                      </div>
                      <div class="col-lg-0.5">
                        {{-- <a href="/scan/produksi" class="btn btn-danger" style="float: right;">
                          <i class="fa fa-qrcode"></i>  
                            Scan QR
                        </a> --}}
			            <a href="https://puputwe.github.io/qr-scanner.github.io/" class="btn btn-danger" style="float: right;">
                          <i class="fa fa-qrcode"></i>  
                            Scan QR
                        </a>
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
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">Riwayat recording telur</div>
              <div class="card-body">
                <div class="table-responsive">
                <table id="produksi-datatable" class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th>Kode Ayam</th>
                          <th>Tanggal Produksi</th>
                          <th>Telur</th>
                          <th>Keterangan</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($produksi as $item )
                      <tr>
                          <td>{{$item->kd_ayam}}</td>
                          <td>{{date('d-m-Y', strtotime($item->tgl_produksi))}}</td>
                          <td>{{$item->jml_telur}} Butir</td>
                          <td>{{$item->keterangan}}</td>
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
@endif
<!-- Modal:end -->
@include('sweetalert::alert')
@endsection

@section('footer')
<script>
  $('.btn-number').click(function(e){
  e.preventDefault();
  
  fieldName = $(this).attr('data-field');
  type      = $(this).attr('data-type');
  var input = $("input[id='"+fieldName+"']");
  var currentVal = parseInt(input.val());
  if (!isNaN(currentVal)) {
      if(type == 'minus') {
          
          if(currentVal > input.attr('min')) {
              input.val(currentVal - 1).change();
          } 
          if(parseInt(input.val()) == input.attr('min')) {
              $(this).attr('', true);
          }

      } else if(type == 'plus') {

          if(currentVal < input.attr('max')) {
              input.val(currentVal + 1).change();
          }
          if(parseInt(input.val()) == input.attr('max')) {
              $(this).attr('', true);
          }

      }
  } else {
      input.val(0);
  }
});
</script>
<script>
  $(document).ready( function () {
  $('#produksi-datatable').DataTable();
} );
</script>
@endsection