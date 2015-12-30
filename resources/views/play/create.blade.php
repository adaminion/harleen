@extends('layouts.master')

@section('content')
<div class="container">
  <div class="text-center page-title">
    <h1>Create New Play</h1>
  </div>

  {{ Form::model($model, ['url' => 'play/store']) }}
    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
        {{$error}}
      @endforeach
    @endif
    @include('play._form')
    {{ Form::submit('Yay') }}
  {{ Form::close() }}
</div>
@endsection