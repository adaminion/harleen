@extends('layouts.master')

@section('content')
  <div class="container">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <div class="panel-title">
          Username &amp; Password
        </div>
      </div>
      <div class="panel-body">
        <p>
          Resetting all password would interfere with any KKKS who working in
          RPS website right now, it is best to reset the username and password
          after work-hour.
        </p>
        <a href="{{ url('account/reset/all') }}" class="btn btn-danger">
          Reset all Username Password
        </a>
      </div>
    </div>
  </div>
@endsection