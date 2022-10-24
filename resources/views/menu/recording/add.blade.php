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
                            <b>Form Catatan Harian</b>
                        </h3>
                    </div>
                        <form action="/recording/store" enctype="multipart/form-data" method="POST">
                            <div class="card-body">
                                @csrf 
                                <div class="row">
                                    <input type="hidden" name="id_users" value="{{Auth::user()->id}}" class="form-control">
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Kode Kandang<span class="text-olive ml-1">*</span></label>
                                        <select name="id_kandang" class="form-control" id="id_kandang" required>
                                            <option value="">-- Pilih Kandang --</option>
                                            @foreach ($kandang as $a)
                                                <option value="{{ $a->id }}">{{ $a->kd_kandang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Tanggal<span class="text-olive ml-1">*</span></label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <h5 class="text-center"style="background-color: rgb(233,236,239);margin: 3px; padding: 3px; font-family : Helvetica Neue">Populasi Ayam</h5>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="font-weight-bold text-small">Ayam Produktif<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="ayam_hidup" class="form-control" id="ayam_hidup" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Ekor</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
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
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <h5 class="text-center"style="background-color: rgb(233,236,239);margin: 3px; padding: 3px; font-family : Helvetica Neue">Pemberian Pakan</h5>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Pakan<span class="text-olive ml-1">*</span></label>
                                        <select name="id_pakan" class="form-control" id="id_pakan" required>
                                            <option value="">-- Pilih Pakan --</option>
                                            @foreach ($pakan as $b)
                                                <option value="{{ $b->id }}">{{ $b->nama  }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Total Pakan<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="jml_pakan" class="form-control" id="jml_pakan" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Kg</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="detail_pakan" class="detail_pakan"></div>

                                    <div class="form-group col-lg-12">
                                        <h5 class="text-center"style="background-color: rgb(233,236,239);margin: 3px; padding: 3px;  font-family : Helvetica Neue;">Produksi & Performa Telur</h5>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Jumlah Telur<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="jml_telur" class="form-control" id="jml_telur" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Butir</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">Berat Telur<span class="text-olive ml-1">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="berat_telur" class="form-control" id="berat_telur" placeholder="0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">HD<span class="text-olive ml-1">*</span></label>
                                        <input type="text" name="hd" class="form-control" id="hd" readonly required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small">FCR<span class="text-olive ml-1">*</span></label>
                                        <input type="text" name="fcr" class="form-control" id="fcr" readonly required>
                                    </div>
                                    <div class="form-group col-lg-12">
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
                    $("#ayam_hidup, #jml_telur").keyup(function (e) { 
                        var jml_telur = $("#jml_telur").val();
                        var ayam_hidup = $("#ayam_hidup").val();
            
                        var hd = (parseFloat(jml_telur) / parseFloat(ayam_hidup))*(100);
                        var hd = hd.toFixed(2);
                        $("#hd").val(hd);
            
                        document.getElementById("hd").innerHTML = hd;
                    });

                    $("#jml_pakan, #berat_telur").keyup(function (e) { 
                        var jml_pakan = $("#jml_pakan").val();
                        var berat_telur = $("#berat_telur").val();
            
                        var fcr = parseFloat(jml_pakan) / parseFloat(berat_telur);
                        var fcr = fcr.toFixed(2);
                        $("#fcr").val(fcr);

                        document.getElementById("fcr").innerHTML = fcr;
                    });
            
                });
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
            @endsection
