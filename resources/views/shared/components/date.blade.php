@if ($errors->has(squareToDot($name)))
<div class="form-group has-feedback has-error">
@else
<div class="form-group">
@endif

  @if ($required)
  <label for="{{ $name }}" class="col-md-3 control-label required">
  @else
  <label for="{{ $name }}" class="col-md-3 control-label">
  @endif
    {{ $label }}
  </label>

  @if ($errors->has(squareToDot($name.'_day')))
  <div class="col-md-1 has-feedback has-error">
  @else
  <div class="col-md-1">
  @endif

    {{ Form::selectRange($name.'_day', 1, 31, null, ['class' => 'form-control']) }}

    @if ($errors->has(squareToDot($name.'_day')))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'_day' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name.'_day')) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name.'_month')))
  <div class="col-md-1 has-feedback has-error">
  @else
  <div class="col-md-1">
  @endif

    {{ Form::selectRange($name.'_month', 1, 12, null, ['class' => 'form-control']) }}

    @if ($errors->has(squareToDot($name.'_month')))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'_month' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name.'_month')) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name.'_year')))
  <div class="col-md-2 has-feedback has-error">
  @else
  <div class="col-md-2">
  @endif

    {{ Form::selectRange($name.'_year', 1900, date('Y'), null, ['class' => 'form-control']) }}

    @if ($errors->has(squareToDot($name.'_year')))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name.'_year' }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name.'_year')) }}</p>
    @endif
  </div>
</div>