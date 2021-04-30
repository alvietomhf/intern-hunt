<div class="modal-dialog" role="document">
  <form action="{{ route('sfile.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah File ke Industri</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="biography_id" value="{{ $bio_id }}">
          <input type="hidden" name="vacancy_id" value="{{ $vacancy_id }}">
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" required>
          </div>
          <fieldset class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" id="basicTextarea" rows="5" name="description" required></textarea>
          </fieldset>
          <fieldset class="form-group">
            <label for="file">File *.pdf</label>
            <input type="file" class="form-control-file" id="file" name="file" required>
          </fieldset>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
