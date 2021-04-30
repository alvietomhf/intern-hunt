<div class="modal-dialog" role="document">
  <form action="{{ route('vacancy.update', [$data->id]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Lowongan</h5>
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
          <div class="form-group">
            <label for="tag">Tag</label>
            <select class="select2 form-control tag-select2" name="tags[]" id="tag" multiple="multiple">
              @foreach ($data->tags as $tag)
                  <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endforeach
              @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="row d-flex-justify-content-center">
            <div class="col-sm-6 col-12">
            <label for="range">Mulai</label>
            <input type="text" name="begin_at" required class="form-control" id="begin_at" value="{{ \Carbon\Carbon::parse($data->begin_at)->format('m/d/Y') }}">
            </div>
            <div class="col-sm-6 col-12">
            <label for="range">Berakhir</label>
            <input type="text" name="end_at" required class="form-control" id="end_at" value="{{ \Carbon\Carbon::parse($data->end_at)->format('m/d/Y') }}">
            </div>
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
        placeholder: "Pilih",
    })
    $('.select2-search__field').css('width', '100%')
  })
</script>
<script>
  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $('#begin_at').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      minDate: today,
      maxDate: function () {
          return $('#end_at').val();
      }
  });
  $('#end_at').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      minDate: function () {
          return $('#begin_at').val();
      }
  });
</script>

