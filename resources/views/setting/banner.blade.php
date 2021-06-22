<div class="modal-dialog" role="document">
  <form action="{{ route('banner.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <fieldset class="form-group">
            <label for="banner">Image *.jpg/jpeg/png</label>
            <input type="file" class="form-control-file" id="banner" name="banner" required>
          </fieldset>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
