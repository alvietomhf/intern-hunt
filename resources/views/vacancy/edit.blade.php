<div class="modal-dialog" role="document">
  <form action="{{ route('vacancy.update', [$data->id]) }}" method="post">
    @csrf
    @method('PUT')
    @php
    $count = count(json_decode($data->description));
    @endphp
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
          <div id="description_div">
            <label for="description">Kriteria Kandidat</label><button class="btn btn-sm btn-outline-primary ml-1" id="btn_description"><i class="fa fa-plus"></i> Tambah Kriteria</button>
            @foreach (json_decode($data->description) as $key => $value)
                @if($key == 0)
                  <div class="form-group mt-1">
                    <input type="text" name="description[]" class="form-control" value="{{ $value }}" required>
                  </div>
                @else
                  <div class="form-group d-flex justify-content-between align-items-center">
                    <input type="text" name="description[]" class="form-control" value="{{ $value }}" required>
                    <a class="delete ml-2"><i class="fa fa-remove"></i></a>
                  </div>
                @endif
            @endforeach
          </div>
          <div class="form-group">
            <label for="tag">Tag</label>
            <select class="select2 form-control tag-select2" name="tag" id="tag" required>
              @foreach ($tags as $tag)
                  <option {{ $tag->id == $data->tag_id ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
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
        multiple: false,
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
<script>
  $(document).ready(function() {
      var max_fields = 10;
      var wrapper = $("#description_div");
      var add_button = $("#btn_description");

      var x = @json($count);
      console.log(x)
      $(add_button).click(function(e) {
          e.preventDefault();
          if (x < max_fields) {
              x++;
              $(wrapper).append('<div class="form-group d-flex justify-content-between align-items-center"><input type="text" name="description[]" class="form-control" required><a class="delete ml-2"><i class="fa fa-remove"></i></a></div>'); //add input box
          } else {
              alert('Maksimal 10 Deskripsi!')
          }
      });

      $(wrapper).on("click", ".delete", function(e) {
          e.preventDefault();
          $(this).parent('div').remove();
          x--;
      })
  });
</script>

