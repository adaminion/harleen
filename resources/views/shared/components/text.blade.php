<div class="form-group">
  @if ($required)
  <label for="{{ $name }}" class="col-md-3 control-label required">
  @else
  <label for="{{ $name }}" class="col-md-3 control-label">
  @endif
    {{ $label }}
  </label>

  @if ($errors->has(squareToDot($name)))
  <div class="col-md-{{ $inputCol }} has-feedback has-error">
  @else
  <div class="col-md-{{ $inputCol }}">
  @endif

    @if ($unit)
    <div class="input-group">
    @endif

      {{ Form::text($name, null, ['class' => 'form-control'])}}

      @if ($unit)
      <div class="input-group-addon">{!! $unit !!}</div>
      @endif

    @if ($unit)
    </div>
    @endif

    @if ($errors->has(squareToDot($name)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name)) }}</p>
    @endif
  </div>
</div>