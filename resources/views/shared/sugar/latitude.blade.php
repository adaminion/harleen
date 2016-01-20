<?php
  $degree = addToSquare($name, null, '_degree');
  $minute = addToSquare($name, null, '_minute');
  $second = addToSquare($name, null, '_second');
  $cardinal = addToSquare($name, null, '_cardinal');
?>

@if ($errors->has(squareToDot($degree))
  || $errors->has(squareToDot($minute))
  || $errors->has(squareToDot($second))
  || $errors->has(squareToDot($cardinal)))
  <div class="form-group has-feedback has-error">
@else
  <div class="form-group">
@endif

  @if ($required)
    <label for="{{ $name }}" class="col-md-3 control-label required">
  @else
    <label for="{{ $name }}" class="col-md-3 control-label">
  @endif
    Center latitude
  </label>

  @if ($errors->has(squareToDot($degree)))
    <div class="col-md-2 has-feedback has-error">
  @else
    <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($degree, null, ['class' => 'form-control', 'placeholder' => 'degree']) }}
      <div class="input-group-addon">&deg;</div>
    </div>

    @if ($errors->has(squareToDot($degree)))
      <span class="form-control-feedback glyphicon glyphicon-remove"
            style="right: -15px;"></span>
      <span id="{{ $degree }}" class="sr-only">(error)</span>
      <p class="help-block">{{ $errors->first(squareToDot($degree)) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($minute)))
    <div class="col-md-2 has-feedback has-error">
  @else
    <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($minute, null, ['class' => 'form-control', 'placeholder' => 'minute']) }}
      <div class="input-group-addon">'</div>
    </div>

    @if ($errors->has(squareToDot($minute)))
      <span class="form-control-feedback glyphicon glyphicon-remove"
            style="right: -15px;"></span>
      <span id="{{ $minute }}" class="sr-only">(error)</span>
      <p class="help-block">{{ $errors->first(squareToDot($minute)) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($second)))
    <div class="col-md-2 has-feedback has-error">
  @else
    <div class="col-md-2">
  @endif

    <div class="input-group">
      {{ Form::text($second, null, ['class' => 'form-control', 'placeholder' => 'second']) }}
      <div class="input-group-addon">"</div>
    </div>

    @if ($errors->has(squareToDot($second)))
      <span class="form-control-feedback glyphicon glyphicon-remove"
            style="right: -15px;"></span>
      <span id="{{ $second }}" class="sr-only">(error)</span>
      <p class="help-block">{{ $errors->first(squareToDot($second)) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($cardinal)))
    <div class="col-md-2 has-feedback has-error">
  @else
    <div class="col-md-2">
  @endif

    {{ Form::text($cardinal, null, ['class' => 'form-control', 'placeholder' => 'S/N']) }}

    @if ($errors->has(squareToDot($cardinal)))
      <span class="form-control-feedback glyphicon glyphicon-remove"
            style="right: -15px;"></span>
      <span id="{{ $cardinal }}" class="sr-only">(error)</span>
      <p class="help-block">{{ $errors->first(squareToDot($cardinal)) }}</p>
    @endif
  </div>
</div>