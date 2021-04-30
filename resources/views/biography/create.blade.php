<div class="modal-dialog" role="document">
  <form action="{{ route('biography.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Biografi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          @role('siswa|guru')
          <fieldset class="form-group">
            <textarea class="form-control" id="basicTextarea" rows="5" placeholder="Deskripsi" name="description" required></textarea>
          </fieldset>
          @endrole
          @role('industri')
          <div class="form-group">
            <label for="name">Nama Industri</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <fieldset class="form-group">
            <textarea class="form-control" id="basicTextarea" rows="5" placeholder="Deskripsi" name="description" required></textarea>
          </fieldset>
          <fieldset class="form-group">
            <label for="image">Image *.jpg/jpeg/png</label>
            <input type="file" class="form-control-file" id="image" name="image[]" multiple="true" required>
          </fieldset>
          @endrole
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
