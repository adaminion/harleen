<div class="form-group">
  @if ($required)
  <label for="{{ $name }}" class="col-md-3 control-label required">
  @else
  <label for="{{ $name }}" class="col-md-3 control-label">
  @endif
    Center longitude
  </label>

  @if ($errors->has(squareToDot($name).'.degree'))
  <div class="col-md-2 has-feedback has-error">
  @else
  <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($name.'[degree]', null, ['class' => 'form-control', 'placeholder' => 'degree']) }}
      <div class="input-group-addon">&deg;</div>
    </div>

    @if ($errors->has(squareToDot($name).'.degree'))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'[degree]' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name).'.degree') }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name).'.minute'))
  <div class="col-md-2 has-feedback has-error">
  @else
  <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($name.'[minute]', null, ['class' => 'form-control', 'placeholder' => 'minute']) }}
      <div class="input-group-addon">'</div>
    </div>

    @if ($errors->has(squareToDot($name).'.minute'))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'[minute]' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name).'.minute') }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name).'.second'))
  <div class="col-md-2 has-feedback has-error">
  @else
  <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($name.'[second]', null, ['class' => 'form-control', 'placeholder' => 'second']) }}
      <div class="input-group-addon">"</div>
    </div>

    @if ($errors->has(squareToDot($name).'.second'))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'[second]' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name).'.second') }}</p>
    @endif
  </div>

  <div class="col-md-1">
    <p class="form-control-static">E</p>
  </div>
</div>