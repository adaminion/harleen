@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
  <div class="container">

    @if (session()->has('success'))
    @include('shared.notification.success')
    @endif

    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          Play
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
              <th>Play name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $index => $play)
            <tr>
              <td>{{ $index+1 }}</td>
              @if ($workingAreaId === 'WK1047')
              <td>{{ $play->basin_name }}</td>
              @endif
              <td>{{ $play->name }}</td>
              <td>
                <a href="{{ url('play', [$play->id]) }}" class="btn btn-xs btn-primary">View</a>
                <a href="{{ url('play', [$play->id, 'edit']) }}" class="btn btn-xs btn-success">Update</a>
                <a href="{{ url('play', [$play->id, 'destroy']) }}" class="btn btn-xs btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="text-center">
          <a href="{{ url('play/create') }}" class="btn btn-primary">
            Create new Play
          </a>
        </div>

      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#resources-table').DataTable({
      'oLanguage': {
        'sSearch': 'Filter '
      },
      'aaSorting': [],
    });
  });
</script>
@endsection