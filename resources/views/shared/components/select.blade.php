<div class="form-group">
  @if ($required)
  <label for="{{ $name }}" class="col-md-3 control-label required">
  @else
  <label for="{{ $name }}" class="col-md-3 control-label">
  @endif
    {{ $label }}
  </label>

  @if ($errors->has($name))
  <div class="col-md-4 has-feedback has-error">
  @else
  <div class="col-md-4">
  @endif
    <div class="input-group">
      {{
        Form::select($name, $choice, null,
          ['class' => 'form-control', 'placeholder' => '- Choose -'])
      }}

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