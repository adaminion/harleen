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

    {{ Form::text($name, null, ['class' => 'form-control']) }}

    @if ($errors->has(squareToDot($name)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          style="right: -15px;"></span>
    <span id="{{ $name }}" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDo($name)) }}</p>
    @endif
  </div>
  <div class="col-md-3">
    <p class="form-control-static">
      @if ($type === 'lat')
        example: 20&deg; 59' 59" S or N
      @elseif ($type === 'long')
        example: 090&deg; 59' 59" E
      @endif
    </p>
  </div>
</div>

{{-- Require jQuery.input mask --}}
@push('jsready')
  @if ($type === 'lat')
    $("input[name='{{ $name }}']").inputmask("L\u00b0 s\u2019 s\u201D C", {
      definitions: {
        "L": {
          validator: function(chrs, buffer, pos, strict, opts) {
            console.log(chrs);
          },
          cardinality: 1,
        },
        "C": {
          validator: "[sSnN]",
          cardinality: 1,
          casing: "upper"
        },
      }
    });
  @elseif ($type === 'long')
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
  @endif
@endpush