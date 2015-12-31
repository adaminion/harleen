<div class="form-group">
  @if ($required)
  <label for="{{ $name }}" class="col-md-2 control-label required">
  @else
  <label for="{{ $name }}" class="col-md-2 control-label">
  @endif
    {{ $label }}
  </label>

  @if ($errors->has($name))
  <div class="col-md-3 has-feedback has-error">
  @else
  <div class="col-md-3">
  @endif
    <div class="input-group">
      {{ Form::text($name, null, ['class' => 'form-control'])}}

      @if ($unit)
      <div class="input-group-addon">{{ $unit }}</div>
      @endif

    </div>
    @if ($errors->has($name))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first($name) }}</p>
    @endif
  </div>
</div>