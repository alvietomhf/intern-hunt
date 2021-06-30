<div class="modal-dialog" role="document">
  <form action="{{ route('internship.store') }}" method="post">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Perusahaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama Perusahaan</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" class="form-control" required>
          </div>
          <fieldset id="check">
            <label>
                <input type="checkbox" value="" id="checkbox">
                Tambah anggota
            </label>
          </fieldset>
          <div class="form-group" id="form-student">
            <label for="student">Anggota</label>
            <select class="select2 form-control tag-select2" name="students[]" id="student" multiple="multiple">
              @foreach ($students as $value)
                  <option value="{{ $value->student->id }}">{{ $value->student->name }}</option>
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
$(document).ready(function(){
    let student = $('#form-student')
    $('#form-student').remove()
    
    $('#checkbox').click(function(){
        if($(this).is(':checked')){
          student.insertBefore('#check')
          $('.tag-select2').select2({
              dropdownAutoWidth: true,
              multiple: true,
              width: '100%',
              height: '30px',
              placeholder: "Pilih Anggota",
          })
          $('.select2-search__field').css('width', '100%')
        } else {
          $('#form-student').remove()
        }
    })
})
</script>
