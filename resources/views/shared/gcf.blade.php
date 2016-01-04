<div class="panel panel-primary">
  <div class="panel-heading">
    <div class="panel-title">
      Geological Chance Factor
    </div>
  </div>
  <div class="panel-body">

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          Source Rock
        </div>
      </div>
      <div class="panel-body">
        {{
          Form::bsSelect('src_data', 'Proven or analog', [
            'Proven' => 'Proven',
            'Analog' => 'Analog'])
        }}

        {{
          Form::bsSelect('src_formation', 'Source formation',
            App\Formation::all()->lists('formation_name', 'formation_name'))
        }}
        
        {{
          Form::bsSelect('src_formation_level', 'Proven or analog', [
            'Proven' => 'Proven',
            'Analog' => 'Analog'])
        }}
      </div>
    </div>

  </div>
</div>