<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Detail Lowongan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-2">
                  <img width="100rem" height="100rem" src="{{ asset('uploads/images/default.png') }}" alt="">
              </div>
              <div class="col-md-10">
                  <h3 class="mb-2">{{ $data->title ?? '' }} | {{ $data->biography->name ? $data->biography->name : $data->biography->user->name }}</h3>
                  <ul>
                    @foreach (json_decode($data->description) as $key => $value)
                    <li>{{ $value ?? '' }}</li>
                    @endforeach
                  </ul>
              </div>
          </div>
      </div>
      @role('siswa')
      <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-primary btn-apply" data-href="{{ route('vacancy.getApply', [$data->id]) }}" data-container=".child-modal">Lamar</button>
      </div>
      @endrole
  </div>
</div>
<script>
  $('.btn-apply').on('click', function(e){
      var t = $(this).data("container")
      $.ajax({
          url: $(this).data('href'),
          dataType: "html",
          success: function(e) {
              $(t).html(e).modal("show")
          }
      })
  })
</script>