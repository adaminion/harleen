@extends('layouts.master')

@section('content')
  <div class="container">
    <div class="text-center page-title">
      <h1>Create New Lead</h1>
    </div>

    {{
      Form::model(['lead' => $lead, 'gcf' => $gcf],
        ['url' => $url, 'method' => $method,
          'class' => 'form-horizontal', 'id' => 'form-main'])
    }}

    @if (App::environment('local'))
      <div class="panel panel-info">
        <div class="panel-heading">Dev Toolbox</div>
        <div class="panel-body">
          <a id="devLeadSampleInput" href="#" class="btn btn-success">Sample</a>
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
          {{ Form::basin('lead[basin_name]') }}
        @endif

        {{ Form::province('lead[province_name]') }}
        {{ Form::bsText('lead[structure_name]', 'Structure name', true) }}
        {{ Form::bsText('lead[closure_name]', 'Closure name', true) }}
        {{ Form::coord('lead[latitude]', 'Center latitude', 'lat') }}
        {{ Form::coord('lead[longitude]', 'Center longitude', 'long') }}
        {{ Form::clarified('lead[clarified]')}}
        {{ Form::bsDate('lead[initiate]', 'Initiation date', true)}}
        {{ Form::analogTo('lead[analog_to]') }}
        {{ Form::analogDistance('lead[analog_distance]') }}
        {{ Form::shore('lead[shore]') }}
        {{ Form::terrain('lead[terrain]') }}
        {{ Form::nearbyField('lead[nearby_field]') }}
        {{ Form::nearbyInfra('lead[nearby_infra]') }}
        {{ Form::remark('lead[remark]') }}
        {{
          Form::survey('survey', [
            's2' => '2D Seismic',
            'geo' => 'Geological',
            'grav' => 'Gravity',
            'chem' => 'Geochemistry',
            'elec' => 'Electromagnetic',
            'resi' => 'Resistivity',
            'oter' => 'Other'
          ])
        }}

        @if (actionName() === 'edit')
          {{ Form::bsTextarea('lead[update_reason]', 'Update reason', true) }}
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

        <div id="survey-s2-panel" class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              2D Seismic
            </div>
          </div>
          <div class="panel-body">
            {{ Form::bsNumber('lead[s2_low]', 'Low estimate', false, 'Acre') }}
            {{ Form::bsNumber('lead[s2_best]', 'Best estimate', true, 'Acre') }}
            {{ Form::bsNumber('lead[s2_high]', 'High estimate', false, 'Acre') }}
            {{ Form::bsText('lead[s2_year]', 'Acquisition year') }}
            {{
              Form::bsSelect('lead[s2_vintage]', 'Total vintage', [
                'Single' => 'Single',
                'Multiple' => 'Multiple'
              ])
            }}
            {{ Form::bsNumber('lead[s2_crossline]', 'Total crossline') }}
            {{
              Form::bsNumber('lead[s2_coverage]', 'Total coverage area', false,
                'Km<sup>2</sup>')
            }}
            {{
              Form::bsNumber('lead[s2_avg_interval]',
                'Average parallel spacing interval', false, 'Km')
            }}
            {{ Form::bsText('lead[s2_late_year]', 'Latest processing year') }}
            {{ Form::lateMethod('lead[s2_late_method]') }}
            {{ Form::seismicImage('lead[s2_image]') }}
          </div>
        </div> {{-- 2D Seismic --}}

        <div id="survey-geo-panel" class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              Geological Field
            </div>
          </div>
          <div class="panel-body">
            {{ Form::bsNumber('lead[geo_low]', 'Low estimate', false, 'Acre') }}
            {{ Form::bsNumber('lead[geo_best]', 'Best estimate', true, 'Acre') }}
            {{ Form::bsNumber('lead[geo_high]', 'High estimate', false, 'Acre') }}
            {{ Form::bsText('lead[geo_year]', 'Acquisition year') }}
            {{
              Form::bsSelect('lead[geo_method]', 'Survey method', [
                'Stream Sampling' => 'Stream Sampling',
                'Random Sampling' => 'Random Sampling'
              ])
            }}
            {{
              Form::bsNumber('lead[geo_coverage]', 'Total coverage area', false,
                'Km<sup>2</sup>')
            }}
          </div>
        </div> {{-- Geological Field --}}

      </div>
    </div> {{-- Data Availability --}}

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
  <script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
@endpush