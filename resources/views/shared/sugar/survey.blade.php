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
        {{ Form::checkbox($name.'[]', $key, false, ['id' => $name.'-'.$key]) }} {{ $value }}
      </label>
    </div>

    {{--
      Survey toggle, pada form isian haruslah ada sub-form (dalam panel) dengan
      korespondensi dengan masing-masing survey yang disediakan, dan pastikan
      id dari sub-form tersebut sesuai dengan script di bawah dan ditambah
      class 'hidden' pada panel.
    --}}
    @push('jsready')
      $("#{{ $name }}-{{ $key }}").click(function() {
        $("#{{ $name }}-{{ $key }}-panel").toggleClass('hidden');
      });
    @endpush
  @endforeach

  @if ($errors->has(squareToDot($name)))
    <span class="form-control-feedback glyphicon glyphicon-remove"
          aria-hidden="true" style="right: -15px;"></span>
    <span id="{{ $name }}Status" class="sr-only">(error)</span>
    <p class="help-block">{{ $errors->first(squareToDot($name)) }}</p>
  @endif
  </div>
</div>