<div class="modal-dialog" role="document">
  <form action="{{ route('biography.update', [$data->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Biografi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          @role('siswa|guru')
          <fieldset class="form-group">
            <textarea class="form-control" id="basicTextarea" rows="3" placeholder="Deskripsi" name="description" required>{{ $data->description }}</textarea>
          </fieldset>
          @endrole
          @role('industri')
          <div class="form-group">
            <label for="name">Nama Industri</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" required>
          </div>
          <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $data->address }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $data->email }}">
          </div>
          <div class="form-group">
            <label for="phone">Nomor HP</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $data->phone }}">
          </div>
          <fieldset class="form-group">
            <textarea class="form-control" id="basicTextarea" rows="3" placeholder="Deskripsi" name="description" required>{{ $data->description }}</textarea>
          </fieldset>
          <fieldset class="form-group">
            <label for="image">Image *.jpg/jpeg/png</label>
            <input type="file" class="form-control-file" id="image" name="image[]" multiple="true">
          </fieldset>
          @endrole
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
