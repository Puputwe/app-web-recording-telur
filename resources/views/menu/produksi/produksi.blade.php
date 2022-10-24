@extends('layouts.form-template')

@section('content')
<div class="container wrapper--w790">
  <div class="row">
          <div class="card card-olive card-outline">
            @foreach ($get_kandang as $data )
            <div class="card-header">
                <a href="{{ route('QR_Scanner') }}" class="btn btn-olive" style="float: left;"><i class="fa fa-arrow-left"></i></a>
                <h5 class="text text-center">
                    <b>Form Produksi Telur</b>
                    <p>( Kandang: {{$data->kd_kandang}} / Tanggal: {{Carbon\Carbon::now()->isoFormat('D MMMM Y');}} )</p>
                </h5>
            </div>
             @endforeach
                <div class="card-body">
                  <form action="/produksi/store-all" enctype="multipart/form-data" method="POST">
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
                                <button type="submit" class="btn btn-olive">Submit</button>
                              </div>
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