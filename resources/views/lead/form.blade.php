@extends('layouts.master')

@section('content')
  <div class="container">
    <div class="text-center page-title">
      <h1>Create New Lead</h1>
    </div>

    {{
      Form::model(['play' => $play, 'lead' => $lead, 'gcf' => $gcf],
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
        {{ Form::bsText('lead[structure_name]', 'Structure name') }}
        {{ Form::bsText('lead[closure_name]', 'Closure name') }}
        {{ Form::coord('latitude', 'Center latitude') }}
        {{ Form::coord('longitude', 'Center longitude') }}
        {{ Form::analogTo('lead[analog_to]') }}
        {{ Form::analogDistance('lead[analog_distance]') }}
        {{ Form::shore('lead[shore]') }}
        {{ Form::terrain('lead[terrain]') }}
        {{ Form::nearbyField('lead[nearby_field]') }}
        {{ Form::nearbyInfra('lead[nearby_infra]') }}
        {{ Form::remark('lead[remark]') }}

        @if (actionName() === 'edit')
          {{ Form::bsTextarea('lead[update_reason]', 'Update reason', true) }}
        @endif
      </div>
    </div>

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