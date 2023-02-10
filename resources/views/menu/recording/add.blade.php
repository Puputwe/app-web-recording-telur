@extends('layouts.form-template')

@section('content')
<div class="wrapper wrapper--w1000">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-5">
                    <div class="card-header">
                        <a href="{{ route('recording') }}" class="btn btn-olive" style="float: left;"><i class="fa fa-arrow-left"></i></a>
                        <h3 class="text text-center">
                            <b>Form Recording Telur</b>
                        </h3>
                    </div>
                        <form action="/recording/store" enctype="multipart/form-data" method="POST">
                            <div class="card-body">
                                @csrf 
                                <div class="row">
                                    <input type="hidden" name="id_users" value="{{Auth::user()->id}}" class="form-control">
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Tanggal<span class="text-olive ml-1">*</span></label>
                                        <input type="" readonly name="tanggal" class="form-control" id="tanggal" value="{{Carbon\Carbon::now()->isoFormat('D MMMM Y');}}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Kode Kandang<span class="text-olive ml-1">*</span></label>
                                        <select name="id_kandang" class="form-control" id="id_kandang" required>
                                            <option value="">-- Pilih Kandang --</option>
                                            @foreach ($kandang as $a)
                                                <option {{ old('id_kandang') == $a ? "selected" : "" }} value="{{ $a->id }}">{{ $a->kd_kandang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div id="detail_kandang" class="detail_kandang"></div>
                                    
                                    {{-- <div class="form-group col-lg-4">
                                        <label class="font-weight-bold text-small">Ayam Afkir<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="ayam_afkir" class="form-control" id="ayam_afkir" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Ekor</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="font-weight-bold text-small">Ayam Mati<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="ayam_mati" class="form-control" id="ayam_mati" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Ekor</span>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group col-lg-4">
                                        <label class="font-weight-bold text-small">Pakan<span class="text-olive ml-1">*</span></label>
                                        <select name="id_pakan" class="form-control" id="id_pakan" required>
                                            <option value="">-- Pilih Pakan --</option>
                                            @foreach ($pakan as $b)
                                                <option {{ old('id_pakan') == $b ? "selected" : "" }} value="{{ $b->id }}">{{ $b->nama  }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="font-weight-bold text-small">Total Pakan<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" value="{{ old('tot_pakan') }}" name="tot_pakan" class="form-control" id="tot_pakan" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="font-weight-bold text-small">Berat telur<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" value="{{ old('berat_telur') }}" name="berat_telur" class="form-control" id="berat_telur" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Kg</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="detail_pakan" class="detail_pakan"></div>
                                    
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small">FCR<span class="text-olive ml-1">*</span></label>
                                        <input type="text" value="{{ old('fcr') }}" name="fcr" class="form-control" id="fcr" readonly required>
                                    </div>
                                    <div class="modal-footer  col-lg-12 text-right">
                                        <button type="submit" class="btn btn-olive">Submit</button>
                                    </div>
                        </form>
                    </div>
                </div>
            @include('sweetalert::alert')
            @endsection

            @section('footer')
            <script>
                $(document).ready(function () {
                    $("#id_kandang").change(function (e) { 
                        var tot_telur = $("#tot_telur").val();
                        var jml_aym = $("#jml_aym").val();
                        
                        var hd = (parseFloat(tot_telur) / parseFloat(jml_aym))*(100);
                        var hd = hd.toFixed(2);
                        $("#hd").val(hd);
            
                        document.getElementById("hd").innerHTML = hd;
                    });
 
                    $("#tot_pakan, #berat_telur").keyup(function (e) { 
                        var tot_pakan = $("#tot_pakan").val();
                        var berat_telur = $("#berat_telur").val();
            
                        var fcr = parseFloat(tot_pakan) / parseFloat(berat_telur);
                        var fcr = fcr.toFixed(2);
                        $("#fcr").val(fcr);

                        document.getElementById("fcr").innerHTML = fcr;
                    });
            
                });

                console.log((9 / 5)*100);

            </script>
            <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                </script>

                <script>
                    $("#id_pakan").change(function() {
                        var id_pakan = $("#id_pakan").val();
                        $.ajax({
                            type: "GET",
                            url: "/recording/ajax",
                            data: "id_pakan=" + id_pakan,
                            cache: false,
                            success: function(data) {
                                $('#detail_pakan').html(data);
                            }
                        });
                    })
                </script>

                <script>
                    $("#id_kandang").change(function() {
                        var id_kandang = $("#id_kandang").val();
                        $.ajax({
                            type: "GET",
                            url: "/recording/ajaxx",
                            data: "id_kandang=" + id_kandang,
                            cache: false,
                            success: function(data) {
                                $('#detail_kandang').html(data);
                            }
                        });
                    })
                </script>
            @endsection
