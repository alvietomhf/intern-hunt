<div class="modal-dialog" role="document">
  <form action="{{ route('experience.update', [$data->id]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Pengalaman</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $data->title }}" required>
          </div>
          <fieldset class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" id="basicTextarea" rows="5" name="description" id="description" required>{{ $data->description }}</textarea>
          </fieldset>
          <label for="range">Rentang tahun</label>
          <div class="input-group input-daterange" id="range">
            <input type="text " name="begin_at" class="form-control" required value="{{ $data->begin_at }}">
            <div class="input-group-addon">TO</div>
            <input type="text" name="end_at" class="form-control" required value="{{ $data->end_at }}">
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
<script>
  $('#range input').each(function () {
        $(this).datepicker({
            autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $(this).datepicker('clearDates');
    });
</script>
