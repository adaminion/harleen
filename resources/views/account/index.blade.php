@extends('layouts.master')

@section('content')
  <div class="modal fade" id="modal-reset" tabindex="-1" role="dialog"
       aria-labelled="modal-reset-label">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"
                  aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Are you sure&#63;</h4>
        </div>
        <div class="modal-body">
          <p>
            If you sure what you are doing. Please remember to <strong>keep</strong>
            the Excel file we give you after reset process is complete.
          </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" data-dismiss="modal">
            No, thanks
          </button>
          <button id="btn-reset" type="submit" class="btn btn-danger">
            Yes, reset all
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <div class="panel-title">
          Reset All Username And Password
        </div>
      </div>
      <div class="panel-body">
        <p>
          Resetting all password would interfere with any KKKS who working in
          RPS website right now, it is best to reset the username and password
          after work-hour.
        </p>
        <button type="button" class="btn btn-danger" data-toggle="modal"
                data-target="#modal-reset">
          Reset all
        </a>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script src="{{ asset('js/blockui.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#btn-reset').click(function() {
        $('#modal-reset').modal('toggle');
        $.blockUI({
          css: {
            border: 'none',
            opacity: 1,
            backgroundColor: '#34495e',
            color: '#fff',
            left: 0,
            width: '100%',
            paddingLeft: '10%',
            paddingBottom: '17px',
            textAlign: 'left',
          },
          message: '<h2>A moment.<br/>Resetting all user and password.</h2>',
          baseZ: 2000
        });

        $.ajax({
          header: {'csrftoken': '{{ csrf_token() }}'},
          url: 'account/reset/all',
          data: {'_token': '{{ csrf_token() }}'},
          type: 'POST',
          dataType: 'text',
          success: function(response) {
            $.unblockUI();
            window.location.href = response;
          },
          complete: function(xhr, status) {
            $.unblockUI();
          }
        });
      });
    });
  </script>
@endpush