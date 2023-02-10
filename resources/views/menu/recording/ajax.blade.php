@foreach ($ajax_pakan as $val)
<div class="container-fluid">
    <div class="row">
        <div class="form-group col-lg-6">
        <div class="card border-success mb-2" style="min-width: 28rem;">
            <div class="card-header">Merk Pakan</div>
            <div class="card-body text-dark">
              <h5 class="card-title">{{ $val->perusahaan }}</h5>
            </div>
        </div>
        </div>
        <div class="form-group col-lg-6">
        <div class="card border-success mb-2" style="min-width: 28rem;">
            <div class="card-header">Stok Tersedia</div>
            <div class="card-body text-dark">
              <h5 class="card-title">{{ $val->stok }}</h5>
            </div>
        </div>
        </div>
</div>
</div>
@endforeach



