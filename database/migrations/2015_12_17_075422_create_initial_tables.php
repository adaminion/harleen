<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_area', function (Blueprint $table) {
            $table->string('id', 15);
            $table->primary('id');
            $table->unique('id');

            $table->char('rps_year', 4);
            $table->string('working_area_name', 100);
            $table->string('shore', 100)->nullable();
            $table->float('area_original')->nullable();
            $table->string('stage_original', 100)->nullable();
            $table->date('sign_date')->nullable();
            $table->date('end_date')->nullable();
        });

        // PSC tables.
        Schema::create('contractor', function (Blueprint $table) {
            $table->increments('id');

            $table->string('contractor_name', 100);
            $table->string('business_entity', 50)->nullable();
            $table->string('holding', 100)->nullable();
        });

        Schema::create('contractor_working_area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
            $table->unsignedInteger('contractor_id');
            $table->foreign('contractor_id')->references('id')->on('contractor');

            $table->char('rps_year', 4);
            $table->float('area_current');
            $table->string('stage_current');
            $table->float('interest')->nullable();
            $table->boolean('is_operator')->default(false);
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15)->nullable();
            $table->foreign('working_area_id')->references('id')->on('working_area');

            $table->string('username', 100);
            $table->string('password', 60);

            // Ukuran 60 sepertinya kurang.
            $table->string('enc_password', 60);
            $table->rememberToken();
            $table->string('role')->default('contractor', 100);
            $table->nullableTimestamps();

            $table->boolean('is_active')->default(true);
        });

        Schema::create('upload', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');

            $table->char('rps_year', 4);
            $table->string('category', 100);
            $table->text('description');
            $table->string('path');
            $table->softDeletes();
            $table->text('delete_reason');
        });

        // Region tables.
        Schema::create('basin', function (Blueprint $table) {
            $table->string('basin_name', 100);
            $table->primary('basin_name');

            $table->float('area')->nullable();
            $table->unsignedInteger('sequence')->default(0);
        });

        Schema::create('basin_working_area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('basin_name', 100);
            $table->foreign('basin_name')->references('basin_name')->on('basin')->onUpdate('cascade');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
        });

        Schema::create('province', function (Blueprint $table) {
            $table->string('province_name', 100);
            $table->primary('province_name');
        });

        Schema::create('province_working_area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province_name', 100);
            $table->foreign('province_name')->references('province_name')->on('province')->onUpdate('cascade');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
        });

        Schema::create('archipelago', function (Blueprint $table) {
            $table->string('archipelago_name', 100);
            $table->primary('archipelago_name');
        });

        Schema::create('archipelago_working_area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('archipelago_name', 100);
            $table->foreign('archipelago_name')->references('archipelago_name')->on('archipelago')->onUpdate('cascade');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
        });

        // Study tables.
        Schema::create('afe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');

            $table->char('rps_year', 4);
            $table->string('doc_number', 100);
            $table->string('doc_title', 100);
        });

        Schema::create('recommendation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');

            $table->char('rps_year', 4);
            $table->string('stage', 100);
            $table->text('content');
        });

        Schema::create('commitment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');

            $table->char('rps_year', 4);
            $table->string('stage', 100);
            $table->text('content');
        });

        // Support tables.
        Schema::create('formation', function (Blueprint $table) {
            $table->increments('id');

            $table->string('formation_name', 100);
        });

        Schema::create('prospect_survey', function (Blueprint $table) {
            $table->increments('id');

            $table->float('geo_area_p90')->nullable();
            $table->float('geo_area_p50')->nullable();
            $table->float('geo_area_p10')->nullable();
            $table->float('geo_net_gross_p90')->nullable();
            $table->float('geo_net_gross_p50')->nullable();
            $table->float('geo_net_gross_p10')->nullable();
            $table->float('geo_gross_sand_p90')->nullable();
            $table->float('geo_gross_sand_p50')->nullable();
            $table->float('geo_gross_sand_p10')->nullable();
            $table->string('geo_year', 100)->nullable();
            $table->string('geo_method', 100)->nullable();
            $table->string('geo_coverage', 100)->nullable();
            $table->float('s2_area_p90')->nullable();
            $table->float('s2_area_p50')->nullable();
            $table->float('s2_area_p10')->nullable();
            $table->float('s2_net_pay_p90')->nullable();
            $table->float('s2_net_pay_p50')->nullable();
            $table->float('s2_net_pay_p10')->nullable();
            $table->string('s2_year', 100)->nullable();
            $table->string('s2_vintage', 100)->nullable();
            $table->string('s2_crossline', 100)->nullable();
            $table->string('s2_seismic_line', 100)->nullable();
            $table->string('s2_parallel', 100)->nullable();
            $table->string('s2_late_method', 100)->nullable();
            $table->string('s2_top_depth', 100)->nullable();
            $table->string('s2_bot_depth', 100)->nullable();
            $table->string('s2_spill_point', 100)->nullable();
            $table->string('s2_formation_thick', 100)->nullable();
            $table->string('s2_gross_reservoir', 100)->nullable();
            $table->string('s2_cut_vshale', 100)->nullable();
            $table->string('s2_cut_porosity', 100)->nullable();
            $table->string('s2_cut_saturation', 100)->nullable();
            $table->float('grav_area_p90')->nullable();
            $table->float('grav_area_p50')->nullable();
            $table->float('grav_area_p10')->nullable();
            $table->float('grav_net_pay_p90')->nullable();
            $table->float('grav_net_pay_p50')->nullable();
            $table->float('grav_net_pay_p10')->nullable();
            $table->string('grav_year', 100)->nullable();
            $table->string('grav_method', 100)->nullable();
            $table->string('grav_coverage', 100)->nullable();
            $table->string('grav_range', 100)->nullable();
            $table->string('grav_recorder', 100)->nullable();
            $table->string('grav_spill_point', 100)->nullable();
            $table->string('grav_formation_thick', 100)->nullable();
            $table->string('grav_top_seismic', 100)->nullable();
            $table->string('grav_bot_seismic', 100)->nullable();
            $table->float('chem_area_p90')->nullable();
            $table->float('chem_area_p50')->nullable();
            $table->float('chem_area_p10')->nullable();
            $table->float('chem_net_pay_p90')->nullable();
            $table->float('chem_net_pay_p50')->nullable();
            $table->float('chem_net_pay_p10')->nullable();
            $table->string('chem_year', 100)->nullable();
            $table->string('chem_interval', 100)->nullable();
            $table->string('chem_location', 100)->nullable();
            $table->string('chem_rock', 100)->nullable();
            $table->string('chem_fluid', 100)->nullable();
            $table->string('chem_composition', 100)->nullable();
            $table->float('elec_area_p90')->nullable();
            $table->float('elec_area_p50')->nullable();
            $table->float('elec_area_p10')->nullable();
            $table->float('elec_net_pay_p90')->nullable();
            $table->float('elec_net_pay_p50')->nullable();
            $table->float('elec_net_pay_p10')->nullable();
            $table->string('elec_year', 100)->nullable();
            $table->string('elec_method', 100)->nullable();
            $table->string('elec_coverage', 100)->nullable();
            $table->string('elec_range', 100)->nullable();
            $table->string('elec_recorder', 100)->nullable();
            $table->float('resi_area_p90')->nullable();
            $table->float('resi_area_p50')->nullable();
            $table->float('resi_area_p10')->nullable();
            $table->float('resi_net_pay_p90')->nullable();
            $table->float('resi_net_pay_p50')->nullable();
            $table->float('resi_net_pay_p10')->nullable();
            $table->string('resi_year', 100)->nullable();
            $table->string('resi_method', 100)->nullable();
            $table->string('resi_coverage', 100)->nullable();
            $table->string('resi_range', 100)->nullable();
            $table->string('resi_recorder', 100)->nullable();
            $table->float('s3_area_p90')->nullable();
            $table->float('s3_area_p50')->nullable();
            $table->float('s3_area_p10')->nullable();
            $table->float('s3_net_pay_p90')->nullable();
            $table->float('s3_net_pay_p50')->nullable();
            $table->float('s3_net_pay_p10')->nullable();
            $table->string('s3_year', 100)->nullable();
            $table->string('s3_vintage', 100)->nullable();
            $table->string('s3_bin', 100)->nullable();
            $table->string('s3_coverage', 100)->nullable();
            $table->string('s3_frequency', 100)->nullable();
            $table->string('s3_lateral', 100)->nullable();
            $table->string('s3_vertical', 100)->nullable();
            $table->string('s3_late_method', 100)->nullable();
            $table->string('s3_image', 100)->nullable();
            $table->string('s3_top_depth', 100)->nullable();
            $table->string('s3_bot_depth', 100)->nullable();
            $table->string('s3_formation_thick', 100)->nullable();
            $table->string('s3_gross_reservoir', 100)->nullable();
            $table->string('s3_cut_vshale', 100)->nullable();
            $table->string('s3_cut_porosity', 100)->nullable();
            $table->string('s3_cut_saturation', 100)->nullable();
            $table->float('oter_area_p90')->nullable();
            $table->float('oter_area_p50')->nullable();
            $table->float('oter_area_p10')->nullable();
            $table->float('oter_net_pay_p90')->nullable();
            $table->float('oter_net_pay_p50')->nullable();
            $table->float('oter_net_pay_p10')->nullable();
            $table->string('oter_year', 100)->nullable();
            $table->text('oter_remark')->nullable();
        });

        Schema::create('gcf', function (Blueprint $table) {
            $table->increments('id');

            $table->string('src_data', 100);
            $table->string('src_formation', 100)->nullable();
            $table->string('src_formation_level', 100)->nullable();
            $table->string('src_age_period', 100)->nullable();
            $table->string('src_age_epoch', 100)->nullable();
            $table->string('src_kerogen', 100)->nullable();
            $table->string('src_capacity', 100)->nullable();
            $table->string('src_heatflow', 100)->nullable();
            $table->string('src_distribution', 100)->nullable();
            $table->string('src_continuity', 100)->nullable();
            $table->string('src_maturity', 100)->nullable();
            $table->string('src_other', 100)->nullable();

            $table->string('res_data', 100);
            $table->string('res_litho', 100);
            $table->string('res_formation', 100);
            $table->string('res_formation_level', 100)->nullable();
            $table->string('res_age_period', 100);
            $table->string('res_age_epoch', 100)->nullable();
            $table->string('res_dep_env', 100);
            $table->string('res_dep_set', 100)->nullable();
            $table->string('res_distribution', 100)->nullable();
            $table->string('res_continuity', 100)->nullable();
            $table->string('res_primary', 100)->nullable();
            $table->string('res_second', 100)->nullable();

            $table->string('trp_data', 100);
            $table->string('trp_type', 100);
            $table->string('trp_age_period', 100)->nullable();
            $table->string('trp_age_epoch', 100)->nullable();
            $table->string('trp_geometry', 100)->nullable();
            $table->string('trp_seal_type', 100)->nullable();
            $table->string('trp_seal_distribution', 100)->nullable();
            $table->string('trp_seal_continuity', 100)->nullable();
            $table->string('trp_seal_age_period', 100)->nullable();
            $table->string('trp_seal_age_epoch', 100)->nullable();
            $table->string('trp_seal_formation', 100)->nullable();
            $table->string('trp_seal_formation_level', 100)->nullable();
            $table->string('trp_closure', 100)->nullable();

            $table->string('dyn_data', 100);
            $table->string('dyn_authenticate', 100)->nullable();
            $table->string('dyn_kitchen', 100)->nullable();
            $table->string('dyn_tectonic', 100)->nullable();
            $table->string('dyn_regime_early_period', 100)->nullable();
            $table->string('dyn_regime_early_epoch', 100)->nullable();
            $table->string('dyn_regime_late_period', 100)->nullable();
            $table->string('dyn_regime_late_epoch', 100)->nullable();
            $table->string('dyn_preservation', 100)->nullable();
            $table->string('dyn_pathway', 100)->nullable();
            $table->string('dyn_age_period', 100)->nullable();
            $table->string('dyn_age_epoch', 100)->nullable();
        });

        Schema::create('play', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
            $table->unsignedInteger('gcf_id');
            $table->foreign('gcf_id')->references('id')->on('gcf');

            $table->char('rps_year', 4);
            $table->string('basin_name', 100);
            $table->string('province_name', 100);
            $table->string('remark', 100)->nullable();
            $table->string('analog_to', 100);
            $table->string('analog_distance', 100);
            $table->string('shore', 100);
            $table->string('terrain', 100);
            $table->string('nearby_field', 100);
            $table->string('nearby_infra', 100);
            $table->string('s2_year', 100)->nullable();
            $table->string('s2_crossline', 100)->nullable();
            $table->string('s2_line_distance', 100)->nullable();
            $table->string('chem_sample', 100)->nullable();
            $table->string('chem_depth', 100)->nullable();
            $table->string('grav_acreage', 100)->nullable();
            $table->string('grav_depth', 100)->nullable();
            $table->string('resi_acreage', 100)->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
            $table->text('update_reason')->nullable();
            $table->text('delete_reason')->nullable();
        });

        Schema::create('re_play', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
            $table->unsignedInteger('contractor_working_area_id');
            $table->foreign('contractor_working_area_id')
                ->references('id')->on('contractor_working_area');
            $table->unsignedInteger('play_id');
            $table->foreign('play_id')->references('id')->on('play');

            $table->char('rps_year', 4);
            $table->string('play_name');
            // TODO: Lengkapi atribut
        });

        Schema::create('lead', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
            $table->unsignedInteger('play_id');
            $table->foreign('play_id')->references('id')->on('play');
            $table->unsignedInteger('gcf_id');
            $table->foreign('gcf_id')->references('id')->on('gcf');

            $table->char('rps_year', 4);
            $table->string('basin_name', 100);
            $table->string('province_name', 100);
            $table->string('structure_name', 100);
            $table->string('closure_name', 100);
            $table->string('clarified', 100);
            $table->date('initiate');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('shore', 100);
            $table->string('terrain', 100);
            $table->string('nearby_field', 100);
            $table->string('nearby_infra', 100);
            $table->text('remark')->nullable();
            $table->float('geo_low')->nullable();
            $table->float('geo_best')->nullable();
            $table->float('geo_high')->nullable();
            $table->string('geo_year', 100)->nullable();
            $table->string('geo_method', 100)->nullable();
            $table->string('geo_coverage', 100)->nullable();
            $table->float('s2_low')->nullable();
            $table->float('s2_best')->nullable();
            $table->float('s2_high')->nullable();
            $table->string('s2_year', 100)->nullable();
            $table->string('s2_vintage', 100)->nullable();
            $table->string('s2_crossline', 100)->nullable();
            $table->string('s2_coverage', 100)->nullable();
            $table->string('s2_avg_interval', 100)->nullable();
            $table->string('s2_late_year', 100)->nullable();
            $table->string('s2_late_method', 100)->nullable();
            $table->string('s2_image', 100)->nullable();
            $table->float('grav_low')->nullable();
            $table->float('grav_best')->nullable();
            $table->float('grav_high')->nullable();
            $table->string('grav_year', 100)->nullable();
            $table->string('grav_method', 100)->nullable();
            $table->string('grav_coverage', 100)->nullable();
            $table->string('grav_penetrate', 100)->nullable();
            $table->string('grav_recorder', 100)->nullable();
            $table->float('chem_low')->nullable();
            $table->float('chem_best')->nullable();
            $table->float('chem_high')->nullable();
            $table->string('chem_year', 100)->nullable();
            $table->string('chem_interval', 100)->nullable();
            $table->string('chem_sample', 100)->nullable();
            $table->string('chem_rock', 100)->nullable();
            $table->string('chem_fluid', 100)->nullable();
            $table->string('chem_composition', 100)->nullable();
            $table->float('elec_low')->nullable();
            $table->float('elec_best')->nullable();
            $table->float('elec_high')->nullable();
            $table->string('elec_method', 100)->nullable();
            $table->string('elec_coverage', 100)->nullable();
            $table->string('elec_penetrate', 100)->nullable();
            $table->string('elec_recorder', 100)->nullable();
            $table->float('resi_low')->nullable();
            $table->float('resi_best')->nullable();
            $table->float('resi_high')->nullable();
            $table->string('resi_year', 100)->nullable();
            $table->string('resi_method', 100)->nullable();
            $table->string('resi_coverage', 100)->nullable();
            $table->string('resi_range', 100)->nullable();
            $table->string('resi_recorder', 100)->nullable();
            $table->float('oter_low')->nullable();
            $table->float('oter_best')->nullable();
            $table->float('oter_high')->nullable();
            $table->string('oter_year', 100)->nullable();
            $table->text('oter_remark')->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
            $table->dateTime('upgrade_at')->nullable();
            $table->text('update_reason')->nullable();
            $table->text('delete_reason')->nullable();
            $table->text('upgrade_reason')->nullable();
            $table->boolean('is_pinned')->default(false);
        });

        /**
         * Lead Oil, Lead Gas, dan Ekivalen tidak dimasukkan
         * karena dapat dihitung langsung. Play sudah dihubungkan
         * langsung dengan lead_id masing-masing.
         */
        Schema::create('re_lead', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('lead');
            $table->unsignedInteger('contractor_working_area_id');
            $table->foreign('contractor_working_area_id')
                ->references('id')->on('contractor_working_area');
            $table->unsignedInteger('re_play_id');
            $table->foreign('re_play_id')->references('id')->on('re_play');

            $table->char('rps_year', 4);
            $table->string('structure_name', 100)->nullable();
            $table->string('closure_name', 100);
            $table->float('area_p90')->nullable();
            $table->float('area_p50')->nullable();
            $table->float('area_p10')->nullable();
            $table->float('net_pay_p90')->nullable();
            $table->float('net_pay_p50')->nullable();
            $table->float('net_pay_p10')->nullable();
            $table->float('por_p90')->nullable();
            $table->float('por_p50')->nullable();
            $table->float('por_p10')->nullable();
            $table->float('sat_p90')->nullable();
            $table->float('sat_p50')->nullable();
            $table->float('sat_p10')->nullable();
            $table->float('ooip_p90')->nullable();
            $table->float('ooip_p50')->nullable();
            $table->float('ooip_p10')->nullable();
            $table->float('ogip_p90')->nullable();
            $table->float('ogip_p50')->nullable();
            $table->float('ogip_p10')->nullable();
            $table->float('boi')->nullable();
            $table->float('bgi')->nullable();
            $table->float('accumulation_oil')->nullable();
            $table->float('accumulation_gas')->nullable();
            $table->float('recovery_oil')->nullable();
            $table->float('recovery_gas')->nullable();
            $table->float('success_ratio')->nullable();
            $table->float('stoip_p90')->nullable();
            $table->float('stoip_p50')->nullable();
            $table->float('stoip_p10')->nullable();
            $table->float('igip_p90')->nullable();
            $table->float('igip_p50')->nullable();
            $table->float('igip_p10')->nullable();
            $table->float('source_rock')->nullable();
            $table->float('reservoir')->nullable();
            $table->float('trap')->nullable();
            $table->float('dynamic')->nullable();
            $table->float('gcf')->nullable();
            $table->float('rci')->nullable();
        });

        Schema::create('drillable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
            $table->unsignedInteger('play_id');
            $table->foreign('play_id')->references('id')->on('play');
            $table->unsignedInteger('prospect_survey_id');
            $table->foreign('prospect_survey_id')->references('id')->on('prospect_survey');
            $table->unsignedInteger('gcf_id');
            $table->foreign('gcf_id')->references('id')->on('gcf');

            $table->char('rps_year', 4);
            $table->string('basin_name', 100);
            $table->string('province_name', 100);
            $table->string('structure_name', 100)->nullable();
            $table->string('closure_name', 100);
            $table->string('clarified', 100);
            $table->date('initiate');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('shore', 100);
            $table->string('terrain', 100);
            $table->string('nearby_field', 100);
            $table->string('nearby_infra', 100);
            $table->text('remark')->nullable();
            $table->float('por_p90')->nullable();
            $table->float('por_p50');
            $table->float('por_p10')->nullable();
            $table->float('sat_p90')->nullable();
            $table->float('sat_p50');
            $table->float('sat_p10')->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
            $table->dateTime('upgrade_at')->nullable();
            $table->text('update_reason')->nullable();
            $table->text('upgrade_reason')->nullable();
            $table->text('delete_reason')->nullable();
            $table->boolean('is_pinned')->default(false);
        });

        Schema::create('postdrill_well', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');

            $table->string('well_name', 100);
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('well_type', 100);
            $table->string('well_status', 100);
            $table->string('well_integrity', 100);
            $table->date('well_date')->comment('Completed well date');
            $table->string('shore', 100);
            $table->string('terrain', 100);
            $table->string('target_depth_tvd', 100)->nullable()->comment('Targeted total depth (TVD)');
            $table->string('target_depth_md', 100)->nullable()->comment('Targeted total depth (MD)');
            $table->string('actual_depth', 100)->nullable()->comment('Actual total depth');
            $table->string('mdt_sample', 100)->nullable();
            $table->string('rft_sample', 100)->nullable();
            $table->string('initial_pressure', 100)->nullable();
            $table->string('last_pressure', 100)->nullable();
            $table->string('gradient_pressure', 100)->nullable();
            $table->string('reservoir_temp', 100)->nullable();

            // Data dari Zone
            $table->string('well_result', 100);
            $table->string('reservoir_property')->comment(
                'Clastic or Carbonate Reservoir Property (by Electrolog)'
            );
            $table->float('por_p90')->nullable();
            $table->float('por_p50')->nullable();
            $table->float('por_p10')->nullable();
            $table->float('sat_p90')->nullable();
            $table->float('sat_p50')->nullable();
            $table->float('sat_p10')->nullable();
            $table->float('boi')->nullable();
            $table->float('bgi')->nullable();
            $table->float('gas_oil_ratio')->nullable();

            $table->string('gross_reservoir', 100)->nullable()->comment(
                'Gross reservoir thickness'
            );
            // Hydrocarbon indication.
            $table->string('oil_show', 100)->nullable();
            $table->string('gas_show', 100)->nullable();
            $table->string('well_water_cut', 100)->nullable();
            $table->string('water_depth_gwc', 100)->nullable();
            $table->string('water_depth_owc', 100)->nullable();

            // Rock property by sampling.
            $table->string('rock_sampling_method', 100)->nullable();
            $table->string('petrography_analysis', 100)->nullable();
            $table->string('total_core_barrel', 100)->nullable();
            $table->string('one_core_barrel', 100)->nullable();
            $table->string('total_barrel_data', 100)->nullable();
            $table->string('preservative_core', 100)->nullable();
            $table->string('routine_core', 100)->nullable();
            $table->string('scal_data', 100)->nullable();

            // Fluid property by sampling.
            $table->string('seperator_pressure', 100)->nullable();
            $table->string('seperator_temp', 100)->nullable();
            $table->string('tubing_pressure', 100)->nullable();
            $table->string('casing_pressure', 100)->nullable();
            $table->string('oil_gravity', 100)->nullable();
            $table->string('gas_gravity', 100)->nullable();
            $table->string('condensate_gravity', 100)->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
            $table->text('update_reason')->nullable();
            $table->text('delete_reason')->nullable();
        });

        Schema::create('postdrill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
            $table->unsignedInteger('play_id');
            $table->foreign('play_id')->references('id')->on('play');
            $table->unsignedInteger('postdrill_well_id')->nullable();
            $table->foreign('postdrill_well_id')->references('id')->on('postdrill_well');
            $table->unsignedInteger('prospect_survey_id');
            $table->foreign('prospect_survey_id')->references('id')->on('prospect_survey');
            $table->unsignedInteger('gcf_id');
            $table->foreign('gcf_id')->references('id')->on('gcf');

            $table->char('rps_year', 4);
            $table->string('basin_name', 100);
            $table->string('province_name', 100);
            $table->string('structure_name', 100);
            $table->string('clarified', 100);
            $table->date('initiate');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('shore', 100);
            $table->string('terrain', 100);
            $table->string('nearby_field', 100);
            $table->string('nearby_infra', 100);
            $table->text('remark')->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
            $table->dateTime('upgrade_at')->nullable();
            $table->text('update_reason')->nullable();
            $table->text('upgrade_reason')->nullable();
            $table->text('delete_reason')->nullable();
            $table->boolean('is_pinned')->default(false);
        });

        Schema::create('discovery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');
            $table->unsignedInteger('play_id');
            $table->foreign('play_id')->references('id')->on('play');
            $table->unsignedInteger('prospect_survey_id');
            $table->foreign('prospect_survey_id')->references('id')->on('prospect_survey');
            $table->unsignedInteger('gcf_id');
            $table->foreign('gcf_id')->references('id')->on('gcf');

            $table->char('rps_year', 4);
            $table->string('basin_name', 100);
            $table->string('province_name', 100);
            $table->string('structure_name', 100);
            $table->string('clarified', 100);
            $table->date('initiate');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('shore', 100);
            $table->string('terrain', 100);
            $table->string('nearby_field', 100);
            $table->string('nearby_infra', 100);
            $table->text('remark')->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
            $table->dateTime('upgrade_at')->nullable();
            $table->text('update_reason')->nullable();
            $table->text('upgrade_reason')->nullable();
            $table->text('delete_reason')->nullable();
            $table->boolean('is_pinned')->default(false);
        });

        Schema::create('tested_well', function (Blueprint $table) {
            $table->increments('id');
            $table->string('working_area_id', 15);
            $table->foreign('working_area_id')->references('id')->on('working_area');

            $table->string('well_name', 100);
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('well_type', 100);
            $table->string('well_status', 100);
            $table->string('well_integrity', 100);
            $table->date('well_date')->comment('Completed well date');
            $table->string('shore', 100);
            $table->string('terrain', 100);
            $table->string('target_depth_tvd', 100)->nullable()->comment('Targeted total depth (TVD)');
            $table->string('target_depth_md', 100)->nullable()->comment('Targeted total depth (MD)');
            $table->string('actual_depth', 100)->nullable()->comment('Actual total depth');
            $table->string('mdt_sample', 100)->nullable();
            $table->string('rft_sample', 100)->nullable();
            $table->string('initial_pressure', 100)->nullable();
            $table->string('last_pressure', 100)->nullable();
            $table->string('gradient_pressure', 100)->nullable();
            $table->string('reservoir_temp', 100)->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
            $table->text('update_reason')->nullable();
            $table->text('delete_reason')->nullable();
        });

        Schema::create('tested_well_zone', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tested_well_id');
            $table->foreign('tested_well_id')->references('id')->on('tested_well');

            // General data mandatory.
            $table->string('zone_name', 100);
            $table->string('zone_result', 100)->nullable();
            $table->string('zone_formation', 100);
            $table->string('zone_formation_level', 100)->nullable();
            $table->float('radius_investigation');
            $table->float('zone_thickness');
            $table->string('reservoir_property')->comment(
                'Clastic or Carbonate Reservoir Property (by Electrolog)'
            );
            $table->float('por_p90')->nullable();
            $table->float('por_p50')->nullable();
            $table->float('por_p10')->nullable();
            $table->float('sat_p90')->nullable();
            $table->float('sat_p50')->nullable();
            $table->float('sat_p10')->nullable();
            $table->float('boi')->nullable();
            $table->float('bgi')->nullable();
            $table->float('gas_oil_ratio')->nullable();

            // General data optional.
            $table->string('gross_reservoir', 100)->nullable()->comment(
                'Gross reservoir thickness'
            );
            $table->string('net_gross', 100)->nullable()->comment('Net to gross');
            $table->string('test_duration', 100)->nullable();
            $table->string('initial_flow', 100)->nullable();
            $table->string('initial_shut_in', 100)->nullable();
            $table->string('tubing_size', 100)->nullable();
            $table->string('initial_temp', 100)->nullable();
            $table->string('initial_pressure', 100)->nullable();
            $table->string('lowest_oil', 100)->nullable();
            $table->string('lowest_gas', 100)->nullable();
            $table->string('free_water_depth', 100)->nullable();
            $table->string('reservoir_shape', 100)->nullable();

            // Production rate.
            $table->string('oil_choke', 100)->nullable();
            $table->string('oil_flow_rate', 100)->nullable();
            $table->string('gas_choke', 100)->nullable();
            $table->string('gas_flow_rate', 100)->nullable();
            $table->string('cumm_oil', 100)->nullable();
            $table->string('cumm_gas', 100)->nullable();
            $table->string('diffusity', 100)->nullable();
            $table->string('permeability', 100)->nullable();
            $table->string('delta_skin', 100)->nullable();
            $table->string('wellbore_skin', 100)->nullable();
            $table->string('total_compress', 100)->nullable();

            // Hydrocarbon indication.
            $table->string('oil_show', 100)->nullable();
            $table->string('gas_show', 100)->nullable();
            $table->string('well_water_cut', 100)->nullable();
            $table->string('water_depth_gwc', 100)->nullable();
            $table->string('water_depth_owc', 100)->nullable();

            // Rock property by sampling.
            $table->string('rock_sampling_method', 100)->nullable();
            $table->string('petrography_analysis', 100)->nullable();
            $table->string('total_core_barrel', 100)->nullable();
            $table->string('one_core_barrel', 100)->nullable();
            $table->string('total_barrel_data', 100)->nullable();
            $table->string('preservative_core', 100)->nullable();
            $table->string('routine_core', 100)->nullable();
            $table->string('scal_data', 100)->nullable();

            // Fluid property by sampling.
            $table->string('seperator_pressure', 100)->nullable();
            $table->string('seperator_temp', 100)->nullable();
            $table->string('tubing_pressure', 100)->nullable();
            $table->string('casing_pressure', 100)->nullable();
            $table->string('oil_gravity', 100)->nullable();
            $table->string('gas_gravity', 100)->nullable();
            $table->string('condensate_gravity', 100)->nullable();
        });

        Schema::create('discovery_tested_well_zone', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tested_well_zone_id');
            $table->foreign('tested_well_zone_id')->references('id')->on('tested_well_zone');
            $table->unsignedInteger('discovery_id');
            $table->foreign('discovery_id')->references('id')->on('discovery');
        });

        Schema::create('sys_year', function (Blueprint $table) {
            $table->increments('id');
            $table->char('rps_year', 4);
            $table->date('begin');
            $table->date('end');
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
        Schema::drop('upload');
        Schema::drop('contractor_working_area');
        Schema::drop('contractor');
        Schema::drop('archipelago_working_area');
        Schema::drop('archipelago');
        Schema::drop('province_working_area');
        Schema::drop('province');
        Schema::drop('basin_working_area');
        Schema::drop('basin');
        Schema::drop('commitment');
        Schema::drop('recommendation');
        Schema::drop('afe');

        Schema::drop('postdrill_well');
        Schema::drop('discovery_tested_well_zone');
        Schema::drop('tested_well_zone');
        Schema::drop('tested_well');
        Schema::drop('postdrill');
        Schema::drop('discovery');
        Schema::drop('drillable');
        Schema::drop('re_lead');
        Schema::drop('lead');
        Schema::drop('re_play');
        Schema::drop('play');

        Schema::drop('gcf');
        Schema::drop('prospect_survey');
        Schema::drop('formation');

        Schema::drop('hist_working_area');
        Schema::drop('working_area');

        Schema::drop('sys_year');
    }
}
