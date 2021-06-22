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
          <div class="row">
            <div class="col-xl-6 col-md-6 col-12">
              <label for="range">Tanggal Mulai</label>
              <div class="d-flex justify-content-between">
                <fieldset class="form-group">
                  <select class="select2 form-control mstart-select2" name="mstart" id="mstart" required>
                    <option></option>
                    @foreach ($months as $key => $value)
                        <option {{ $value == $smonth ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </fieldset>
                <fieldset class="form-group ml-1">
                  <select class="select2 form-control ystart-select2" name="ystart" id="ystart" required>
                    <option></option>
                    @foreach ($years as $key => $value)
                        <option {{ $value == $syear ? 'selected' : '' }} value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </fieldset>
              </div>
            </div>
            <div class="col-xl-6 col-md-6 col-12">
              <label for="range" id="lbl_end">Tanggal Akhir</label>
              @if($data->end_at != 'now')
              <div class="d-flex justify-content-between" id="end">
                <fieldset class="form-group">
                  <select class="select2 form-control mend-select2" name="mend" id="mend" required>
                    <option></option>
                    @foreach ($months as $key => $value)
                        <option {{ $value == $emonth ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </fieldset>
                <fieldset class="form-group ml-1">
                <select class="select2 form-control yend-select2" name="yend" id="yend" required>
                  <option></option>
                  @foreach ($years as $key => $value)
                      <option {{ $value == $eyear ? 'selected' : '' }} value="{{ $value }}">{{ $value }}</option>
                  @endforeach
                </select>
                </fieldset>
              </div>
              @else
              <p class="mt-1" id="txt_noww">sampai saat ini</p>
              @endif
            </div>
          </div>
          <fieldset id="chck_now">
            <div class="vs-checkbox-con vs-checkbox-primary">
                <input type="checkbox" name="now" value="now" id="now" @if($data->end_at == 'now') checked @endif>
                <span class="vs-checkbox">
                    <span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i>
                    </span>
                </span>
                <span >Sampai saat ini</span>
            </div>
          </fieldset>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>
<script>
  $(document).ready(function() {
    $('.mstart-select2').select2({
        dropdownAutoWidth: true,
        multiple: false,
        width: '100%',
        height: '30px',
        placeholder: "Bulan",
    })
    $('.ystart-select2').select2({
        dropdownAutoWidth: true,
        multiple: false,
        width: '100%',
        height: '30px',
        placeholder: "Tahun",
    })
    $('.mend-select2').select2({
        dropdownAutoWidth: true,
        multiple: false,
        width: '100%',
        height: '30px',
        placeholder: "Bulan",
    })
    $('.yend-select2').select2({
        dropdownAutoWidth: true,
        multiple: false,
        width: '100%',
        height: '30px',
        placeholder: "Tahun",
    })
    $('.select2-search__field').css('width', '100%')
  })
</script>
<script>
  $(document).ready(function(){
    const end = $('#end')

    $("#now").change(function(){
      if($(this).is(':checked')){
        $('#end').remove()
        $('<p class="mt-1" id="txt_now">sampai saat ini</p>').insertAfter('#lbl_end')
      }
      if(!$(this).is(':checked')){
        $('#txt_noww').remove()
        $('#txt_now').remove()
        $('<div class="d-flex justify-content-between" id="end"><fieldset class="form-group"><select class="select2 form-control mend-select2" name="mend" required id="mend"><option></option>@foreach($months as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></fieldset><fieldset class="form-group ml-1"><select class="select2 form-control yend-select2" name="yend" required id="yend"><option></option>@foreach($years as $key => $value)<option value="{{ $value }}">{{ $value }}</option>@endforeach</select></fieldset></div>').insertAfter('#lbl_end')
        $('.mend-select2').select2({
            dropdownAutoWidth: true,
            multiple: false,
            width: '100%',
            height: '30px',
            placeholder: "Bulan",
        })
        $('.yend-select2').select2({
            dropdownAutoWidth: true,
            multiple: false,
            width: '100%',
            height: '30px',
            placeholder: "Tahun",
        })
        $('.select2-search__field').css('width', '100%')          
      }
    })
  })
</script>
