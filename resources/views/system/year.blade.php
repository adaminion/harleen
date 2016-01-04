@extends('layouts.master')

@section('content')
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div class="panel-title">
        Set RPS Year
      </div>
    </div>
    <div class="panel-body">
      <h3>Current Year: {{ getActiveRPSYear()->rps_year }}</h3>
    </div>
  </div>
</div>
@endsection