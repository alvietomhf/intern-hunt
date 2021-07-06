<div class="modal-dialog" role="document">
  <form action="{{ route('bio.imageUpload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Foto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <fieldset class="form-group">
            <label for="image">Foto *.jpg/jpeg/png</label>
            <input type="file" class="form-control-file" id="image" name="image[]" multiple="true" required>
          </fieldset>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
