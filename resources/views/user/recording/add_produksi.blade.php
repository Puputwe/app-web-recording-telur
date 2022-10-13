@extends('layouts.master-user')
@section('page')
    <li class="breadcrumb-item active">Produksi Telur</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-olive card-outline">
                <div class="card-body">
                    <table style="width: 100%; border="0">     
                        <tr class="text-center">
                            <th>Kode Ayam</th>
                            <th>Umur</th>
                            <th>Total Telur</th>
                            <th>Status</th>
                        </tr>
                        <tr class="text-center">
                            <td>{{$populasi->kd_ayam}}</td>
                            <td>{{\Carbon\Carbon::parse($populasi->tgl_tetas)->diffInDays()}} Hari</td>
                            <td>{{$total_telur}} Butir</td>
                            <td> @if ($populasi->status == 'produktif')
                                <span class="badge bg-success">Produktif</span>
                                @elseif ($populasi->status == 'afkir')
                                    <span class="badge bg-danger">Afkir</span>
                                @elseif ($populasi->status == 'mati')
                                    <span class="badge bg-secondary">Mati</span>                                     
                                @endif  </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
     {{-- Tambah Data --}}
     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-olive card-outline">
                    <div class="card-header">
                        <h1 class="card-title">
                            <i class="fas fa-edit"></i>
                            <b>Tambah data produksi</b>
                        </h1>
                    </div>
                        <form action="/form/store" enctype="multipart/form-data" method="POST">
                            <div class="card-body">
                                @csrf 
                                <div class="row">
                                    <input type="hidden" name="id_users" value="{{Auth::user()->id}}" class="form-control">
                                    <input type="hidden" name="id_populasi" value="{{$populasi->id}}" class="form-control">
                                    <input type="hidden" name="id_kandang" value="{{$populasi->id_kandang}}" class="form-control">
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small">Ayam bertelur hari ini ?<span class="text-olive ml-1">*</span></label>
                                        <div>
                                        <input type="checkbox" name="jml_telur" value="1">  Ya
                                        <input type="checkbox" name="jml_telur" value="0">  Tidak
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small">Catatan<span class="text-olive ml-1">opsional</span></label>
                                        <textarea type="text"  name="keterangan" class="form-control" id="keterangan"
                                         placeholder="*anda dapat memberikan catatan berupa kondisi ayam saat ini"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <a href="{{ route('produksiTelur') }}" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Back </a>
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
@include('sweetalert::alert')
@endsection

@section('footer')
@endsection
