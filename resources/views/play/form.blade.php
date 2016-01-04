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
        @if (request()->user()->working_area_id === 'WK1047')
        {{ Form::basin() }}
        @endif

        {{ Form::province() }}
        {{ Form::analogTo() }}
        {{ Form::analogDistance() }}
        {{ Form::shore() }}
        {{ Form::terrain() }}
        {{ Form::nearbyField() }}
        {{ Form::nearbyInfra() }}
        {{ Form::remark() }}
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          Data Availability
        </div>
      </div>
      <div class="panel-body">

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            2D Seismic
          </div>
        </div>
        <div class="panel-body">
          {{ Form::bsText('s2_year', 'Acquisition year') }}
          {{ Form::bsNumber('s2_crossline', 'Total seismic crossline') }}
          {{ Form::bsNumber('s2_line_distance', 'Seismic intervall distance', false, 'Km') }}
        </div>
      </div> {{-- 2D Seismic --}}

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            Geochemistry
          </div>
        </div>
        <div class="panel-body">
          {{ Form::bsText('chem_sample', 'Total sample') }}
          {{ Form::bsNumber('chem_depth', 'Survey range depth', false, 'Feet') }}
        </div>
      </div> {{-- Geochemistry --}}

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            Gravity
          </div>
        </div>
        <div class="panel-body">
          {{ Form::bsNumber('grav_acreage', 'Survey acreage', false, 'Acre') }}
          {{ Form::bsNumber('grav_depth', 'Survey range depth', false, 'Feet') }}
        </div>
      </div> {{-- Gravity --}}

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            Resistivity
          </div>
        </div>
        <div class="panel-body">
          {{ Form::bsNumber('resi_acreage', 'Survey acreage', false, 'Acre') }}
        </div>
      </div> {{-- Resistivity --}}

      </div>
    </div> {{-- General Data --}}

    @include('shared.gcf')

    {{ Form::submit('Create new Play', ['class' => 'btn btn-primary']) }}

  {{ Form::close() }}
</div>
@endsection