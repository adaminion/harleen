<div id="delete-modal" class="modal fade" tabindex="-1", role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #c9302c; color: #fff">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ $title }}</h4>
      </div>

      <div class="modal-body">

        <div id="delete-form" class="form-group">
          <label for="delete-reason" class="control-label required">Reason for deletion</label>
          <textarea id="delete-reason" class="form-control" rows="4"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No, thanks</button>
        <button id="delete-yes" type="button" class="btn btn-danger">Yes, delete it</button>
      </div>

    </div>
  </div>
</div>