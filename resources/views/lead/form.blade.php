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

          @if (isset($submitButtonText))
            {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'submit-button']) }}
          @endif
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
        {{ Form::playList('lead[play_id]', $playList) }}

        @if (request()->user()->working_area_id === 'WK1047')
          {{ Form::basin('lead[basin_name]') }}
        @endif

        {{ Form::province('lead[province_name]') }}
        {{ Form::bsText('lead[structure_name]', 'Structure name', true) }}
        {{ Form::bsText('lead[closure_name]', 'Closure name', true) }}
        {{ Form::latitude('lead[latitude]') }}
        {{ Form::longitude('lead[longitude]') }}
        {{ Form::clarified('lead[clarified]')}}
        {{ Form::bsDate('lead[initiate]', 'Initiation date', true)}}
        {{ Form::shore('lead[shore]') }}
        {{ Form::terrain('lead[terrain]') }}
        {{ Form::nearbyField('lead[nearby_field]') }}
        {{ Form::nearbyInfra('lead[nearby_infra]') }}
        {{ Form::remark('lead[remark]') }}
        {{
          Form::survey('lead[survey]', [
            'lead[s2_data]' => '2D Seismic',
            'lead[geo_data]' => 'Geological',
            'lead[chem_data]' => 'Geochemistry',
            'lead[grav_data]' => 'Gravity',
            'lead[elec_data]' => 'Electromagnetic',
            'lead[resi_data]' => 'Resistivity',
            'lead[oter_data]' => 'Other'
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

        <div id="s2-panel" class="panel panel-default hidden">
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
            {{ Form::bsNumber('lead[s2_coverage]', 'Total coverage area', false, 'Acre') }}
            {{
              Form::bsNumber('lead[s2_avg_interval]',
                'Average parallel spacing interval', false, 'Km')
            }}
            {{ Form::bsText('lead[s2_late_year]', 'Latest processing year') }}
            {{ Form::lateMethod('lead[s2_late_method]') }}
            {{ Form::seismicImage('lead[s2_image]') }}
          </div>
        </div> {{-- 2D Seismic --}}

        <div id="geo-panel" class="panel panel-default hidden">
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
            {{ Form::bsNumber('lead[geo_coverage]', 'Total coverage area', false, 'Acre') }}
          </div>
        </div> {{-- Geological Field --}}

        <div id="chem-panel" class="panel panel-default hidden">
          <div class="panel-heading">
            <div class="panel-title">
              Geochemistry
            </div>
          </div>
          <div class="panel-body">
            {{ Form::bsNumber('lead[chem_low]', 'Low estimate', false, 'Acre') }}
            {{ Form::bsNumber('lead[chem_best]', 'Best estimate', true, 'Acre') }}
            {{ Form::bsNumber('lead[chem_high]', 'High estimate', false, 'Acre') }}
            {{ Form::bsText('lead[chem_year]', 'Acquisition year') }}
            {{ Form::bsNumber('lead[chem_interval]', 'Interval samples range', false, 'Feet') }}
            {{ Form::bsText('lead[chem_sample]', 'Total samples location') }}
            {{ Form::bsText('lead[chem_rock]', 'Total rocks sample') }}
            {{ Form::bsText('lead[chem_fluid]', 'Total fluid sample') }}
            {{ Form::bsText('lead[chem_composition]', 'Hydrocarbon composition') }}
          </div>
        </div> {{-- Geochemistry --}}

        <div id="grav-panel" class="panel panel-default hidden">
          <div class="panel-heading">
            <div class="panel-title">
              Gravity
            </div>
          </div>
          <div class="panel-body">
            {{ Form::bsNumber('lead[grav_low]', 'Low estimate', false, 'Acre') }}
            {{ Form::bsNumber('lead[grav_best]', 'Best estimate', true, 'Acre') }}
            {{ Form::bsNumber('lead[grav_high]', 'High estimate', false, 'Acre') }}
            {{ Form::bsText('lead[grav_year]', 'Acquisition year') }}
            {{
              Form::bsSelect('lead[grav_method]', 'Survey method', [
                'Airbones' => 'Airbones',
                'Surface' => 'Surface',
                'Other' => 'Other'
              ])
            }}
            {{ Form::bsNumber('lead[grav_coverage]', 'Total coverage area', false, 'Acre') }}
            {{ Form::bsNumber('lead[grav_penetrate]', 'Depth penetrate range', false, 'Feet') }}
            {{ Form::bsNumber('lead[grav_recorder]', 'Recorder spacing interval', false, 'Feet') }}
          </div>
        </div> {{-- Gravity --}}

        <div id="elec-panel" class="panel panel-default hidden">
          <div class="panel-heading">
            <div class="panel-title">
              Electromagnetic
            </div>
          </div>
          <div class="panel-body">
            {{ Form::bsNumber('lead[elec_low]', 'Low estimate', false, 'Acre') }}
            {{ Form::bsNumber('lead[elec_best]', 'Best estimate', true, 'Acre') }}
            {{ Form::bsNumber('lead[elec_high]', 'High estimate', false, 'Acre') }}
            {{ Form::bsText('lead[elec_year]', 'Acquisition year') }}
            {{
              Form::bsSelect('lead[elec_method]', 'Survey method', [
                'Airbones' => 'Airbones',
                'Surface' => 'Surface',
                'Other' => 'Other'
              ])
            }}
            {{ Form::bsNumber('lead[elec_coverage]', 'Total coverage area', false, 'Acre') }}
            {{ Form::bsNumber('lead[elec_penetrate]', 'Depth penetrate range', false, 'Feet') }}
            {{ Form::bsNumber('lead[elec_recorder]', 'Recorder spacing interval', false, 'Feet') }}
          </div>
        </div> {{-- Electromagnetic --}}

        <div id="resi-panel" class="panel panel-default hidden">
          <div class="panel-heading">
            <div class="panel-title">
              Resistivity
            </div>
          </div>
          <div class="panel-body">
            {{ Form::bsNumber('lead[resi_low]', 'Low estimate', false, 'Acre') }}
            {{ Form::bsNumber('lead[resi_best]', 'Best estimate', true, 'Acre') }}
            {{ Form::bsNumber('lead[resi_high]', 'High estimate', false, 'Acre') }}
            {{ Form::bsText('lead[resi_year]', 'Acquisition year') }}
            {{
              Form::bsSelect('lead[resi_method]', 'Survey method', [
                'Airbones' => 'Airbones',
                'Surface' => 'Surface',
                'Other' => 'Other'
              ])
            }}
            {{ Form::bsNumber('lead[resi_coverage]', 'Total coverage area', false, 'Acre') }}
            {{ Form::bsNumber('lead[resi_penetrate]', 'Depth penetrate range', false, 'Feet') }}
            {{ Form::bsNumber('lead[resi_recorder]', 'Recorder spacing interval', false, 'Feet') }}
          </div>
        </div> {{-- Resistivity --}}

        <div id="oter-panel" class="panel panel-default hidden">
          <div class="panel-heading">
            <div class="panel-title">
              Other
            </div>
          </div>
          <div class="panel-body">
            {{ Form::bsNumber('lead[oter_low]', 'Low estimate', false, 'Acre') }}
            {{ Form::bsNumber('lead[oter_best]', 'Best estimate', true, 'Acre') }}
            {{ Form::bsNumber('lead[oter_high]', 'High estimate', false, 'Acre') }}
            {{ Form::bsText('lead[oter_year]', 'Acquisition year') }}
            {{ Form::remark('lead[oter_remark]', true) }}
          </div>
        </div> {{-- Other --}}

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
  <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
@endpush

@push('jsready')
  $("select[name='lead[play_id]']").on("change", function() {
    $.ajax({
      header: { csrftoken: "{{ csrf_token() }}"},
      url: "gcf",
      data: {
        _token: "{{ csrf_token() }}",
        playId: $("select[name='lead[play_id]']").val(),
      },
      type: "post",
      dataType: "json",
      success: function(data) {
        updateGcf(data);
      },
      error: function(xhr, status, errorThrown) {
        alert('Sorry, there is some problem in our end');
      }
    });
  });
@endpush