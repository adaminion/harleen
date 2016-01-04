@extends('layouts.master')

@section('content')
  <div class="container">
    <h1>Developer</h1>
    <div class="row">
      <div class="col-md-5">
        @include('card.year')
      </div>
      <div class="col-md-7">
        @include('card.notif')
      </div>
    </div>
  </div>
@endsection