@extends('layouts.master')

@section('content')
  <div class="container-fluid">
    <h3 class="text-center">{{ $data['working_area_name'] }}</h3>
    <h4 class="text-center">{{ $data['contractor'] }}</h4>
  </div>
@endsection