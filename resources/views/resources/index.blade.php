@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
        National Resources
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-5">
          <div class="form-group">
            <label for="rps-year">RPS year</label>
            <select id="rps-year" name="rps-year" class="form-control">
              <option value="2015">2015</option>
            </select>
          </div>
        </div>
      </div>
      <table id="resources-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Basin Order</th>
            <th>Basin</th>
            <th>Working area</th>
            <th>Play</th>
            <th>Lead</th>
            <th>Drillable</th>
            <th>Postdrill</th>
            <th>Discovery</th>
            <th>Official letter</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($resources as $data)
          <tr>
            <td>{{ $data->sequence }}</td>
            <td>{!! $data->basin !!}</td>
            <td>{{ $data->working_area_name }}</td>
            <td>{{ $data->play }}</td>
            <td>{{ $data->lead }}</td>
            <td>{{ $data->drillable }}</td>
            <td>{{ $data->postdrill }}</td>
            <td>{{ $data->discovery }}</td>
            <td></td>
            <td></td>
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
      'paging': false,
      'aoColumns': [
        {'bVisible': false},
        {'iDataSort': 0},
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
      ]
    });
  });
</script>
@endsection