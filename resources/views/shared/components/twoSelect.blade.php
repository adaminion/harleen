@if ($errors->has(squareToDot($nameA)))
<div class="form-group has-feedback has-error">
@else
<div class="form-group">
@endif

  @if ($requiredA)
  <label for="{{ $nameA }}" class="col-md-3 control-label required">
  @else
  <label for="{{ $nameA }}" class="col-md-3 control-label">
  @endif
    {{ $label }}
  </label>

  <div class="col-md-4">

    @if ($unitA)
    <div class="input-group">
    @endif

      {{
        Form::select($nameA, $choiceA, null, [
          'class' => 'form-control',
          'placeholder' => '- Choose -',
          'aria-describedby' => $nameA.'Status'
        ])
      }}

      @if ($unitA)
      <div class="input-group-addon">{!! $unitA !!}</div>
      @endif

    @if ($unitA)
    </div>
    @endif

    @if ($errors->has(squareToDot($nameA)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          aria-hidden="true" style="right: -15px;"></span>
    <span id="{{ $nameA }}Status" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDot($nameA)) }}</p>
    @endif
  </div>

  <div class="col-md-3">

    @if ($unitB)
    <div class="input-group">
    @endif

      {{
        Form::select($nameB, $choiceB, null, [
          'class' => 'form-control',
          'placeholder' => '- Choose -',
          'aria-describedby' => $nameB.'Status'
        ])
      }}

      @if ($unitB)
      <div class="input-group-addon">{!! $unitB !!}</div>
      @endif

    @if ($unitB)
    </div>
    @endif

    @if ($errors->has(squareToDot($nameB)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          aria-hidden="true" style="right: -15px;"></span>
    <span id="{{ $nameB }}Status" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDot($nameB)) }}</p>
    @endif
  </div>
</div>