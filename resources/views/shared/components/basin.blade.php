{{
  Form::bsSelect('basin_name', 'Basin',
    App\Basin::all()->lists('basin_name', 'basin_name'), true)
}}