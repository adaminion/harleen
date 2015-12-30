@extends('layouts.master')

@section('content')
<div class="container">
  <div class="text-center page-title">
    <h1>Create New Play</h1>
  </div>

  @include('play._form')
</div>
@endsection