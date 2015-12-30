@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
  <div class="container">
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
              @if (request()->user()->working_area_id === 'WK1047')
              <th>Basin</th>
              @endif
              <th>Play name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $play)
            <tr>
              @if (request()->user()->working_area_id === 'WK1047')
              <td>{{ $play->basin_name }}</td>
              @endif
              <td>{{ createPlayName($play->litho, $play->formation, $play->formation_lvl, $play->age_period, $play->age_epoch, $play->env, $play->trap) }}</td>
              <td>
                <a href="#" class="btn btn-xs btn-primary">View</a>
                <a href="#" class="btn btn-xs btn-success">Update</a>
                <a href="#" class="btn btn-xs btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
    });
  });
</script>
@endsection