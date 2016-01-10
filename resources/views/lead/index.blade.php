@extends('layouts.master')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endpush

@section('content')
  <div class="container">
    @if (session()->has('success'))
      @include('shared.notification.success')
    @endif

    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          Lead
        </div>
      </div>
      <div class="panel-body">
        <table id="resources-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>

              @if ($workingAreaId === 'WK1047')
                <th>Basin</th>
              @endif

              <th>Closure name</th>
              <th>Play</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $index => $lead)
              <tr>
                <td>{{ $index+1 }}</td>

                @if ($workingAreaId === 'WK1047')
                  <td>{{ $lead->basin_name }}</td>
                @endif

                <td id="pn{{ $lead->id }}">{{ $lead->closure_name }}</td>
                <td>{{ $lead->play_name }}</td>

                <td>
                  <a href="{{ url('lead', [$lead->id]) }}"
                     class="btn btn-xs btn-primary">View</a>

                  <a href="{{ url('lead', [$lead->id, 'edit']) }}"
                     class="btn btn-xs btn-success">Update</a>

                  <a id="{{ $lead->id }}" name="button-delete" href="#"
                     class="btn btn-xs btn-danger" data-toggle="modal"
                     data-target="#delete-modal">Delete</a>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="text-center">
          <a href="{{ url('lead/create') }}" class="btn btn-primary">
            Create new Lead
          </a>
        </div>

      </div>
    </div>
  </div>

  @include('shared.notification.delete', ['title' => 'You are about to delete Lead'])
@endsection

@push('js')
  <script src="{{ asset('js/datatables.min.js') }}"></script>
  <script>
    $.harleen = {};

    $(document).ready(function() {
      $('#resources-table').DataTable({
        'oLanguage': {
          'sSearch': 'Filter '
        },
        'aaSorting': [],
      });
    });

    $("a[name='button-delete']").click(function(e) {
      $.harleen.id = e.currentTarget.id;
      $.harleen.name = $("#pn" + e.currentTarget.id).text();

      $.ajax({
        header: {"csrftoken": "{{ csrf_token() }}"},
        url: "{{ url("play/child") }}",
        data: {
          id: $.harleen.id,
          _token: "{{ csrf_token() }}"
        },
        type: "post",
        dataType: "json",
        success: function(data) {
          msg = "<p style='text-align:center;'>"
            + "<strong>" + $.harleen.name + "</strong></p>";

          if (! $.isEmptyObject(data)) {
            msg = msg + "<hr/><p>" + "{!! trans('crud.play.child') !!}" + "</p><hr/>";

            if (! $.isEmptyObject(data.lead)) {
              msg = msg + "<div style='margin-left: 20px;'>"
                + "<strong>Lead</strong><ul>";

              $.each(data.lead, function(i, val) {
                msg = msg + "<li>" + val.closure_name + "</li>"
              });

              msg = msg + "</ul></div>";
            }

            if (! $.isEmptyObject(data.drillable)) {
              msg = msg + "<div style='margin-left: 20px;'>"
                + "<strong>Drillable</strong><ul>";

              $.each(data.drillable, function(i, val) {
                msg = msg + "<li>" + val.closure_name + "</li>"
              });

              msg = msg + "</ul></div>";
            }

            if (! $.isEmptyObject(data.postdrill)) {
              msg = msg + "<div style='margin-left: 20px;'>"
                + "<strong>Postdrill</strong><ul>";

              $.each(data.postdrill, function(i, val) {
                msg = msg + "<li>" + val.structure_name + "</li>"
              });

              msg = msg + "</ul></div>";
            }

            if (! $.isEmptyObject(data.discovery)) {
              msg = msg + "<div style='margin-left: 20px;'>"
                + "<strong>Discovery</strong><ul>";

              $.each(data.discovery, function(i, val) {
                msg = msg + "<li>" + val.structure_name + "</li>"
              });

              msg = msg + "</ul></div>";
            }
          }

          // Menghapus isian delete-msg sebelumnya
          $("#delete-reason").val('');
          $("#delete-msg").text("");
          $("#delete-msg").append(msg);

          $("#delete-modal").modal();
        },
        error: function (xhr, status, errorThrown) {
          alert('Sorry, there is some problem in our end');
        },
      });
    });

    $("#delete-yes").click(function(e) {
      $.ajax({
        header: {"csrftoken": "{{ csrf_token() }}"},
        url: "play/destroy",
        data: {
          _token: "{{ csrf_token() }}",
          id: $.harleen.id,
          reason: $("#delete-reason").val()
        },
        type: "post",
        dataType: "text",
        success: function(data) {
          $("#delete-modal").modal("hide");
          location.reload();
        },
        error: function (xhr, status, errorThrown) {
          alert('Sorry, there is some problem in our end');
        },
      });
    });
  </script>
@endpush