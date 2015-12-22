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
      <table id="resources-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Basin Order</th>
            <th>Basin (west to east)</th>
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
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="javascript">
  $(document).ready(function() {
    $('#resources-table').DataTable({
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
    });
  });
</script>
@endsection