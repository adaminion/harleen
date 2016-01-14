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

  <div class="col-md-{{ $inputCol }}">

    @if ($unit)
    <div class="input-group">
    @endif

      {{ Form::number($name, null, ['class' => 'form-control', 'min' => '0']) }}

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
    <p class="help-block">{{ $errors->first(squareToDot($name)) }}</p>
    @endif
  </div>
</div>