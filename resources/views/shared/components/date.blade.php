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

  @if ($errors->has(squareToDot($name.'[day]')))
    <div class="col-md-1 has-feedback has-error">
  @else
    <div class="col-md-1">
  @endif

    {{
      Form::selectRange($name.'[day]', 1, 31, null,
        ['class' => 'form-control'])
    }}

    @if ($errors->has(squareToDot($name.'[day]')))
      <span class="form-control-feedback glyphicon glyphicon-remove"
            style="right: -15px;"></span>
      <span id="{{ $name.'[day]' }}" class="sr-only">(error)</span>
      <p class="help-block">{{ $errors->first(squareToDo($name.'[day]')) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name.'[month]')))
    <div class="col-md-1 has-feedback has-error">
  @else
    <div class="col-md-1">
  @endif

    {{
      Form::selectRange($name.'[month]', 1, 12, null,
        ['class' => 'form-control'])
    }}

    @if ($errors->has(squareToDot($name.'[month]')))
      <span class="form-control-feedback glyphicon glyphicon-remove"
            style="right: -15px;"></span>
      <span id="{{ $name.'[month]' }}" class="sr-only">(error)</span>
      <p class="help-block">{{ $errors->first(squareToDo($name.'[month]')) }}</p>
    @endif
  </div>

  @if ($errors->has(squareToDot($name.'[year]')))
    <div class="col-md-2 has-feedback has-error">
  @else
    <div class="col-md-2">
  @endif

    {{
      Form::selectRange($name.'[year]', 1900, date('Y'), null,
        ['class' => 'form-control'])
    }}

    @if ($errors->has(squareToDot($name.'[year]')))
      <span class="form-control-feedback glyphicon glyphicon-remove"
            style="right: -15px;"></span>
      <span id="{{ $name.'_year' }}" class="sr-only">(error)</span>
      <p class="help-block">{{ $errors->first(squareToDo($name.'[year]')) }}</p>
    @endif
  </div>
</div>