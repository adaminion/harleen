@extends('layouts.master')

@section('content')
  <div class="container">
    <h1>Developer</h1>
    <div class="row">
      <div class="col-md-3">
        @include('card.year')
      </div>
      <div class="col-md-9">
        @include('card.notif')
      </div>
    </div>
  </div>
@endsection