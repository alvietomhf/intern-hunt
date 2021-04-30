<div class="modal-dialog" role="document">
  <form action="{{ route('vacancy.ifile.store', [$vacancy_id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah File</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
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
          <div class="form-group">
            <label for="student">Siswa</label>
            <select class="select2 form-control tag-select2" name="students[]" id="student" multiple="multiple">
              @foreach ($data as $value)
                  <option value="{{ $value->user->id }}">{{ $value->user->name }} - {{ $value->vacancy->title }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>

<script>
  $(document).ready(function() {
    $('.tag-select2').select2({
        dropdownAutoWidth: true,
        multiple: true,
        width: '100%',
        height: '30px',
        placeholder: "Pilih Siswa",
    })
    $('.select2-search__field').css('width', '100%')
  })
</script>
