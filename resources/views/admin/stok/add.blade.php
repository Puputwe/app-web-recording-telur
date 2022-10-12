@extends('layouts.master')
@section('page')
    <li class="breadcrumb-item active">Stok Pakan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-olive card-outline">
                        <div class="card-header">
                            <h1 class="card-title">
                                <i class="fas fa-edit"></i>
                                <b>Tambah data pakan masuk</b>
                            </h1>
                        </div>
                        <form action="/stok-pakan/store" enctype="multipart/form-data" method="POST">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Pakan</label>
                                    <select name="id_pakan" class="form-control @error('id_pakan') is-invalid @enderror"  id="id_pakan" required>
                                        <option value="" @if (old('id_pakan')=='' or old('id_pakan')==0) selected="selected" @endif>Pilih Pakan</option>
                                        @foreach ($pakan as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="detail_pakan" class="detail_pakan"></div>

                                <div class="form-group">
                                    <label for="pakan">Jumlah Pakan masuk</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="jml_pakan" class="form-control " id="jml_pakan" placeholder="Jumlah Pakan..." required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('stok-pakan') }}" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Back </a>
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                        </form>
                    </div>
                </div>
            @endsection

            @section('footer')
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
                            url: "/stok-pakan/ajax",
                            data: "id_pakan=" + id_pakan,
                            cache: false,
                            success: function(data) {
                                $('#detail_pakan').html(data);
                            }
                        });
                    })
                </script>
            @endsection
