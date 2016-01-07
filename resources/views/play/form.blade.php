@extends('layouts.master')

@section('content')
  <div class="container">
    <div class="text-center page-title">
      <h1>Create New Play</h1>
    </div>

    {{
      Form::model(['play' => $play, 'gcf' => $gcf],
        ['url' => $url, 'method' => $method,
          'class' => 'form-horizontal', 'id' => 'form-main'])
    }}

    @if (App::environment('local'))
      <div class="panel panel-info">
        <div class="panel-heading">Dev Toolbox</div>
        <div class="panel-body">
          <a id="devPlaySampleInput" href="#" class="btn btn-success">Sample</a>
        </div>
      </div>
    @endif

    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          General Data
        </div>
      </div>
      <div class="panel-body">
        @if (request()->user()->working_area_id === 'WK1047')
          {{ Form::basin('play[basin_name]') }}
        @endif

        {{ Form::province('play[province_name]') }}
        {{ Form::analogTo('play[analog_to]') }}
        {{ Form::analogDistance('play[analog_distance]') }}
        {{ Form::shore('play[shore]') }}
        {{ Form::terrain('play[terrain]') }}
        {{ Form::nearbyField('play[nearby_field]') }}
        {{ Form::nearbyInfra('play[nearby_infra]') }}
        {{ Form::remark('play[remark]') }}

        @if (actionName() === 'edit')
          {{ Form::bsTextarea('play[update_reason]', 'Update reason', true) }}
        @endif
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
          {{ Form::bsText('play[s2_year]', 'Acquisition year') }}
          {{ Form::bsNumber('play[s2_crossline]', 'Total seismic crossline') }}
          {{ Form::bsNumber('play[s2_line_distance]', 'Seismic intervall distance', false, 'Km') }}
        </div>
      </div> {{-- 2D Seismic --}}

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            Geochemistry
          </div>
        </div>
        <div class="panel-body">
          {{ Form::bsText('play[chem_sample]', 'Total sample') }}
          {{ Form::bsNumber('play[chem_depth]', 'Survey range depth', false, 'Feet') }}
        </div>
      </div> {{-- Geochemistry --}}

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            Gravity
          </div>
        </div>
        <div class="panel-body">
          {{ Form::bsNumber('play[grav_acreage]', 'Survey acreage', false, 'Acre') }}
          {{ Form::bsNumber('play[grav_depth]', 'Survey range depth', false, 'Feet') }}
        </div>
      </div> {{-- Gravity --}}

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            Resistivity
          </div>
        </div>
        <div class="panel-body">
          {{ Form::bsNumber('play[resi_acreage]', 'Survey acreage', false, 'Acre') }}
        </div>
      </div> {{-- Resistivity --}}

      </div>
    </div> {{-- General Data --}}

    @include('shared.gcf')

    @if (isset($submitButtonText))
      <div class="text-center" style="margin-bottom: 15px;">
        {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'submit-button']) }}
      </div>
    @endif

    {{ Form::close() }}
  </div>
@endsection

@push('js')
  @if (App::environment('local'))
    <script src="{{ asset('js/dev.js') }}"></script>
  @endif

  <script src="{{ asset('js/form.js') }}"></script>
@endpush