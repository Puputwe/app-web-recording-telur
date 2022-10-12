@extends('layouts.master')
@section('heading', 'Pakan')
@section('page')
    <li class="breadcrumb-item active">Pakan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#addModalpakan">
                                <i class="fa fa-plus"></i>
                                Tambah data
                            </button>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="pakan-datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pakan</th>
                                    <th>Jenis Pakan</th>
                                    <th>Perusahaan</th>
                                    <th>Stok</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($pakan as $dt_pakan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $dt_pakan->nama }}</td>
                                        <td>{{ $dt_pakan->jenis }}</td>
                                        <td>{{ $dt_pakan->perusahaan }}</td>
                                        <td>{{ number_format($dt_pakan->stok) }} Kg</td>
                                        <td>{{ $dt_pakan->keterangan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"  data-target="#editModalpakan">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </button>
                                            <a href="#" class="btn btn-danger btn-sm delete"
                                                pakan-id="{{ $dt_pakan->id }}"><i class="nav-icon fas fa-trash"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Add Modal Pakan --}}
                        <div class="modal fade" id="addModalpakan" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/pakan/store" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="pakan">Nama Pakan</label>
                                                <input type="text"  name="nama" class="form-control" value="{{old('nama')}}" id="nama"
                                                    placeholder="Nama Pakan..." required>
                                                    @error('nama')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Pakan</label>
                                                    <select name="jenis" class="form-control" id="jenis" required>
                                                        <option value="">-- Pilih Jenis --</option>
                                                        <option value="Starter" {{ old('jenis') == 'afkir' ? 'Starter' : '' }}>Starter</option>
                                                        <option value="Grower" {{ old('jenis') == 'afkir' ? 'Grower' : '' }}>Grower</option>
                                                        <option value="Layer" {{ old('jenis') == 'afkir' ? 'Layer' : '' }}>Layer</option>
                                                    </select>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="pakan">Perusahaan</label>
                                                <input type="text"  name="perusahaan" class="form-control" id="perusahaan" value="{{old('perusahaan')}}"
                                                    placeholder="Perusahaan..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pakan">Stok</label>
                                                <div class="input-group mb-3">

                                                    <input type="number"  name="stok" class="form-control" id="stok" value="{{old('stok')}}"
                                                 placeholder="Stok..." required>

                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">{{old('stok')}} Kg</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ket">Keterangan</label>
                                                <textarea type="text"  name="keterangan" class="form-control" id="keterangan"
                                                    placeholder="Contoh : Penggunaan umur 1 hari - afkir" value="{{old('keterangan')}}" required>{{old('keterangan')}}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Modal Pakan --}}
                        @foreach ($pakan as $d)
                            <div class="modal fade" id="editModalpakan" tabindex="-1" role="dialog"
                                aria-labelledby="quoteForm" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content p-md-3">
                                        <div class="modal-header">
                                            <h4 class="modal-title font-weight-bold">Edit data pakan</h4>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/pakan/{{ $d->id }}/update" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label class="font-weight-bold text-small">Nama Pakan<span class="text-olive ml-1">*</span></label>
                                                        <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror" id="nama" value="{{ $d->nama }}">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label  class="font-weight-bold text-small">Jenis<span class="text-olive ml-1">*</span></label>
                                                        <select name="jenis" class="form-control" id="jenis" required>
                                                            <option value="">-- Jenis Pakan --</option>
                                                            <option {{ ($d->jenis) == 'Starter' ? 'selected' : '' }}  value="Starter">Starter</option>
                                                            <option {{ ($d->jenis) == 'Grower' ? 'selected' : '' }}  value="Grower">Grower</option>
                                                            <option {{ ($d->jenis) == 'Layer' ? 'selected' : '' }}  value="Layer">Layer</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="font-weight-bold text-small">Nama Perusahaan<span class="text-olive ml-1">*</span></label>
                                                        <input type="text" name="perusahaan" class="form-control" id="perusahaan" value="{{ $d->perusahaan }}">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="font-weight-bold text-small">Stok<span class="text-olive ml-1">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="stok" readonly="" class="form-control" id="stok" value="{{ number_format($d->stok) }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">Kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="font-weight-bold text-small">Keterangan<small
                                                                class="small text-gray">optional</small></label>
                                                        <textarea type="text" name="keterangan" rows="5" class="form-control" id="keterangan">{{ $d->keterangan }}</textarea>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @include('sweetalert::alert')
                @endsection

                @section('footer')

                @if (count($errors) > 0)
                <script type="text/javascript">
                    $( document ).ready(function() {
                        $('#addModalpakan').modal('show');
                    });
                </script>
                @endif
                    <script>
                        $('.delete').click(function() {
                            var pakan_id = $(this).attr('pakan-id');
                            swal({
                                    title: "Hapus data recording",
                                    text: "Yakin akan menghapus data penggunaan pakan ini ?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    console.log(willDelete);
                                    if (willDelete) {
                                        window.location = "/pakan/" + pakan_id + "/delete"
                                    }
                                });
                        });
                    </script>

                    <script>
                        $(document).ready(function() {
                            $('#pakan-datatable').DataTable();
                        });
                    </script>

                @endsection
