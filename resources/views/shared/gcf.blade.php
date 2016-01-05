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
          Form::bsSelect('gcf[src_data]', 'Proven or analog', [
            'Proven' => 'Proven',
            'Analog' => 'Analog'
          ], true)
        }}

        {{
          Form::twoSelect('Source formation',
            'gcf[src_formation]', $formation, false, false,
            'gcf[src_formation_level]', $formationLevel)
        }}

        {{
          Form::twoSelect('Source age',
            'gcf[src_age_period]', $age, false, false,
            'gcf[src_age_epoch]', $ageEpoch)
        }}

        {{
          Form::bsSelect('gcf[src_kerogen]', 'Kerogen type',
            App\Quinzel\Gcf\SourceRock::factorOptions('kerogen'))
        }}

        {{
          Form::bsSelect('gcf[src_capacity]', 'Capacity (TOC)',
            App\Quinzel\Gcf\SourceRock::factorOptions('toc'))
        }}

        {{
          Form::bsSelect('gcf[src_heatflow]', 'Heatflow unit',
            App\Quinzel\Gcf\SourceRock::factorOptions('hfu'))
        }}

        {{
          Form::bsSelect('gcf[src_distribution]', 'Distribution',
            App\Quinzel\Gcf\SourceRock::factorOptions('distribution'))
        }}

        {{
          Form::bsSelect('gcf[src_continuity]', 'Continuity',
            App\Quinzel\Gcf\SourceRock::factorOptions('continuity'))
        }}

        {{
          Form::bsSelect('gcf[src_maturity]', 'Maturity',
            App\Quinzel\Gcf\SourceRock::factorOptions('maturity'))
        }}

        {{
          Form::bsSelect('gcf[src_other]', 'Other source rock', [
            'Yes' => 'Yes',
            'No' => 'No'
          ])
        }}
      </div>
    </div> {{-- Source Rock --}}

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          Reservoir
        </div>
      </div>
      <div class="panel-body">
        {{
          Form::bsSelect('gcf[res_data]', 'Proven or analog', [
            'Proven' => 'Proven',
            'Analog' => 'Analog'
          ], true)
        }}

        {{
          Form::bsSelect('gcf[res_litho]', 'Lithology',
            App\Quinzel\Gcf\Reservoir::factorOptions('lithology'), $requiredReservoir)
        }}

        {{
          Form::twoSelect('Reservoir formation',
            'gcf[res_formation]', $formation, $requiredReservoir, false,
            'gcf[res_formation_level]', $formationLevel)
        }}

        {{
          Form::twoSelect('Reservoir age',
            'gcf[res_age_period]', $age, $requiredReservoir, false,
            'gcf[res_age_epoch]', $ageEpoch, true, false)
        }}

        {{
          Form::bsSelect('gcf[res_dep_env]', 'Depositional environment',
            App\Quinzel\Gcf\Reservoir::factorOptions('environment'), $requiredReservoir)
        }}

        {{
          Form::bsSelect('gcf[res_dep_set]', 'Depositional setting',
            App\Quinzel\Gcf\Reservoir::factorOptions('setting'))
        }}

        {{
          Form::bsSelect('gcf[res_distribution]', 'Reservoir distribution',
            App\Quinzel\Gcf\Reservoir::factorOptions('distribution'))
        }}

        {{
          Form::bsSelect('gcf[res_continuity]', 'Reservoir continuity',
            App\Quinzel\Gcf\Reservoir::factorOptions('continuity'))
        }}

        {{
          Form::bsSelect('gcf[res_primary]', 'Average primary porosity',
            App\Quinzel\Gcf\Reservoir::factorOptions('primary'), false, '%')
        }}

        {{
          Form::bsSelect('gcf[res_second]', 'Secondary porosity',
            App\Quinzel\Gcf\Reservoir::factorOptions('secondary'))
        }}
      </div>
    </div> {{-- Reservoir --}}

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          Trap
        </div>
      </div>
      <div class="panel-body">
        {{
          Form::bsSelect('gcf[trp_data]', 'Proven or analog', [
            'Proven' => 'Proven',
            'Analog' => 'Analog'
          ], true)
        }}

        {{
          Form::bsSelect('gcf[trp_type]', 'Trapping type',
            App\Quinzel\Gcf\Trap::factorOptions('trapType'), true)
        }}

        {{
          Form::twoSelect('Trapping age',
            'gcf[trp_age_period]', $age, false, false,
            'gcf[trp_age_epoch]', $ageEpoch)
        }}

        {{
          Form::bsSelect('gcf[trp_geometry]', 'Trapping geometry',
            App\Quinzel\Gcf\Trap::factorOptions('geometry'))
        }}

        {{
          Form::bsSelect('gcf[trp_seal_type]', 'Sealing type',
            App\Quinzel\Gcf\Trap::factorOptions('sealType'))
        }}

        {{
          Form::bsSelect('gcf[trp_seal_distribution]', 'Sealing distribution',
            App\Quinzel\Gcf\Trap::factorOptions('distribution'))
        }}

        {{
          Form::bsSelect('gcf[trp_seal_continuity]', 'Sealing continuity',
            App\Quinzel\Gcf\Trap::factorOptions('continuity'))
        }}

        {{
          Form::twoSelect('Sealing age',
            'gcf[trp_seal_age_period]', $age, false, false,
            'gcf[trp_seal_age_epoch]', $ageEpoch)
        }}

        {{
          Form::twoSelect('Sealing formation',
            'gcf[trp_seal_formation]', $formation, false, false,
            'gcf[trp_seal_formation_level]', $formationLevel)
        }}

        {{
          Form::bsSelect('gcf[trp_closure]', 'Closure type',
            App\Quinzel\Gcf\Trap::factorOptions('closure'))
        }}
      </div>
    </div> {{-- Trap --}}

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          Dynamic
        </div>
      </div>
      <div class="panel-body">
        {{
          Form::bsSelect('gcf[dyn_data]', 'Proven or analog', [
            'Proven' => 'Proven',
            'Analog' => 'Analog'
          ], true)
        }}

        {{
          Form::bsSelect('gcf[dyn_authenticate]', 'Authenticate migration',
            App\Quinzel\Gcf\Dynamic::factorOptions('migration'))
        }}

        {{
          Form::bsSelect('gcf[dyn_kitchen]', 'Trap position due to kitchen',
            App\Quinzel\Gcf\Dynamic::factorOptions('kitchen'))
        }}

        {{
          Form::bsSelect('gcf[dyn_tectonic]', 'Tectonic order',
            App\Quinzel\Gcf\Dynamic::factorOptions('tectonic'))
        }}

        {{
          Form::twoSelect('Tectonic regime (earliest)',
            'gcf[dyn_regime_early_period]', $age, false, false,
            'gcf[dyn_regime_early_epoch]', $ageEpoch)
        }}

        {{
          Form::twoSelect('Tectonic regime (latest)',
            'gcf[dyn_regime_late_period]', $age, false, false,
            'gcf[dyn_regime_late_epoch]', $ageEpoch)
        }}

        {{
          Form::bsSelect('gcf[dyn_preservation]', 'Segregation post entrapment',
            App\Quinzel\Gcf\Dynamic::factorOptions('preservation'))
        }}

        {{
          Form::bsSelect('gcf[dyn_pathway]', 'Migration pathway',
            App\Quinzel\Gcf\Dynamic::factorOptions('pathway'))
        }}

        {{
          Form::twoSelect('Estimate migration age',
            'gcf[dyn_age_period]', $age, false, false,
            'gcf[dyn_age_epoch]', $ageEpoch)
        }}
      </div>
    </div> {{-- Dynamic --}}

  </div>
</div>