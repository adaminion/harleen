<div class="panel panel-primary">
  <div class="panel-heading">
    <div class="panel-title">
      General Data
    </div>
  </div>

  <div class="panel-body">
    {{ Form::text('play[basin_name]') }}
    {{ Form::text('gcf[src_data]')}}
  </div>
</div>

@include('shared.gcf')