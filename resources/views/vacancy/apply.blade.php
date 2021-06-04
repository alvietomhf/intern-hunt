<div class="modal-dialog modal-lg" role="document">
  <form action="{{ route('vacancy.apply', [$data->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Lamar Lowongan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="note">Cover Letter</label>
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <fieldset class="form-group">
                      <label for="file">Proposal *.pdf</label>
                      <input type="file" class="form-control-file" id="file" name="file" required>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-apply" >Lamar</button>
        </div>
    </div>
  </form>
</div>
<script>
  CKEDITOR.replace('note');
</script>