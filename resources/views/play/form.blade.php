@extends('layouts.master')

@section('content')
<div class="container">
  <div class="text-center page-title">
    <h1>Create New Play</h1>
  </div>

  {{ Form::model($model, ['url' => 'play/store', 'class' => 'form-horizontal']) }}
    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
        {{$error}}
      @endforeach
    @endif

    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          General Data
        </div>
      </div>
      <div class="panel-body">

        {{ Form::bsSelect('basin_name', 'Basin name', allBasin(), true, 'Km') }}

      </div>
    </div>

    @include('shared.gcf')
   {{ Form::submit('Create new Play', ['class' => 'btn btn-primary']) }}

  {{ Form::close() }}
</div>
@endsection