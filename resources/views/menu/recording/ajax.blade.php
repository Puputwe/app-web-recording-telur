@foreach ($ajax_pakan as $b )
<div class="container-fluid">
    <div class="row">
        <div class="form-group col-lg-4">
            <label class="font-weight-bold text-small">Jenis Pakan</label>
            <input type="text" name="jenis" class="form-control" id="jenis" value="{{$b->jenis}}" readonly required>
        </div>
        <div class="form-group col-lg-4">
            <label class="font-weight-bold text-small">Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control" id="perusahaan" value="{{$b->perusahaan}}" readonly required>
        </div>
    <div class="form-group col-lg-4">
        <label class="font-weight-bold text-small">Stok Tersedia<span class="text-olive ml-1">*</span></label>
        <div class="input-group mb-3">
            <input type="number" name="stok" class="form-control" id="stok" value="{{$b->stok}}" readonly required>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">Kg</span>
            </div>
        </div>
    </div>
</div>
@endforeach