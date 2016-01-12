<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Play Seeder
         */
        $plays = DB::connection('oldrps')->table('rsc_play as pl')
            ->leftJoin('rsc_gcf as gcf', 'pl.gcf_id', '=', 'gcf.gcf_id')
            ->leftJoin('adm_basin as b', 'pl.basin_id', '=', 'b.basin_id')
            ->leftJoin('adm_province as p', 'pl.province_id', '=', 'p.province_id')
            ->select(
                'pl.play_id',
                'pl.wk_id as working_area_id',
                'b.basin_name as basin_name',
                'p.province_name as province_name',
                'pl.play_remark as remark',
                'pl.play_analog_to as analog_to',
                'pl.play_analog_distance as analog_distance',
                'pl.play_shore as shore',
                'pl.play_terrain as terrain',
                'pl.play_near_field as nearby_field',
                'pl.play_near_infra_structure as nearby_infra',
                'pl.play_s2d_year as s2_year',
                'pl.play_s2d_crossline as s2_crossline',
                'pl.play_s2d_line_intervall as s2_line_distance',
                'pl.play_sgc_sample as chem_sample',
                'pl.play_sgc_depth as chem_depth',
                'pl.play_sgv_acre as grav_acreage',
                'pl.play_sgv_depth as grav_depth',
                'pl.play_srt_acre as resi_acreage',
                'pl.play_submit_date as created_at'
            )
            ->whereNotIn('pl.wk_id', ['WK0000', 'WK9999']);
        $plays = $this->withGcf($plays)->get();

        // Menyimpan Play ID original dari database rps_skkmigas, dan mapping
        // dengan ID Play baru
        $originalPlayIds = [];

        foreach ($plays as $play) {
            $gcfId = $this->gcfSave($play);

            // Ubah basin yang salah pada tiap WK kecuali WK Pertamina EP
            if ($play->working_area_id != 'WK1047') {
                $play->basin_name = DB::table('basin_working_area')
                    ->where('working_area_id', $play->working_area_id)
                    ->value('basin_name');
            }

            if ($play->terrain === '< 12 miles Offshore') {
                $play->terrain = '< 20 Km Offshore';
            }

            if ($play->terrain === '> 12 miles Offshore') {
                $play->terrain = '> 20 Km Offshore';
            }

            $playId = DB::table('play')->insertGetId([
                'working_area_id' => $play->working_area_id,
                'gcf_id' => $gcfId,
                'rps_year' => '2015',
                'basin_name' => $play->basin_name,
                'province_name' => $play->province_name,
                'remark' => $play->remark,
                'analog_to' => $play->analog_to,
                'analog_distance' => $play->analog_distance,
                'shore' => $play->shore,
                'terrain' => $play->terrain,
                'nearby_field' => $play->nearby_field,
                'nearby_infra' => $play->nearby_infra,
                's2_year' => $play->s2_year,
                's2_crossline' => $play->s2_crossline,
                's2_line_distance' => $play->s2_line_distance,
                'chem_sample' => $play->chem_sample,
                'chem_depth' => $play->chem_depth,
                'grav_acreage' => $play->grav_acreage,
                'grav_depth' => $play->grav_depth,
                'resi_acreage' => $play->resi_acreage,
                'created_at' => $play->created_at,
                'updated_at' => $play->created_at,
            ]);

            $originalPlayIds[$play->play_id] = $playId;
        }

        /**
         * Lead Seeder
         */
        $leads = DB::connection('oldrps')->table('rsc_lead as ld')
            ->join('rsc_play as pl', 'pl.play_id', '=', 'ld.play_id')
            ->leftJoin('rsc_gcf as gcf', 'ld.gcf_id', '=', 'gcf.gcf_id')
            ->leftJoin('rsc_lead_2d as s2', 'ld.lead_id', '=', 's2.lead_id')
            ->leftJoin('rsc_lead_electromagnetic as elec', 'ld.lead_id', '=', 'elec.lead_id')
            ->leftJoin('rsc_lead_geochemistry as chem', 'ld.lead_id', '=', 'chem.lead_id')
            ->leftJoin('rsc_lead_geological as geo', 'ld.lead_id', '=', 'geo.lead_id')
            ->leftJoin('rsc_lead_gravity as grav', 'ld.lead_id', '=', 'grav.lead_id')
            ->leftJoin('rsc_lead_resistivity as resi', 'ld.lead_id', '=', 'resi.lead_id')
            ->leftJoin('rsc_lead_other as oter', 'ld.lead_id', '=', 'oter.lead_id')
            ->leftJoin('adm_basin as b', 'pl.basin_id', '=', 'b.basin_id')
            ->leftJoin('adm_province as p', 'pl.province_id', '=', 'p.province_id')
            ->select(
                'ld.play_id as play_id',
                'pl.wk_id as working_area_id',
                'b.basin_name as basin_name',
                'p.province_name as province_name',
                'ld.structure_name as closure_name',
                'ld.lead_clarified as clarified',
                'ld.lead_date_initiate as initiate',
                'ld.lead_latitude as latitude',
                'ld.lead_longitude as longitude',
                'ld.lead_shore as shore',
                'ld.lead_terrain as terrain',
                'ld.lead_near_field as nearby_field',
                'ld.lead_near_infra_structure as nearby_infra',
                'geo.lsgf_low_estimate as geo_low',
                'geo.lsgf_best_estimate as geo_best',
                'geo.lsgf_high_estimate as geo_high',
                'geo.lsgf_year_survey as geo_year',
                'geo.lsgf_survey_method as geo_method',
                'geo.lsgf_coverage_area as geo_coverage',
                's2.ls2d_low_estimate as s2_low',
                's2.ls2d_best_estimate as s2_best',
                's2.ls2d_hight_estimate as s2_high',
                's2.ls2d_year_survey as s2_year',
                's2.ls2d_vintage_number as s2_vintage',
                's2.ls2d_total_crossline as s2_crossline',
                's2.ls2d_total_coverage as s2_coverage',
                's2.ls2d_average_interval as s2_avg_interval',
                's2.ls2d_year_late_process as s2_late_year',
                's2.ls2d_late_method as s2_late_method',
                's2.ls2d_img_quality as s2_image',
                'grav.lsgv_low_estimate as grav_low',
                'grav.lsgv_best_estimate as grav_best',
                'grav.lsgv_high_estimate as grav_high',
                'grav.lsgv_year_survey as grav_year',
                'grav.lsgv_survey_method as grav_method',
                'grav.lsgv_coverage_area as grav_coverage',
                'grav.lsgv_range_penetration as grav_penetrate',
                'grav.lsgv_spacing_interval as grav_recorder',
                'chem.lsgc_low_estimate as chem_low',
                'chem.lsgc_high_estimate as chem_best',
                'chem.lsgc_best_estimate as chem_high',
                'chem.lsgc_year_survey as chem_year',
                'chem.lsgc_range_interval as chem_interval',
                'chem.lsgc_number_sample as chem_sample',
                'chem.lsgc_number_rock as chem_rock',
                'chem.lsgc_number_fluid as chem_fluid',
                'chem.lsgc_hc_composition as chem_composition',
                'elec.lsel_low_estimate as elec_low',
                'elec.lsel_best_estimate as elec_best',
                'elec.lsel_high_estimate as elec_high',
                'elec.lsel_survey_method as elec_method',
                'elec.lsel_coverage_area as elec_coverage',
                'elec.lsel_range_penetration as elec_penetrate',
                'elec.lsel_spacing_interval as elec_recorder',
                'resi.lsrt_low_estimate as resi_low',
                'resi.lsrt_best_estimate as resi_best',
                'resi.lsrt_high_estimate as resi_high',
                'resi.lsrt_year_survey as resi_year',
                'resi.lsrt_survey_method as resi_method',
                'resi.lsrt_coverage_area as resi_coverage',
                'resi.lsrt_range_penetration as resi_range',
                'resi.lsrt_spacing_interval as resi_recorder',
                'oter.lsor_low_estimate as oter_low',
                'oter.lsor_best_estimate as oter_best',
                'oter.lsor_high_estimate as oter_high',
                'oter.lsor_year_survey as oter_year',
                'oter.lsor_remark as oter_remark',
                'ld.lead_submit_date as created_at',
                'ld.lead_is_deleted as lead_is_deleted'
            )
            ->whereNotIn('pl.wk_id', ['WK0000', 'WK9999']);
        $leads = $this->withGcf($leads)->get();

        foreach ($leads as $lead) {
            $gcfId = $this->gcfSave($lead);

            if ($lead->lead_is_deleted) {
                $deletedAt = Carbon::parse($lead->created_at)->addMonths(4)
                    ->toDateTimeString();
                $deleteReason = 'Delete status dari database lama';
            } else {
                $deletedAt = null;
                $deleteReason = null;
            }

            // Ubah basin yang salah pada tiap WK kecuali WK Pertamina EP
            if ($lead->working_area_id != 'WK1047') {
                $lead->basin_name = DB::table('basin_working_area')
                    ->where('working_area_id', $lead->working_area_id)
                    ->value('basin_name');
            }

            if ($lead->terrain === '< 12 miles Offshore') {
                $lead->terrain = '< 20 Km Offshore';
            }

            if ($lead->terrain === '> 12 miles Offshore') {
                $lead->terrain = '> 20 Km Offshore';
            }

            DB::table('lead')->insert([
                'working_area_id' => $lead->working_area_id,
                'play_id' => $originalPlayIds[$lead->play_id],
                'gcf_id' => $gcfId,
                'rps_year' => '2015',
                'basin_name' => $lead->basin_name,
                'province_name' => $lead->province_name,
                'closure_name' => $this->nameCleaner($lead->closure_name),
                'clarified' => $lead->clarified,
                'initiate' => $lead->initiate,
                'latitude' => $lead->latitude,
                'longitude' => $lead->longitude,
                'shore' => $lead->shore,
                'terrain' => $lead->terrain,
                'nearby_field' => $lead->nearby_field,
                'nearby_infra' => $lead->nearby_infra,

                'geo_low' => $lead->geo_low,
                'geo_best' => $lead->geo_best,
                'geo_high' => $lead->geo_high,
                'geo_year' => $lead->geo_year,
                'geo_method' => $lead->geo_method,
                'geo_coverage' => $lead->geo_coverage,
                's2_low' => $lead->s2_low,
                's2_best' => $lead->s2_best,
                's2_high' => $lead->s2_high,
                's2_year' => $lead->s2_year,
                's2_vintage' => $lead->s2_vintage,
                's2_crossline' => $lead->s2_crossline,
                's2_coverage' => $lead->s2_coverage,
                's2_avg_interval' => $lead->s2_avg_interval,
                's2_late_year' => $lead->s2_late_year,
                's2_late_method' => $lead->s2_late_method,
                's2_image' => $lead->s2_image,
                'grav_low' => $lead->grav_low,
                'grav_best' => $lead->grav_best,
                'grav_high' => $lead->grav_high,
                'grav_year' => $lead->grav_year,
                'grav_method' => $lead->grav_method,
                'grav_coverage' => $lead->grav_coverage,
                'grav_penetrate' => $lead->grav_penetrate,
                'grav_recorder' => $lead->grav_recorder,
                'chem_low' => $lead->chem_low,
                'chem_best' => $lead->chem_best,
                'chem_high' => $lead->chem_high,
                'chem_year' => $lead->chem_year,
                'chem_interval' => $lead->chem_interval,
                'chem_sample' => $lead->chem_sample,
                'chem_rock' => $lead->chem_rock,
                'chem_fluid' => $lead->chem_fluid,
                'chem_composition' => $lead->chem_composition,
                'elec_low' => $lead->elec_low,
                'elec_best' => $lead->elec_best,
                'elec_high' => $lead->elec_high,
                'elec_method' => $lead->elec_method,
                'elec_coverage' => $lead->elec_coverage,
                'elec_penetrate' => $lead->elec_penetrate,
                'elec_recorder' => $lead->elec_recorder,
                'resi_low' => $lead->resi_low,
                'resi_best' => $lead->resi_best,
                'resi_high' => $lead->resi_high,
                'resi_year' => $lead->resi_year,
                'resi_method' => $lead->resi_method,
                'resi_coverage' => $lead->resi_coverage,
                'resi_range' => $lead->resi_range,
                'resi_recorder' => $lead->resi_recorder,
                'oter_low' => $lead->oter_low,
                'oter_best' => $lead->oter_best,
                'oter_high' => $lead->oter_high,
                'oter_year' => $lead->oter_year,
                'oter_remark' => $lead->oter_remark,

                'created_at' => $lead->created_at,
                'updated_at' => $lead->created_at,
                'deleted_at' => $deletedAt,
                'delete_reason' => $deleteReason,
            ]);
        }

        /**
         * Drillable Seeder
         */
        $drillables = DB::connection('oldrps')->table('rsc_prospect as pr')
            ->join('rsc_play as pl', 'pl.play_id', '=', 'pr.play_id')
            ->leftJoin('rsc_drillable as dr', 'pr.prospect_id', '=', 'dr.prospect_id')
            ->leftJoin('rsc_gcf as gcf', 'pr.gcf_id', '=', 'gcf.gcf_id')
            ->leftJoin('rsc_seismic_2d as s2', 'pr.prospect_id', '=', 's2.prospect_id')
            ->leftJoin('rsc_seismic_3d as s3', 'pr.prospect_id', '=', 's3.prospect_id')
            ->leftJoin('rsc_electromagnetic as elec', 'pr.prospect_id', '=', 'elec.prospect_id')
            ->leftJoin('rsc_geochemistry as chem', 'pr.prospect_id', '=', 'chem.prospect_id')
            ->leftJoin('rsc_geological as geo', 'pr.prospect_id', '=', 'geo.prospect_id')
            ->leftJoin('rsc_gravity as grav', 'pr.prospect_id', '=', 'grav.prospect_id')
            ->leftJoin('rsc_resistivity as resi', 'pr.prospect_id', '=', 'resi.prospect_id')
            ->leftJoin('rsc_other as oter', 'pr.prospect_id', '=', 'oter.prospect_id')
            ->leftJoin('adm_basin as b', 'pl.basin_id', '=', 'b.basin_id')
            ->leftJoin('adm_province as p', 'pl.province_id', '=', 'p.province_id')
            ->select(
                'pr.play_id as play_id',
                'pl.wk_id as working_area_id',
                'b.basin_name as basin_name',
                'p.province_name as province_name',
                'pr.structure_name as closure_name',
                'pr.prospect_clarified as clarified',
                'pr.prospect_date_initiate as initiate',
                'pr.prospect_latitude as latitude',
                'pr.prospect_longitude as longitude',
                'pr.prospect_shore as shore',
                'pr.prospect_terrain as terrain',
                'pr.prospect_near_field as nearby_field',
                'pr.prospect_near_infra_structure as nearby_infra',
                'dr.dr_por_p90 as por_p90',
                'dr.dr_por_p50 as por_p50',
                'dr.dr_por_p10 as por_p10',
                'dr.dr_satur_p90 as sat_p90',
                'dr.dr_satur_p50 as sat_p50',
                'dr.dr_satur_p10 as sat_p10',
                'pr.prospect_submit_date as created_at',
                'pr.prospect_is_deleted'
            )
            ->where('pr.prospect_type', '=', 'drillable')
            ->whereNotIn('pl.wk_id', ['WK0000', 'WK9999']);
        $drillables = $this->withGcf($drillables);
        $drillables = $this->withProspectSurvey($drillables)->get();

        foreach ($drillables as $drillable) {
            $gcfId = $this->gcfSave($drillable);
            $surveyId = $this->prospectSurveySave($drillable);

            if ($drillable->prospect_is_deleted) {
                $deletedAt = Carbon::parse($drillable->created_at)
                    ->addMonths(5)
                    ->toDateTimeString();
                $deleteReason = 'Delete status dari database lama';
            } else {
                $deletedAt = null;
                $deleteReason = null;
            }

            // Ubah basin yang salah pada tiap WK kecuali WK Pertamina EP
            if ($play->working_area_id != 'WK1047') {
                $play->basin_name = DB::table('basin_working_area')
                    ->where('working_area_id', $play->working_area_id)
                    ->value('basin_name');
            }

            if ($drillable->terrain === '< 12 miles Offshore') {
                $drillable->terrain = '< 20 Km Offshore';
            }

            if ($drillable->terrain === '> 12 miles Offshore') {
                $drillable->terrain = '> 20 Km Offshore';
            }

            DB::table('drillable')->insert([
                'working_area_id' => $drillable->working_area_id,
                'play_id' => $originalPlayIds[$drillable->play_id],
                'prospect_survey_id' => $surveyId,
                'gcf_id' => $gcfId,
                'rps_year' => '2015',
                'basin_name' => $drillable->basin_name,
                'province_name' => $drillable->province_name,
                'closure_name' => $this->nameCleaner($drillable->closure_name),
                'clarified' => $drillable->clarified,
                'initiate' => $drillable->initiate,
                'latitude' => $drillable->latitude,
                'longitude' => $drillable->longitude,
                'shore' => $drillable->shore,
                'terrain' => $drillable->terrain,
                'nearby_field' => $drillable->nearby_field,
                'nearby_infra' => $drillable->nearby_infra,
                'por_p90' => $drillable->por_p90,
                'por_p50' => $drillable->por_p50,
                'por_p10' => $drillable->por_p10,
                'sat_p90' => $drillable->sat_p90,
                'sat_p50' => $drillable->sat_p50,
                'sat_p10' => $drillable->sat_p10,
                'created_at' => $drillable->created_at,
                'updated_at' => $drillable->created_at,
                'deleted_at' => $deletedAt,
                'delete_reason' => $deleteReason,
            ]);
        }

        /**
         * Postdrill Well Seeder
         */
        $postdrillWells = DB::connection('oldrps')->table('rsc_well as wl')
            ->select(
                'wl.prospect_id',
                'wl.wk_id as working_area_id',
                'wl.wl_name as well_name',
                'wl.wl_latitude as latitude',
                'wl.wl_longitude as longitude',
                'wl.wl_type as well_type',
                'wl.wl_status as well_status',
                'wl.wl_integrity as well_integrity',
                'wl.wl_date_complete as well_date',
                'wl.wl_shore as shore',
                'wl.wl_terrain as terrain',
                'wl.wl_target_depth_tvd as target_depth_tvd',
                'wl.wl_target_depth_md as target_depth_md',
                'wl.wl_actual_depth as actual_depth',
                'wl.wl_number_mdt as mdt_sample',
                'wl.wl_number_rft as rft_sample',
                'wl.wl_res_pressure as initial_pressure',
                'wl.wl_last_pressure as last_pressure',
                'wl.wl_pressure_gradient as gradient_pressure',
                'wl.wl_last_temp as reservoir_temp',
                'wl.wl_result as wl_result',

                'wz.zone_clastic_p50_thickness as clastic_gross_reservoir',
                'wz.zone_clastic_p90_por as clastic_por_p90',
                'wz.zone_clastic_p50_por as clastic_por_p50',
                'wz.zone_clastic_p10_por as clastic_por_p10',
                'wz.zone_clastic_p90_satur as clastic_sat_p90',
                'wz.zone_clastic_p50_satur as clastic_sat_p50',
                'wz.zone_clastic_p10_satur as clastic_sat_p10',
                'wz.zone_carbo_p50_thickness as carbo_gross_reservoir',
                'wz.zone_carbo_p90_por as carbo_por_p90',
                'wz.zone_carbo_p50_por as carbo_por_p50',
                'wz.zone_carbo_p10_por as carbo_por_p10',
                'wz.zone_carbo_p90_satur as carbo_sat_p90',
                'wz.zone_carbo_p50_satur as carbo_sat_p50',
                'wz.zone_carbo_p10_satur as carbo_sat_p10',
                'wz.zone_fvf_oil_p50 as boi',
                'wz.zone_fvf_gas_p50 as bgi',
                'wz.zone_fluid_ratio as gas_oil_ratio',
                'wz.zone_hc_oil_show as oil_show',
                'wz.zone_hc_gas_show as gas_show',
                'wz.zone_hc_water_cut as well_water_cut',
                'wz.zone_hc_water_gwc as water_depth_gwc',
                'wz.zone_hc_water_owc as water_depth_owc',
                'wz.zone_rock_method as rock_sampling_method',
                'wz.zone_rock_petro as petrography_analysis',
                'wz.zone_rock_total_core as total_core_barrel',
                'wz.zone_rock_barrel_equal as one_core_barrel',
                'wz.zone_rock_barrel as total_barrel_data',
                'wz.zone_rock_preservative as preservative_core',
                'wz.zone_rock_routine as routine_core',
                'wz.zone_rock_scal as scal_data',
                'wz.zone_fluid_pressure as seperator_pressure',
                'wz.zone_fluid_temp as seperator_temp',
                'wz.zone_fluid_tubing as tubing_pressure',
                'wz.zone_fluid_casing as casing_pressure',
                'wz.zone_fluid_grv_oil as oil_gravity',
                'wz.zone_fluid_grv_gas as gas_gravity',
                'wz.zone_fluid_grv_conden as condensate_gravity',
                'wl.wl_submit_date as created_at'
            )
            ->join('rsc_wellzone as wz', 'wz.wl_id', '=', 'wl.wl_id')
            ->whereNotIn('wl.wk_id', ['WK0000', 'WK9999'])
            ->where('wl.prospect_type', '=', 'postdrill')
            ->groupBy('wl.wl_name')
            ->get();

        $originalWellPostdrillIds = [];

        foreach ($postdrillWells as $well) {
            if ($well->well_name === '----') {
                continue;
            }

            $reservoirProperty = $this->clasticVsCarbonate($well);
            $well->well_name = $this->nameCleaner($well->well_name);

            // Well result
            if ($well->wl_result === 'Oil+Gas') {
                $well->wl_result = 'Oil, Gas';
            } elseif ($well->wl_result === 'Condensate+Gas') {
                $well->wl_result = 'Gas, Condensate';
            } elseif ($well->wl_result === 'Oil+Gas+Condensate') {
                $well->wl_result = 'Oil, Gas, Condensate';
            } elseif ($well->wl_result === 'Oil+Condensate') {
                $well->wl_result = 'Oil, Condensate';
            }

            $wellId = DB::table('postdrill_well')->insertGetId([
                'working_area_id' => $well->working_area_id,
                'well_name' => $this->nameCleaner($well->well_name),
                'latitude' => $well->latitude,
                'longitude' => $well->longitude,
                'well_type' => $well->well_type,
                'well_status' => $well->well_status,
                'well_integrity' => $well->well_integrity,
                'well_date' => $well->well_date,
                'shore' => $well->shore,
                'terrain' => $well->terrain,
                'target_depth_tvd' => $well->target_depth_tvd,
                'target_depth_md' => $well->target_depth_md,
                'actual_depth' => $well->actual_depth,
                'mdt_sample' => $well->mdt_sample,
                'rft_sample' => $well->rft_sample,
                'initial_pressure' => $well->initial_pressure,
                'last_pressure' => $well->last_pressure,
                'gradient_pressure' => $well->gradient_pressure,
                'reservoir_temp' => $well->reservoir_temp,
                'well_result' => $well->wl_result,
                'reservoir_property' => $reservoirProperty['property'],
                'gross_reservoir' => $reservoirProperty['grossReservoir'],
                'por_p90' => $reservoirProperty['porP90'],
                'por_p50' => $reservoirProperty['porP50'],
                'por_p10' => $reservoirProperty['porP10'],
                'sat_p90' => $reservoirProperty['satP90'],
                'sat_p50' => $reservoirProperty['satP90'],
                'sat_p10' => $reservoirProperty['satP90'],
                'boi' => $well->boi,
                'bgi' => $well->bgi,
                'gas_oil_ratio' => $well->gas_oil_ratio,
                'oil_show' => $well->oil_show,
                'gas_show' => $well->gas_show,
                'well_water_cut' => $well->well_water_cut,
                'water_depth_gwc' => $well->water_depth_gwc,
                'water_depth_owc' => $well->water_depth_owc,
                'rock_sampling_method' => $well->rock_sampling_method,
                'petrography_analysis' => $well->petrography_analysis,
                'total_core_barrel' => $well->total_core_barrel,
                'one_core_barrel' => $well->one_core_barrel,
                'total_barrel_data' => $well->total_barrel_data,
                'preservative_core' => $well->preservative_core,
                'routine_core' => $well->routine_core,
                'scal_data' => $well->scal_data,
                'seperator_pressure' => $well->seperator_pressure,
                'seperator_temp' => $well->seperator_temp,
                'tubing_pressure' => $well->tubing_pressure,
                'casing_pressure' => $well->casing_pressure,
                'oil_gravity' => $well->oil_gravity,
                'gas_gravity' => $well->gas_gravity,
                'condensate_gravity' => $well->condensate_gravity,
                'created_at' => $well->created_at,
            ]);

            $originalWellPostdrillIds[$well->prospect_id] = $wellId;
        }

        /**
         * Postdrill Seeder
         */
        $postdrills = DB::connection('oldrps')->table('rsc_prospect as pr')
            ->join('rsc_play as pl', 'pl.play_id', '=', 'pr.play_id')
            ->leftJoin('rsc_gcf as gcf', 'pr.gcf_id', '=', 'gcf.gcf_id')
            ->leftJoin('rsc_seismic_2d as s2', 'pr.prospect_id', '=', 's2.prospect_id')
            ->leftJoin('rsc_seismic_3d as s3', 'pr.prospect_id', '=', 's3.prospect_id')
            ->leftJoin('rsc_electromagnetic as elec', 'pr.prospect_id', '=', 'elec.prospect_id')
            ->leftJoin('rsc_geochemistry as chem', 'pr.prospect_id', '=', 'chem.prospect_id')
            ->leftJoin('rsc_geological as geo', 'pr.prospect_id', '=', 'geo.prospect_id')
            ->leftJoin('rsc_gravity as grav', 'pr.prospect_id', '=', 'grav.prospect_id')
            ->leftJoin('rsc_resistivity as resi', 'pr.prospect_id', '=', 'resi.prospect_id')
            ->leftJoin('rsc_other as oter', 'pr.prospect_id', '=', 'oter.prospect_id')
            ->leftJoin('adm_basin as b', 'pl.basin_id', '=', 'b.basin_id')
            ->leftJoin('adm_province as p', 'pl.province_id', '=', 'p.province_id')
            ->select(
                'pr.prospect_id',
                'pr.play_id as play_id',
                'pl.wk_id as working_area_id',
                'b.basin_name as basin_name',
                'p.province_name as province_name',
                'pr.structure_name as structure_name',
                'pr.prospect_clarified as clarified',
                'pr.prospect_date_initiate as initiate',
                'pr.prospect_latitude as latitude',
                'pr.prospect_longitude as longitude',
                'pr.prospect_shore as shore',
                'pr.prospect_terrain as terrain',
                'pr.prospect_near_field as nearby_field',
                'pr.prospect_near_infra_structure as nearby_infra',
                'pr.prospect_submit_date as created_at',
                'pr.prospect_is_deleted'
            )
            ->where('pr.prospect_type', '=', 'postdrill')
            ->whereNotIn('pl.wk_id', ['WK0000', 'WK9999']);
        $postdrills = $this->withGcf($postdrills);
        $postdrills = $this->withProspectSurvey($postdrills)->get();

        foreach ($postdrills as $postdrill) {
            $gcfId = $this->gcfSave($postdrill);
            $surveyId = $this->prospectSurveySave($postdrill);

            if ($postdrill->prospect_is_deleted) {
                $deletedAt = Carbon::parse($postdrill->created_at)
                    ->addMonths(3)
                    ->toDateTimeString();
                $deleteReason = 'Delete status dari database lama';
            } else {
                $deletedAt = null;
                $deleteReason = null;
            }

            // Ubah basin yang salah pada tiap WK kecuali WK Pertamina EP
            if ($postdrill->working_area_id != 'WK1047') {
                $postdrill->basin_name = DB::table('basin_working_area')
                    ->where('working_area_id', $postdrill->working_area_id)
                    ->value('basin_name');
            }

            if ($postdrill->terrain === '< 12 miles Offshore') {
                $postdrill->terrain = '< 20 Km Offshore';
            }

            if ($postdrill->terrain === '> 12 miles Offshore') {
                $postdrill->terrain = '> 20 Km Offshore';
            }

            if (array_key_exists($postdrill->prospect_id, $originalWellPostdrillIds)) {
                $wellPostdrillId = $originalWellPostdrillIds[$postdrill->prospect_id];
            } else {
                $wellPostdrillId = null;
            }

            DB::table('postdrill')->insert([
                'working_area_id' => $postdrill->working_area_id,
                'play_id' => $originalPlayIds[$postdrill->play_id],
                'postdrill_well_id' => $wellPostdrillId,
                'prospect_survey_id' => $surveyId,
                'gcf_id' => $gcfId,
                'rps_year' => '2015',
                'basin_name' => $postdrill->basin_name,
                'province_name' => $postdrill->province_name,
                'structure_name' => $this->nameCleaner($postdrill->structure_name),
                'clarified' => $postdrill->clarified,
                'initiate' => $postdrill->initiate,
                'latitude' => $postdrill->latitude,
                'longitude' => $postdrill->longitude,
                'shore' => $postdrill->shore,
                'terrain' => $postdrill->terrain,
                'nearby_field' => $postdrill->nearby_field,
                'nearby_infra' => $postdrill->nearby_infra,
                'created_at' => $postdrill->created_at,
                'updated_at' => $postdrill->created_at,
                'deleted_at' => $deletedAt,
                'delete_reason' => $deleteReason,
            ]);
        }

        $originalDiscoveryIds = [];

        /**
         * Discovery Seeder
         */
        $discoveries = DB::connection('oldrps')->table('rsc_prospect as pr')
            ->join('rsc_play as pl', 'pl.play_id', '=', 'pr.play_id')
            ->leftJoin('rsc_gcf as gcf', 'pr.gcf_id', '=', 'gcf.gcf_id')
            ->leftJoin('rsc_seismic_2d as s2', 'pr.prospect_id', '=', 's2.prospect_id')
            ->leftJoin('rsc_seismic_3d as s3', 'pr.prospect_id', '=', 's3.prospect_id')
            ->leftJoin('rsc_electromagnetic as elec', 'pr.prospect_id', '=', 'elec.prospect_id')
            ->leftJoin('rsc_geochemistry as chem', 'pr.prospect_id', '=', 'chem.prospect_id')
            ->leftJoin('rsc_geological as geo', 'pr.prospect_id', '=', 'geo.prospect_id')
            ->leftJoin('rsc_gravity as grav', 'pr.prospect_id', '=', 'grav.prospect_id')
            ->leftJoin('rsc_resistivity as resi', 'pr.prospect_id', '=', 'resi.prospect_id')
            ->leftJoin('rsc_other as oter', 'pr.prospect_id', '=', 'oter.prospect_id')
            ->leftJoin('adm_basin as b', 'pl.basin_id', '=', 'b.basin_id')
            ->leftJoin('adm_province as p', 'pl.province_id', '=', 'p.province_id')
            ->select(
                'pr.prospect_id',
                'pr.play_id as play_id',
                'pl.wk_id as working_area_id',
                'b.basin_name as basin_name',
                'p.province_name as province_name',
                'pr.structure_name as structure_name',
                'pr.prospect_clarified as clarified',
                'pr.prospect_date_initiate as initiate',
                'pr.prospect_latitude as latitude',
                'pr.prospect_longitude as longitude',
                'pr.prospect_shore as shore',
                'pr.prospect_terrain as terrain',
                'pr.prospect_near_field as nearby_field',
                'pr.prospect_near_infra_structure as nearby_infra',
                'pr.prospect_submit_date as created_at',
                'pr.prospect_is_deleted'
            )
            ->where('pr.prospect_type', '=', 'discovery')
            ->whereNotIn('pl.wk_id', ['WK0000', 'WK9999']);
        $discoveries = $this->withGcf($discoveries);
        $discoveries = $this->withProspectSurvey($discoveries)->get();

        foreach ($discoveries as $discovery) {
            $gcfId = $this->gcfSave($discovery);
            $surveyId = $this->prospectSurveySave($discovery);

            if ($discovery->prospect_is_deleted) {
                $deletedAt = Carbon::parse($discovery->created_at)
                    ->addMonths(3)
                    ->toDateTimeString();
                $deleteReason = 'Delete status dari database lama';
            } else {
                $deletedAt = null;
                $deleteReason = null;
            }

            // Ubah basin yang salah pada tiap WK kecuali WK Pertamina EP
            if ($discovery->working_area_id != 'WK1047') {
                $discovery->basin_name = DB::table('basin_working_area')
                    ->where('working_area_id', $discovery->working_area_id)
                    ->value('basin_name');
            }

            if ($discovery->terrain === '< 12 miles Offshore') {
                $discovery->terrain = '< 20 Km Offshore';
            }

            if ($discovery->terrain === '> 12 miles Offshore') {
                $discovery->terrain = '> 20 Km Offshore';
            }

            $discoveryId = DB::table('discovery')->insertGetId([
                'working_area_id' => $discovery->working_area_id,
                'play_id' => $originalPlayIds[$discovery->play_id],
                'prospect_survey_id' => $surveyId,
                'gcf_id' => $gcfId,
                'rps_year' => '2015',
                'basin_name' => $discovery->basin_name,
                'province_name' => $discovery->province_name,
                'structure_name' => $this->nameCleaner($discovery->structure_name),
                'clarified' => $discovery->clarified,
                'initiate' => $discovery->initiate,
                'latitude' => $discovery->latitude,
                'longitude' => $discovery->longitude,
                'shore' => $discovery->shore,
                'terrain' => $discovery->terrain,
                'nearby_field' => $discovery->nearby_field,
                'nearby_infra' => $discovery->nearby_infra,
                'created_at' => $discovery->created_at,
                'updated_at' => $discovery->created_at,
                'deleted_at' => $deletedAt,
                'delete_reason' => $deleteReason,
            ]);

            $originalDiscoveryIds[$discovery->prospect_id] = $discoveryId;
        }

        /**
         * Tested Well (Discovery Well) Seeder
         */
        $testedWell = DB::connection('oldrps')->table('rsc_well as wl')
            ->select(
                'wl.wl_id as well_id',
                'wl.prospect_id',
                'wl.wk_id as working_area_id',
                'wl.wl_name as well_name',
                'wl.wl_formation as formation_name',
                'wl.wl_latitude as latitude',
                'wl.wl_longitude as longitude',
                'wl.wl_type as well_type',
                'wl.wl_status as well_status',
                'wl.wl_integrity as well_integrity',
                'wl.wl_date_complete as well_date',
                'wl.wl_shore as shore',
                'wl.wl_terrain as terrain',
                'wl.wl_target_depth_tvd as target_depth_tvd',
                'wl.wl_target_depth_md as target_depth_md',
                'wl.wl_actual_depth as actual_depth',
                'wl.wl_number_mdt as mdt_sample',
                'wl.wl_number_rft as rft_sample',
                'wl.wl_res_pressure as initial_pressure',
                'wl.wl_last_pressure as last_pressure',
                'wl.wl_pressure_gradient as gradient_pressure',
                'wl.wl_last_temp as reservoir_temp',
                'wl.wl_result as well_result',
                'wl.wl_submit_date as created_at'
            )
            ->leftJoin('rsc_wellzone as wz', 'wz.wl_id', '=', 'wl.wl_id')
            ->whereNotIn('wl.wk_id', ['WK0000', 'WK9999'])
            ->where('wl.prospect_type', '=', 'discovery')
            ->groupBy('wl.wl_name')
            ->get();

        foreach ($testedWell as $well) {
            if ($well->well_name === '----') {
                continue;
            }

            $well->well_name = $this->nameCleaner($well->well_name);

            // Well result
            if ($well->well_result === 'Oil+Gas') {
                $well->well_result = 'Oil, Gas';
            } elseif ($well->well_result === 'Condensate+Gas') {
                $well->well_result = 'Gas, Condensate';
            } elseif ($well->well_result === 'Oil+Gas+Condensate') {
                $well->well_result = 'Oil, Gas, Condensate';
            } elseif ($well->well_result === 'Oil+Condensate') {
                $well->well_result = 'Oil, Condensate';
            }

            $wellId = DB::table('tested_well')->insertGetId([
                'working_area_id' => $well->working_area_id,
                'well_name' => $well->well_name,
                'latitude' => $well->latitude,
                'longitude' => $well->longitude,
                'well_type' => $well->well_type,
                'well_status' => $well->well_status,
                'well_integrity' => $well->well_integrity,
                'well_date' => $well->well_date,
                'shore' => $well->shore,
                'terrain' => $well->terrain,
                'target_depth_tvd' => $well->target_depth_tvd,
                'target_depth_md' => $well->target_depth_md,
                'actual_depth' => $well->actual_depth,
                'mdt_sample' => $well->mdt_sample,
                'rft_sample' => $well->rft_sample,
                'initial_pressure' => $well->initial_pressure,
                'last_pressure' => $well->last_pressure,
                'gradient_pressure' => $well->gradient_pressure,
                'reservoir_temp' => $well->reservoir_temp,
                'created_at' => $well->created_at,
            ]);

            $testedWellZones = DB::connection('oldrps')->table('rsc_wellzone as wz')
                ->select(
                    'wz.zone_name',
                    'wz.zone_prod_res_radius as radius_investigation',
                    'wz.zone_thickness',
                    'wz.zone_result',
                    'wz.zone_clastic_p50_thickness as clastic_gross_reservoir',
                    'wz.zone_clastic_p90_por as clastic_por_p90',
                    'wz.zone_clastic_p50_por as clastic_por_p50',
                    'wz.zone_clastic_p10_por as clastic_por_p10',
                    'wz.zone_clastic_p90_satur as clastic_sat_p90',
                    'wz.zone_clastic_p50_satur as clastic_sat_p50',
                    'wz.zone_clastic_p10_satur as clastic_sat_p10',
                    'wz.zone_carbo_p50_thickness as carbo_gross_reservoir',
                    'wz.zone_carbo_p90_por as carbo_por_p90',
                    'wz.zone_carbo_p50_por as carbo_por_p50',
                    'wz.zone_carbo_p10_por as carbo_por_p10',
                    'wz.zone_carbo_p90_satur as carbo_sat_p90',
                    'wz.zone_carbo_p50_satur as carbo_sat_p50',
                    'wz.zone_carbo_p10_satur as carbo_sat_p10',
                    'wz.zone_fvf_oil_p50 as boi',
                    'wz.zone_fvf_gas_p50 as bgi',
                    'wz.zone_fluid_ratio as gas_oil_ratio',
                    'wz.zone_hc_oil_show as oil_show',
                    'wz.zone_hc_gas_show as gas_show',
                    'wz.zone_hc_water_cut as well_water_cut',
                    'wz.zone_hc_water_gwc as water_depth_gwc',
                    'wz.zone_hc_water_owc as water_depth_owc',
                    'wz.zone_rock_method as rock_sampling_method',
                    'wz.zone_rock_petro as petrography_analysis',
                    'wz.zone_rock_total_core as total_core_barrel',
                    'wz.zone_rock_barrel_equal as one_core_barrel',
                    'wz.zone_rock_barrel as total_barrel_data',
                    'wz.zone_rock_preservative as preservative_core',
                    'wz.zone_rock_routine as routine_core',
                    'wz.zone_rock_scal as scal_data',
                    'wz.zone_fluid_pressure as seperator_pressure',
                    'wz.zone_fluid_temp as seperator_temp',
                    'wz.zone_fluid_tubing as tubing_pressure',
                    'wz.zone_fluid_casing as casing_pressure',
                    'wz.zone_fluid_grv_oil as oil_gravity',
                    'wz.zone_fluid_grv_gas as gas_gravity',
                    'wz.zone_fluid_grv_conden as condensate_gravity'
                )
                ->where('wz.wl_id', '=', $well->well_id)
                ->get();

            $zoneNameSequence = 0;
            foreach ($testedWellZones as $zone) {
                if (trim($zone->zone_name) === '') {
                    $zoneNameSequence = $zoneNameSequence + 1;
                    $zone->zone_name = $well->well_name . ' ZN' . $zoneNameSequence;
                } else {
                    $zone->zone_name = $this->nameCleaner($zone->zone_name);
                }

                if (empty($zone->zone_result)) {
                    if ($well->well_result === 'Condensate+Gas') {
                        $zone->zone_result = 'Gas';
                    } elseif ($well->well_result === 'Oil+Condensate') {
                        $zone->zone_result = 'Oil';
                    }
                }

                $reservoirProperty = $this->clasticVsCarbonate($zone);

                $testedWellZoneId = DB::table('tested_well_zone')->insertGetId([
                    'tested_well_id' => $wellId,
                    'zone_name' => $zone->zone_name,
                    'zone_result' => $zone->zone_result,
                    'zone_formation' => $well->formation_name,
                    'radius_investigation' => $zone->radius_investigation,
                    'zone_thickness' => $zone->zone_thickness,
                    'reservoir_property' => $reservoirProperty['property'],
                    'gross_reservoir' => $reservoirProperty['grossReservoir'],
                    'por_p90' => $reservoirProperty['porP90'],
                    'por_p50' => $reservoirProperty['porP50'],
                    'por_p10' => $reservoirProperty['porP10'],
                    'sat_p90' => $reservoirProperty['satP90'],
                    'sat_p50' => $reservoirProperty['satP90'],
                    'sat_p10' => $reservoirProperty['satP90'],
                    'boi' => $zone->boi,
                    'bgi' => $zone->bgi,
                    'gas_oil_ratio' => $zone->gas_oil_ratio,
                    'oil_show' => $zone->oil_show,
                    'gas_show' => $zone->gas_show,
                    'well_water_cut' => $zone->well_water_cut,
                    'water_depth_gwc' => $zone->water_depth_gwc,
                    'water_depth_owc' => $zone->water_depth_owc,
                    'rock_sampling_method' => $zone->rock_sampling_method,
                    'petrography_analysis' => $zone->petrography_analysis,
                    'total_core_barrel' => $zone->total_core_barrel,
                    'one_core_barrel' => $zone->one_core_barrel,
                    'total_barrel_data' => $zone->total_barrel_data,
                    'preservative_core' => $zone->preservative_core,
                    'routine_core' => $zone->routine_core,
                    'scal_data' => $zone->scal_data,
                    'seperator_pressure' => $zone->seperator_pressure,
                    'seperator_temp' => $zone->seperator_temp,
                    'tubing_pressure' => $zone->tubing_pressure,
                    'casing_pressure' => $zone->casing_pressure,
                    'oil_gravity' => $zone->oil_gravity,
                    'gas_gravity' => $zone->gas_gravity,
                    'condensate_gravity' => $zone->condensate_gravity,
                ]);

                if (!empty($well->prospect_id)) {
                    DB::table('discovery_tested_well_zone')->insert([
                        'tested_well_zone_id' => $testedWellZoneId,
                        'discovery_id' => $originalDiscoveryIds[$well->prospect_id],
                    ]);
                }
            }
        }
    }

    public function gcfSave($data) {
        // Migrasikan isian GCF yang lama ke yang baru
        if ($data->src_heatflow === '<= 1.0') {
            $data->src_heatflow = '0 - 1.0';
        }

        $gcfId = DB::table('gcf')->insertGetId([
            'src_data' => $data->src_data,
            'src_formation' => $data->src_formation,
            'src_formation_level' => $data->src_formation_level,
            'src_age_period' => $data->src_age_period,
            'src_age_epoch' => $data->src_age_epoch,
            'src_kerogen' => $data->src_kerogen,
            'src_capacity' => $data->src_capacity,
            'src_heatflow' => $data->src_heatflow,
            'src_distribution' => $data->src_distribution,
            'src_continuity' => $data->src_continuity,
            'src_maturity' => $data->src_maturity,
            'src_other' => $data->src_other,
            'res_data' => $data->res_data,
            'res_litho' => $data->res_litho,
            'res_formation' => $data->res_formation,
            'res_formation_level' => $data->res_formation_level,
            'res_age_period' => $data->res_age_period,
            'res_age_epoch' => $data->res_age_epoch,
            'res_dep_env' => $data->res_dep_env,
            'res_dep_set' => $data->res_dep_set,
            'res_distribution' => $data->res_distribution,
            'res_continuity' => $data->res_continuity,
            'res_primary' => $data->res_primary,
            'res_second' => $data->res_second,
            'trp_data' => $data->trp_data,
            'trp_type' => $data->trp_type,
            'trp_age_period' => $data->trp_age_period,
            'trp_age_epoch' => $data->trp_age_epoch,
            'trp_geometry' => $data->trp_geometry,
            'trp_seal_type' => $data->trp_seal_type,
            'trp_seal_distribution' => $data->trp_seal_distribution,
            'trp_seal_continuity' => $data->trp_seal_continuity,
            'trp_seal_age_period' => $data->trp_seal_age_period,
            'trp_seal_age_epoch' => $data->trp_seal_age_epoch,
            'trp_seal_formation' => $data->trp_seal_formation,
            'trp_seal_formation_level' => $data->trp_seal_formation_level,
            'trp_closure' => $data->trp_closure,
            'dyn_data' => $data->dyn_data,
            'dyn_authenticate' => $data->dyn_authenticate,
            'dyn_kitchen' => $data->dyn_kitchen,
            'dyn_tectonic' => $data->dyn_tectonic,
            'dyn_regime_early_period' => $data->dyn_regime_early_period,
            'dyn_regime_early_epoch' => $data->dyn_regime_early_epoch,
            'dyn_regime_late_period' => $data->dyn_regime_late_period,
            'dyn_regime_late_epoch' => $data->dyn_regime_late_epoch,
            'dyn_preservation' => $data->dyn_preservation,
            'dyn_pathway' => $data->dyn_pathway,
            'dyn_age_period' => $data->dyn_age_period,
            'dyn_age_epoch' => $data->dyn_age_epoch,
        ]);

        return $gcfId;
    }

    public function prospectSurveySave($data)
    {
        $surveyId = DB::table('prospect_survey')->insertGetId([
            'geo_area_p90' => $data->geo_area_p90,
            'geo_area_p50' => $data->geo_area_p50,
            'geo_area_p10' => $data->geo_area_p10,
            'geo_net_gross_p90' => $data->geo_net_gross_p90,
            'geo_net_gross_p50' => $data->geo_net_gross_p50,
            'geo_net_gross_p10' => $data->geo_net_gross_p10,
            'geo_gross_sand_p90' => $data->geo_gross_sand_p90,
            'geo_gross_sand_p50' => $data->geo_gross_sand_p50,
            'geo_gross_sand_p10' => $data->geo_gross_sand_p10,
            'geo_year' => $data->geo_year,
            'geo_method' => $data->geo_method,
            'geo_coverage' => $data->geo_coverage,
            's2_area_p90' => $data->s2_area_p90,
            's2_area_p50' => $data->s2_area_p50,
            's2_area_p10' => $data->s2_area_p10,
            's2_net_pay_p90' => $data->s2_net_pay_p90,
            's2_net_pay_p50' => $data->s2_net_pay_p50,
            's2_net_pay_p10' => $data->s2_net_pay_p10,
            's2_year' => $data->s2_year,
            's2_vintage' => $data->s2_vintage,
            's2_crossline' => $data->s2_crossline,
            's2_seismic_line' => $data->s2_seismic_line,
            's2_parallel' => $data->s2_parallel,
            's2_late_method' => $data->s2_late_method,
            's2_top_depth' => $data->s2_top_depth,
            's2_bot_depth' => $data->s2_bot_depth,
            's2_spill_point' => $data->s2_spill_point,
            's2_formation_thick' => $data->s2_formation_thick,
            's2_gross_reservoir' => $data->s2_gross_reservoir,
            's2_cut_vshale' => $data->s2_cut_vshale,
            's2_cut_porosity' => $data->s2_cut_porosity,
            's2_cut_saturation' => $data->s2_cut_saturation,
            'grav_area_p90' => $data->grav_area_p90,
            'grav_area_p50' => $data->grav_area_p50,
            'grav_area_p10' => $data->grav_area_p10,
            'grav_net_pay_p90' => $data->grav_net_pay_p90,
            'grav_net_pay_p50' => $data->grav_net_pay_p50,
            'grav_net_pay_p10' => $data->grav_net_pay_p10,
            'grav_year' => $data->grav_year,
            'grav_method' => $data->grav_method,
            'grav_coverage' => $data->grav_coverage,
            'grav_range' => $data->grav_range,
            'grav_recorder' => $data->grav_recorder,
            'grav_spill_point' => $data->grav_spill_point,
            'grav_formation_thick' => $data->grav_formation_thick,
            'grav_top_seismic' => $data->grav_top_seismic,
            'grav_bot_seismic' => $data->grav_bot_seismic,
            'chem_area_p90' => $data->chem_area_p90,
            'chem_area_p50' => $data->chem_area_p50,
            'chem_area_p10' => $data->chem_area_p10,
            'chem_net_pay_p90' => $data->chem_net_pay_p90,
            'chem_net_pay_p50' => $data->chem_net_pay_p50,
            'chem_net_pay_p10' => $data->chem_net_pay_p10,
            'chem_year' => $data->chem_year,
            'chem_interval' => $data->chem_interval,
            'chem_location' => $data->chem_location,
            'chem_rock' => $data->chem_rock,
            'chem_fluid' => $data->chem_fluid,
            'chem_composition' => $data->chem_composition,
            'elec_area_p90' => $data->elec_area_p90,
            'elec_area_p50' => $data->elec_area_p50,
            'elec_area_p10' => $data->elec_area_p10,
            'elec_net_pay_p90' => $data->elec_net_pay_p90,
            'elec_net_pay_p50' => $data->elec_net_pay_p50,
            'elec_net_pay_p10' => $data->elec_net_pay_p10,
            'elec_year' => $data->elec_year,
            'elec_method' => $data->elec_method,
            'elec_coverage' => $data->elec_coverage,
            'elec_range' => $data->elec_range,
            'elec_recorder' => $data->elec_recorder,
            'resi_area_p90' => $data->resi_area_p90,
            'resi_area_p50' => $data->resi_area_p50,
            'resi_area_p10' => $data->resi_area_p10,
            'resi_net_pay_p90' => $data->resi_net_pay_p90,
            'resi_net_pay_p50' => $data->resi_net_pay_p50,
            'resi_net_pay_p10' => $data->resi_net_pay_p10,
            'resi_year' => $data->resi_year,
            'resi_method' => $data->resi_method,
            'resi_coverage' => $data->resi_coverage,
            'resi_range' => $data->resi_range,
            'resi_recorder' => $data->resi_recorder,
            's3_area_p90' => $data->s3_area_p90,
            's3_area_p50' => $data->s3_area_p50,
            's3_area_p10' => $data->s3_area_p10,
            's3_net_pay_p90' => $data->s3_net_pay_p90,
            's3_net_pay_p50' => $data->s3_net_pay_p50,
            's3_net_pay_p10' => $data->s3_net_pay_p10,
            's3_year' => $data->s3_year,
            's3_vintage' => $data->s3_vintage,
            's3_bin' => $data->s3_bin,
            's3_coverage' => $data->s3_coverage,
            's3_frequency' => $data->s3_frequency,
            's3_lateral' => $data->s3_lateral,
            's3_vertical' => $data->s3_vertical,
            's3_late_method' => $data->s3_late_method,
            's3_image' => $data->s3_image,
            's3_top_depth' => $data->s3_top_depth,
            's3_bot_depth' => $data->s3_bot_depth,
            's3_formation_thick' => $data->s3_formation_thick,
            's3_gross_reservoir' => $data->s3_gross_reservoir,
            's3_cut_vshale' => $data->s3_cut_vshale,
            's3_cut_porosity' => $data->s3_cut_porosity,
            's3_cut_saturation' => $data->s3_cut_saturation,
            'oter_area_p90' => $data->oter_area_p90,
            'oter_area_p50' => $data->oter_area_p50,
            'oter_area_p10' => $data->oter_area_p10,
            'oter_net_pay_p90' => $data->oter_net_pay_p90,
            'oter_net_pay_p50' => $data->oter_net_pay_p50,
            'oter_net_pay_p10' => $data->oter_net_pay_p10,
            'oter_year' => $data->oter_year,
            'oter_remark' => $data->oter_remark,
        ]);

        return $surveyId;
    }

    public function withGcf($resources)
    {
        return $resources->addSelect(
            'gcf.gcf_is_sr as src_data',
            'gcf.gcf_sr_formation as src_formation',
            'gcf.gcf_sr_formation_serie as src_formation_level',
            'gcf.gcf_sr_age_system as src_age_period',
            'gcf.gcf_sr_age_serie as src_age_epoch',
            'gcf.gcf_sr_kerogen as src_kerogen',
            'gcf.gcf_sr_toc as src_capacity',
            'gcf.gcf_sr_hfu as src_heatflow',
            'gcf.gcf_sr_distribution as src_distribution',
            'gcf.gcf_sr_continuity as src_continuity',
            'gcf.gcf_sr_maturity as src_maturity',
            'gcf.gcf_sr_otr as src_other',
            'gcf.gcf_is_res as res_data',
            'gcf.gcf_res_lithology as res_litho',
            'gcf.gcf_res_formation as res_formation',
            'gcf.gcf_res_formation_serie as res_formation_level',
            'gcf.gcf_res_age_system as res_age_period',
            'gcf.gcf_res_age_serie as res_age_epoch',
            'gcf.gcf_res_depos_env as res_dep_env',
            'gcf.gcf_res_depos_set as res_dep_set',
            'gcf.gcf_res_distribution as res_distribution',
            'gcf.gcf_res_continuity as res_continuity',
            'gcf.gcf_res_por_primary as res_primary',
            'gcf.gcf_res_por_secondary as res_second',
            'gcf.gcf_is_trap as trp_data',
            'gcf.gcf_trap_type as trp_type',
            'gcf.gcf_trap_age_system as trp_age_period',
            'gcf.gcf_trap_age_serie as trp_age_epoch',
            'gcf.gcf_trap_geometry as trp_geometry',
            'gcf.gcf_trap_seal_type as trp_seal_type',
            'gcf.gcf_trap_seal_distribution as trp_seal_distribution',
            'gcf.gcf_trap_seal_continuity as trp_seal_continuity',
            'gcf.gcf_trap_seal_age_system as trp_seal_age_period',
            'gcf.gcf_trap_seal_age_serie as trp_seal_age_epoch',
            'gcf.gcf_trap_seal_formation as trp_seal_formation',
            'gcf.gcf_trap_seal_formation_serie as trp_seal_formation_level',
            'gcf.gcf_trap_closure as trp_closure',
            'gcf.gcf_is_dyn as dyn_data',
            'gcf.gcf_dyn_migration as dyn_authenticate',
            'gcf.gcf_dyn_kitchen as dyn_kitchen',
            'gcf.gcf_dyn_petroleum as dyn_tectonic',
            'gcf.gcf_dyn_early_age_system as dyn_regime_early_period',
            'gcf.gcf_dyn_early_age_serie as dyn_regime_early_epoch',
            'gcf.gcf_dyn_late_age_system as dyn_regime_late_period',
            'gcf.gcf_dyn_late_age_serie as dyn_regime_late_epoch',
            'gcf.gcf_dyn_preservation as dyn_preservation',
            'gcf.gcf_dyn_pathways as dyn_pathway',
            'gcf.gcf_dyn_migration_age_system as dyn_age_period',
            'gcf.gcf_dyn_migration_age_serie as dyn_age_epoch'
        );
    }

    public function withProspectSurvey($resources)
    {
        return $resources->addSelect(
            'geo.sgf_p90_area as geo_area_p90',
            'geo.sgf_p50_area as geo_area_p50',
            'geo.sgf_p10_area as geo_area_p10',
            'geo.sgf_p90_net as geo_net_gross_p90',
            'geo.sgf_p50_net as geo_net_gross_p50',
            'geo.sgf_p10_net as geo_net_gross_p10',
            'geo.sgf_p90_thickness as geo_gross_sand_p90',
            'geo.sgf_p50_thickness as geo_gross_sand_p50',
            'geo.sgf_p10_thickness as geo_gross_sand_p10',
            'geo.sgf_year_survey as geo_year',
            'geo.sgf_survey_method as geo_method',
            'geo.sgf_coverage_area as geo_coverage',
            's2.s2d_vol_p90_area as s2_area_p90',
            's2.s2d_vol_p50_area as s2_area_p50',
            's2.s2d_vol_p10_area as s2_area_p10',
            's2.s2d_net_p90_thickness as s2_net_pay_p90',
            's2.s2d_net_p50_thickness as s2_net_pay_p50',
            's2.s2d_net_p10_thickness as s2_net_pay_p10',
            's2.s2d_year_survey as s2_year',
            's2.s2d_vintage_number as s2_vintage',
            's2.s2d_total_crossline as s2_crossline',
            's2.s2d_seismic_line as s2_seismic_line',
            's2.s2d_average_interval as s2_parallel',
            's2.s2d_late_method as s2_late_method',
            's2.s2d_top_depth_ft as s2_top_depth',
            's2.s2d_bot_depth_ft as s2_bot_depth',
            's2.s2d_depth_spill as s2_spill_point',
            's2.s2d_formation_thickness as s2_formation_thick',
            's2.s2d_gross_thickness as s2_gross_reservoir',
            's2.s2d_net_p50_vsh as s2_cut_vshale',
            's2.s2d_net_p50_por as s2_cut_porosity',
            's2.s2d_net_p50_satur as s2_cut_saturation',
            'grav.sgv_vol_p90_area as grav_area_p90',
            'grav.sgv_vol_p50_area as grav_area_p50',
            'grav.sgv_vol_p10_area as grav_area_p10',
            's2.s2d_net_p90_thickness as grav_net_pay_p90',
            's2.s2d_net_p50_thickness as grav_net_pay_p50',
            's2.s2d_net_p10_thickness as grav_net_pay_p10',
            'grav.sgv_year_survey as grav_year',
            'grav.sgv_survey_method as grav_method',
            'grav.sgv_coverage_area as grav_coverage',
            'grav.sgv_depth_range as grav_range',
            'grav.sgv_spacing_interval as grav_recorder',
            'grav.sgv_depth_spill as grav_spill_point',
            'grav.sgv_res_thickness as grav_formation_thick',
            'grav.sgv_res_top_depth as grav_top_seismic',
            'grav.sgv_res_bot_depth as grav_bot_seismic',
            'chem.sgc_vol_p90_area as chem_area_p90',
            'chem.sgc_vol_p50_area as chem_area_p50',
            'chem.sgc_vol_p10_area as chem_area_p10',
            's2.s2d_net_p90_thickness as chem_net_pay_p90',
            's2.s2d_net_p50_thickness as chem_net_pay_p50',
            's2.s2d_net_p10_thickness as chem_net_pay_p10',
            'chem.sgc_year_survey as chem_year',
            'chem.sgc_sample_interval as chem_interval',
            'chem.sgc_number_sample as chem_location',
            'chem.sgc_number_rock as chem_rock',
            'chem.sgc_number_fluid as chem_fluid',
            'chem.sgc_hc_composition as chem_composition',
            'elec.sel_vol_p90_area as elec_area_p90',
            'elec.sel_vol_p50_area as elec_area_p50',
            'elec.sel_vol_p10_area as elec_area_p10',
            's2.s2d_net_p90_thickness as elec_net_pay_p90',
            's2.s2d_net_p50_thickness as elec_net_pay_p50',
            's2.s2d_net_p10_thickness as elec_net_pay_p10',
            'elec.sel_year_survey as elec_year',
            'elec.sel_survey_method as elec_method',
            'elec.sel_coverage_area as elec_coverage',
            'elec.sel_depth_range as elec_range',
            'elec.sel_spacing_interval as elec_recorder',
            'resi.rst_vol_p90_area as resi_area_p90',
            'resi.rst_vol_p50_area as resi_area_p50',
            'resi.rst_vol_p10_area as resi_area_p10',
            's2.s2d_net_p90_thickness as resi_net_pay_p90',
            's2.s2d_net_p50_thickness as resi_net_pay_p50',
            's2.s2d_net_p10_thickness as resi_net_pay_p10',
            'resi.rst_year_survey as resi_year',
            'resi.rst_survey_method as resi_method',
            'resi.rst_coverage_area as resi_coverage',
            'resi.rst_depth_range as resi_range',
            'resi.rst_spacing_interval as resi_recorder',
            's3.s3d_vol_p90_area as s3_area_p90',
            's3.s3d_vol_p50_area as s3_area_p50',
            's3.s3d_vol_p10_area as s3_area_p10',
            's3.s3d_net_p90_thickness as s3_net_pay_p90',
            's3.s3d_net_p50_thickness as s3_net_pay_p50',
            's3.s3d_net_p10_thickness as s3_net_pay_p10',
            's3.s3d_year_survey as s3_year',
            's3.s3d_vintage_number as s3_vintage',
            's3.s3d_bin_size as s3_bin',
            's3.s3d_coverage_area as s3_coverage',
            's3.s3d_frequency as s3_frequency',
            's3.s3d_frequency_lateral as s3_lateral',
            's3.s3d_frequency_vertical as s3_vertical',
            's3.s3d_late_method as s3_late_method',
            's3.s3d_img_quality as s3_image',
            's3.s3d_top_depth_ft as s3_top_depth',
            's3.s3d_bot_depth_ft as s3_bot_depth',
            's3.s3d_formation_thickness as s3_formation_thick',
            's3.s3d_gross_thickness as s3_gross_reservoir',
            's3.s3d_net_p50_vsh as s3_cut_vshale',
            's3.s3d_net_p50_por as s3_cut_porosity',
            's3.s3d_net_p50_satur as s3_cut_saturation',
            'oter.sor_vol_p90_area as oter_area_p90',
            'oter.sor_vol_p50_area as oter_area_p50',
            'oter.sor_vol_p10_area as oter_area_p10',
            's2.s2d_net_p90_thickness as oter_net_pay_p90',
            's2.s2d_net_p50_thickness as oter_net_pay_p50',
            's2.s2d_net_p10_thickness as oter_net_pay_p10',
            'oter.sor_year_survey as oter_year',
            'oter.sor_remark as oter_remark'
        );
    }

    public function clasticVsCarbonate($data)
    {
        $totalClastic = $data->clastic_por_p50 + $data->clastic_sat_p50;
        $totalCarbo = $data->carbo_por_p50 + $data->carbo_sat_p50;

        if ($totalClastic >= $totalCarbo) {
            $reservoirProperty = 'Clastic';
            $grossReservoir = $data->clastic_gross_reservoir;
            $porP90 = $data->clastic_por_p90;
            $porP50 = $data->clastic_por_p50;
            $porP10 = $data->clastic_por_p10;
            $satP90 = $data->clastic_sat_p90;
            $satP50 = $data->clastic_sat_p50;
            $satP10 = $data->clastic_sat_p10;
        } elseif ($totalCarbo >= $totalClastic) {
            $reservoirProperty = 'Carbonate';
            $grossReservoir = $data->carbo_gross_reservoir;
            $porP90 = $data->carbo_por_p90;
            $porP50 = $data->carbo_por_p50;
            $porP10 = $data->carbo_por_p10;
            $satP90 = $data->carbo_sat_p90;
            $satP50 = $data->carbo_sat_p50;
            $satP10 = $data->carbo_sat_p10;
        } else {
            $reservoirProperty = 'Clastic';
            $grossReservoir = $data->clastic_gross_reservoir;
            $porP90 = $data->clastic_por_p90;
            $porP50 = $data->clastic_por_p50;
            $porP10 = $data->clastic_por_p10;
            $satP90 = $data->clastic_sat_p90;
            $satP50 = $data->clastic_sat_p50;
            $satP10 = $data->clastic_sat_p10;
        }

        return [
            'property' => $reservoirProperty,
            'grossReservoir' => $grossReservoir,
            'porP90' => $porP90,
            'porP50' => $porP50,
            'porP10' => $porP10,
            'satP90' => $satP90,
            'satP50' => $satP50,
            'satP10' => $satP10,
        ];
    }

    public function nameCleaner($name)
    {
        $name = trim(strtoupper($name));
        $name = str_replace('#', '', $name);
        $name = str_replace('_', '-', $name);
        $name = str_replace(' - ', '-', $name);

        return $name;
    }
}
