@foreach ($ajax_pakan as $d )
<div class="form-group">
    <label>Perusahaan</label>
    <input type="text" name="perusahaan" id="perusahaan" class="form-control" value="{{$d->perusahaan}}" readonly required>
</div>
@endforeach