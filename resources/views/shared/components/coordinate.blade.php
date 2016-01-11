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

    {{ Form::text($name, null, ['class' => 'form-control'])}}

    @if ($errors->has(squareToDot($name)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name)) }}</p>
    @endif
  </div>
  <div class="col-md-3">
      <p class="form-control-static">
        @if ($name === 'latitude')
          example: 20&deg; 59' 59" S or N
        @else
          example: 090&deg; 59' 59" E
        @endif
      </p>
  </div>
</div>

@if ($name === 'latitude')
  @push('jsready')
    $("input[name='{{ $name }}']").inputmask("L\u00b0 s\u2019 s\u201D C", {
      definitions: {
        "L": {
          validator: "[0-1][0-9]|[2][0]",
          cardinality: 2,
        },
        "C": {
          validator: "[sSnN]",
          cardinality: 1,
          casing: "upper"
        },
      }
    });
  @endpush
@endif

@if ($name === 'longitude')
  @push('jsready')
    $("input[name='{{ $name }}']").inputmask("L\u00b0 s\u2019 s\u201D C", {
      definitions: {
        "L": {
          validator: "[0-9][0-9][0-9]",
          cardinality: 3,
        },
        "C": {
          validator: "[E]",
          placeholder: "E",
          cardinality: 1,
          casing: "upper"
        },
      }
    });
  @endpush
@endif