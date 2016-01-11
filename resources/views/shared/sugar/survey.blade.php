<div class="form-group">
  <label for="{{ $name }}" class="col-md-3 control-label required">
    Data availability
  </label>

  @if ($errors->has(squareToDot($name)))
    <div class="col-md-4 has-feedback has-error">
  @else
    <div class="col-md-4">
  @endif

  @foreach ($choice as $key => $value)
    <div class="checkbox">
      <label>
        {{ Form::checkbox($name.'[]', $key) }} {{ $value }}
      </label>
    </div>
  @endforeach

  @if ($errors->has(squareToDot($name)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          aria-hidden="true" style="right: -15px;"></span>
    <span id="{{ $name }}Status" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDot($name)) }}</p>
  @endif
  </div>
</div>