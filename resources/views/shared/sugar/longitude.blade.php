<div class="form-group">
  @if ($required)
  <label for="{{ $name }}" class="col-md-3 control-label required">
  @else
  <label for="{{ $name }}" class="col-md-3 control-label">
  @endif
    Center longitude
  </label>

  @if ($errors->has(squareToDot($name.'_degree')))
  <div class="col-md-2 has-feedback has-error">
  @else
  <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($name.'_degree', null, ['class' => 'form-control', 'placeholder' => 'degree']) }}
      <div class="input-group-addon">&deg;</div>
    </div>

    @if ($errors->has(squareToDot($name.'_degree')))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'_degree' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name.'_degree')) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name.'_minute')))
  <div class="col-md-2 has-feedback has-error">
  @else
  <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($name.'_minute', null, ['class' => 'form-control', 'placeholder' => 'minute']) }}
      <div class="input-group-addon">'</div>
    </div>

    @if ($errors->has(squareToDot($name.'_minute')))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'_minute' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name.'_minute')) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name.'_second')))
  <div class="col-md-2 has-feedback has-error">
  @else
  <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($name.'_second', null, ['class' => 'form-control', 'placeholder' => 'second']) }}
      <div class="input-group-addon">"</div>
    </div>

    @if ($errors->has(squareToDot($name.'_second')))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'_second' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name.'_second')) }}</p>
    @endif
  </div>

  <div class="col-md-1">
    <p class="form-control-static">E</p>
  </div>
</div>