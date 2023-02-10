<div class="wrapper wrapper--w1000">
    <div class="container-fluid">
        <div class="col-md-12">
        <div class="row">
        
            <div class="form-group col-lg-4">
                <label class="font-weight-bold text-small">Jumlah Ayam<span class="text-olive ml-1">*</span></label>
                <div class="input-group mb-3">
                    <input type="text" name="jml_aym" class="form-control" id="jml_aym" placeholder="0" value="{{ $ajax_kandang }}" readonly required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Ekor</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label class="font-weight-bold text-small">Jumlah Telur<span class="text-olive ml-1">*</span></label>
                <div class="input-group mb-3">
                    <input type="text" name="tot_telur" class="form-control" id="tot_telur" placeholder="0" value="{{ $telur_today }}" readonly required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Butir</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label class="font-weight-bold text-small">HD<span class="text-olive ml-1">*</span></label>
                <div class="input-group mb-3">
                    <input type="text" value="{{$hd}}" name="hd" class="form-control" id="hd" placeholder="0" readonly required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
