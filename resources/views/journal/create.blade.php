<div class="modal-dialog" role="document">
  <form action="{{ route('journal.store') }}" method="post">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Jurnal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="vacancy_id" value="{{ $vacancy_id }}">
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" required>
          </div>
          <fieldset class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" id="basicTextarea" rows="5" name="description" required></textarea>
          </fieldset>
          <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="text" name="date" required class="form-control datepicker" id="date">
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
<script>
  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    iconsLibrary: 'fontawesome',
    maxDate: today,
  });
</script>
