<div class="form-group">
  @if ($required)
  <label for="{{ $name }}" class="col-md-3 control-label required">
  @else
  <label for="{{ $name }}" class="col-md-3 control-label">
  @endif
    {{ $label }}
  </label>

  @if ($errors->has(squareToDot($name)))
  <div class="col-md-4 has-feedback has-error">
  @else
  <div class="col-md-4">
  @endif

    @if ($unit)
    <div class="input-group">
    @endif

      {{
        Form::select($name, $choice, null, [
          'class' => 'form-control',
          'placeholder' => '- Choose -',
          'aria-describedby' => $name.'Status'
        ])
      }}

      @if ($unit)
      <div class="input-group-addon">{{ $unit }}</div>
      @endif

    @if ($unit)
    </div>
    @endif

    @if ($errors->has(squareToDot($name)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          aria-hidden="true" style="right: -15px;"></span>
    <span id="{{ $name }}Status" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDot($name)) }}</p>
    @endif
  </div>
</div>