<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Detail Proposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-12">
                  <p>{!! $data->note ?? '' !!}</p>
                  <a href="{{ asset('uploads/files/'. $data->file) }}" target="_blank" rel="noopener noreferrer">{{ $data->file ?? '' }}</a>
              </div>
          </div>
      </div>
  </div>
</div>
<script>