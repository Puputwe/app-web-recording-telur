@extends('layouts.form-template')

@section('content')
<div class="container wrapper--w680">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-15">
                 <div class="card-header">
                        <a href="{{ route('qrScanner') }}" class="btn btn-olive" style="float: left;"><i class="fa fa-arrow-left"></i></a>
                        <h5 class="text text-center">
                            <b>Informasi Ayam</b>
                        </h5>
                    </div>
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
                            <td> @if ($populasi->status_aym == 'produktif')
                                <span >Produktif</span>
                                @elseif ($populasi->status_aym == 'afkir')
                                    <span >Afkir</span>
                                @elseif ($populasi->status_aym == 'mati')
                                    <span >Mati</span>                                     
                                @endif  </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
     {{-- Tambah Data --}}
     <div class="container wrapper--w680">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-15">
                        <form action="/populasi/{{$populasi->id}}/update_status" enctype="multipart/form-data" method="POST">
                            <div class="card-body">
                                @csrf 
                                <div class="row">
                                    <input type="hidden" name="id_kandang" value="{{$populasi->id_kandang}}" class="form-control">
                                    <input type="hidden" name="kd_ayam" value="{{$populasi->kd_ayam}}" class="form-control">
                                    <input type="hidden" name="tgl_tetas" value="{{$populasi->tgl_tetas}}" class="form-control">
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small">Ubah Status Ayam ?<span class="text-olive ml-1">*</span></label>
                                        <div>
                                        <input type="hidden" name="status_aym" {{ $populasi->status_aym == 'produktif' ? 'checked' : '' }}  value="produktif">
                                        <input type="radio" name="status_aym" {{ $populasi->status_aym == 'afkir' ? 'checked' : '' }}  value="afkir">  Afkir   
                                        <input type="radio" name="status_aym" {{ $populasi->status_aym == 'mati' ? 'checked' : '' }}  value="mati">  Mati
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small">Catatan</label>
                                        <textarea type="text"  name="catatan" class="form-control" id="catatan"
                                         placeholder="*anda dapat memberikan catatan berupa kondisi ayam saat ini">{{$populasi->catatan}}</textarea>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <button type="submit" class="btn btn-olive">Submit</button>
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
