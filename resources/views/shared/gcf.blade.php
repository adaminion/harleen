<?php
  $formation = App\Formation::all()->lists('formation_name', 'formation_name');

  $formationLevel = [
    'Lower' => 'Lower',
    'Middle' => 'Middle',
    'Upper' => 'Upper'
  ];

  $age = [
    'Holocene' => 'Holocene',
    'Pleistocene' => 'Pleistocene',
    'Miocene' => 'Miocene',
    'Oligocene' => 'Oligocene',
    'Eocene' => 'Eocene',
    'Paleocene' => 'Paleocene',
    'Cretaceous' => 'Cretaceous',
    'Jurassic' => 'Jurassic',
    'Triassic' => 'Triassic',
    'Permian' => 'Permian',
    'Pliocene' => 'Pliocene',
    'Carboniferous' => 'Carboniferous',
    'Devonian' => 'Devonian',
    'Ordovician' => 'Ordovician',
    'Cambrian' => 'Cambrian'
  ];

  $ageEpoch = [
    'Early' => 'Early',
    'Middle' => 'Middle',
    'Late' => 'Late'
  ];

  if (controllerName() === 'Play') {
    $requiredReservoir = true;
  } else {
    $requiredReservoir = false;
  }
?>
{{ controllerName()}}
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
            'Analog' => 'Analog'
          ], true)
        }}

        {{
          Form::twoSelect('Source formation',
            'src_formation', $formation, false, false,
            'src_formation_level', $formationLevel, false, false)
        }}

        {{
          Form::twoSelect('Source age',
            'src_age_period', $age, false, false,
            'src_age_epoch', $ageEpoch, false, false)
        }}

        {{
          Form::bsSelect('src_kerogen', 'Kerogen type',
            App\Quinzel\Gcf\SourceRock::factorOptions('kerogen'))
        }}

        {{
          Form::bsSelect('src_toc', 'Capacity (TOC)',
            App\Quinzel\Gcf\SourceRock::factorOptions('toc'))
        }}

        {{
          Form::bsSelect('src_hfu', 'Heatflow unit',
            App\Quinzel\Gcf\SourceRock::factorOptions('hfu'))
        }}

        {{
          Form::bsSelect('src_distribution', 'Distribution',
            App\Quinzel\Gcf\SourceRock::factorOptions('distribution'))
        }}

        {{
          Form::bsSelect('src_continuity', 'Continuity',
            App\Quinzel\Gcf\SourceRock::factorOptions('continuity'))
        }}

        {{
          Form::bsSelect('src_maturity', 'Maturity',
            App\Quinzel\Gcf\SourceRock::factorOptions('maturity'))
        }}

        {{
          Form::bsSelect('src_other', 'Other source rock', [
            'Yes' => 'Yes',
            'No' => 'No'
          ])
        }}
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          Reservoir
        </div>
      </div>
      <div class="panel-body">
        {{
          Form::bsSelect('res_data', 'Proven or analog', [
            'Proven' => 'Proven',
            'Analog' => 'Analog'
          ], true)
        }}

        {{
          Form::bsSelect('res_litho', 'Lithology',
            App\Quinzel\Gcf\Reservoir::factorOptions('lithology'), $requiredReservoir)
        }}

        {{
          Form::twoSelect('Reservoir formation',
            'res_formation', $formation, $requiredReservoir, false,
            'res_formation_level', $formationLevel, false, false)
        }}

        {{
          Form::twoSelect('Reservoir age',
            'res_age_period', $age, $requiredReservoir, false,
            'res_age_epoch', $ageEpoch, true, false)
        }}

        {{
          Form::bsSelect('res_dep_env', 'Depositional environment',
            App\Quinzel\Gcf\Reservoir::factorOptions('environment'), $requiredReservoir)
        }}

        {{
          Form::bsSelect('res_dep_set', 'Depositional setting',
            App\Quinzel\Gcf\Reservoir::factorOptions('setting'))
        }}

        {{
          Form::bsSelect('res_distribution', 'Reservoir distribution',
            App\Quinzel\Gcf\Reservoir::factorOptions('distribution'))
        }}

        {{
          Form::bsSelect('res_continuity', 'Reservoir continuity',
            App\Quinzel\Gcf\Reservoir::factorOptions('continuity'))
        }}

        {{
          Form::bsSelect('res_primary', 'Average primary porosity',
            App\Quinzel\Gcf\Reservoir::factorOptions('primary'), false, '%')
        }}

        {{
          Form::bsSelect('res_second', 'Secondary porosity',
            App\Quinzel\Gcf\Reservoir::factorOptions('secondary'))
        }}
      </div>
    </div>

  </div>
</div>