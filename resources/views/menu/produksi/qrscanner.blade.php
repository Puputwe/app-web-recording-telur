@extends('layouts.form-template')

@section('content')

<div class="container wrapper--w680">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-15">
              <div class="card-header">
                <a href="{{ route('produksi') }}" class="btn btn-olive" style="float: left;"><i class="fa fa-arrow-left"></i></a>
                <h5 class="text text-center">Scan Kode Ayam</h5>
            </div>
                <div class="card-body">
                 <video id="result"  data-app-id="CAMERATAG_APPLICATION_UUID" width="100%"></video>
                </div>
            </div>
        </div>
    </div>
  </div>
@include('sweetalert::alert')
@endsection

@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script src='//cameratag.com/v14/js/cameratag.js' type='text/javascript'></script>
<link rel='stylesheet' href='//cameratag.com/static/14/cameratag.css'>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('result') });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
    scanner.addListener('scan', function (decodedText) {
      $("#result").val(decodedText)
      let lower = decodedText;
        if(result.value){
          $.ajax({
          type: "GET",
          url: "/form/"+lower+"/kode-ayam",
          data: lower,
          success: function(data) {
             window.location.href= "/form/"+lower+"/kode-ayam";
          },
          error: function(response) {
            swal({
                icon: 'error',
                title: 'Oops...',
                text: 'Qr Code tidak terdaftar' 
              })
          }
          });
        }
      });
</script>
@endsection
