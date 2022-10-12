@extends('layouts.master-user')
@section('page')
    <li class="breadcrumb-item active">Produksi Telur</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                 <video id="result" width="100%"></video>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Riwayat recording telur hari ini
                  <a href="{{ route('produksiTelur') }}" class="btn btn-secondary btn-sm" style="float: right;"><i class="fa fa-undo"></i> Back </a>
                </div>
                <div class="card-body">
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
@include('sweetalert::alert')
@endsection

@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
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
          url: "/form/"+lower+"/produksi",
          data: lower,
          success: function(data) {
             window.location.href= "/form/"+lower+"/produksi";
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
