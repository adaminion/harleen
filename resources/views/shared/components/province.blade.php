{{
  Form::bsSelect('province_name', 'Province',
    App\Province::all()->lists('province_name', 'province_name'), true)
}}