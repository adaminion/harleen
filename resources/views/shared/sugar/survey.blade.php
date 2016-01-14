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
    <?php
      $checkbox = extractSquare($key, '-check', '_data');
      $panel = extractSquare($key, '-panel', '_data');
    ?>
    <div class="checkbox">
      <label>
        {{ Form::checkbox($key, 'checked', false, ['id' => $checkbox]) }} {{ $value }}
      </label>
    </div>

    {{--
      Survey toggle, pada form isian haruslah ada sub-form (dalam panel) dengan
      korespondensi dengan masing-masing survey yang disediakan, dan pastikan
      id dari sub-form tersebut sesuai dengan script di bawah dan ditambah
      class 'hidden' pada panel.

      Untuk diingat bahwa panel pertama kali haruslah mempunyai class `hidden`
      menjadikan untuk mengolah panel tersebut mengasumsikan panel tidak ada.
    --}}
    @push('jsready')
      if ($("#{{ $checkbox }}").is(":checked") && $("#{{ $panel }}").hasClass("hidden")) {
        $("#{{ $panel }}").removeClass("hidden");
      }

      $("#{{ $checkbox }}").click(function() {
        $("#{{ $panel }}").toggleClass('hidden');
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