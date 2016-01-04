$(document).ready(function() {
    $("#devPlaySampleInput").on("click", function() {
        $("[name=basin_name]").val("Barito");
        $("[name=province_name]").val("Papua");
        $("[name=analog_to]").val("Discovery");
        $("[name=analog_distance]").val("0 - 3");
        $("[name=shore]").val("Onshore");
        $("[name=terrain]").val("Jungle");
        $("[name=nearby_field]").val("< 5");
        $("[name=nearby_infra]").val("< 50");
        $("[name=remark]").val("This is remark of super play");
        $("[name=s2_year]").val("2009,2012");
        $("[name=s2_crossline]").val("100");
        $("[name=s2_line_distance]").val("1");
        $("[name=chem_sample]").val("1000");
        $("[name=chem_depth]").val("100");
        $("[name=grav_acreage]").val("1000");
        $("[name=grav_depth]").val("100");
        $("[name=resi_acreage]").val("100");

        gcfTest('play');
    });

    $("#devLeadSampleInput").on("click", function() {
        $("#structure_name").val("Test Structure");
        $("#closure_name").val("Test Closure");
        $("#center_lat_degree").val('1');
        $("#center_lat_minute").val('59');
        $("#center_lat_second").val('59');
        $("#center_lat_direction").val('S');
        $("#center_long_degree").val('90');
        $("#center_long_minute").val('59');
        $("#center_long_second").val('59');
        $("#lead_clarified").val('Join Study');
        $("#lead_shore").val('Onshore');
        $("#lead_terrain").val('Farmland');
        $("#lead_near_field").val('< 5');
        $("#lead_near_infra_structure").val('< 50');
        $("#lead_remark").val('Remark at its best');

        $("#s2-cb").prop('checked', true);
        $("#geological-cb").prop('checked', true);
        $("#gravity-cb").prop('checked', true);
        $("#electromagnetic-cb").prop('checked', true);
        $("#resistivity-cb").prop('checked', true);
        $("#geochemistry-cb").prop('checked', true);
        $("#other-cb").prop('checked', true);
        $('#s2-form').toggleClass('hidden');
        $('#geological-form').toggleClass('hidden');
        $('#gravity-form').toggleClass('hidden');
        $('#electromagnetic-form').toggleClass('hidden');
        $('#resistivity-form').toggleClass('hidden');
        $('#geochemistry-form').toggleClass('hidden');
        $('#other-form').toggleClass('hidden');

        // Seismic
        $("#ls2d_low_estimate").val('50');
        $("#ls2d_best_estimate").val('100');
        $("#ls2d_high_estimate").val('150');
        $("#ls2d_year_survey").val('2010, 2012');
        $("#ls2d_vintage_number").val('Multiple');
        $("#ls2d_total_crossline").val('5');
        $("#ls2d_total_coverage").val('10000');
        $("#ls2d_average_interval").val('23');
        $("#ls2d_late_method").val('PSTM');
        $("#ls2d_img_quality").val('Good');

        // Geological field
        $("#lsgf_low_estimate").val('50');
        $("#lsgf_best_estimate").val('100');
        $("#lsgf_high_estimate").val('150');
        $("#lsgf_year_survey").val('2010, 2012');
        $("#lsgf_survey_method").val('Stream Sampling');
        $("#lsgf_coverage_area").val('200');

        // Gravity
        $("#lsgv_low_estimate").val('50');
        $("#lsgv_best_estimate").val('100');
        $("#lsgv_high_estimate").val('150');
        $("#lsgv_year_survey").val('2010, 2012');
        $("#lsgv_survey_method").val('Airbornes');
        $("#lsgv_coverage_area").val('4000');
        $("#lsgv_range_penetration").val('300');
        $("#lsgv_spacing_interval").val('30');

        // Electromagnetic
        $("#lsel_low_estimate").val('50');
        $("#lsel_best_estimate").val('100');
        $("#lsel_high_estimate").val('150');
        $("#lsel_year_survey").val('2010, 2012');
        $("#lsel_survey_method").val('Airbornes');
        $("#lsel_coverage_area").val('4000');
        $("#lsel_range_penetration").val('300');
        $("#lsel_spacing_interval").val('30');

        // Resistivity
        $("#lsrt_low_estimate").val('50');
        $("#lsrt_best_estimate").val('100');
        $("#lsrt_high_estimate").val('150');
        $("#lsrt_year_survey").val('2010, 2012');
        $("#lsrt_survey_method").val('Airbornes');
        $("#lsrt_coverage_area").val('4000');
        $("#lsrt_range_penetration").val('300');
        $("#lsrt_spacing_interval").val('30');

        // Geochemistry
        $("#lsgc_low_estimate").val('50');
        $("#lsgc_best_estimate").val('100');
        $("#lsgc_high_estimate").val('150');
        $("#lsgc_year_survey").val('2010, 2012');
        $("#lsgc_range_interval").val('5');
        $("#lsgc_number_rock").val('49');
        $("#lsgc_number_fluid").val('42');
        $("#lsgc_hc_composition").val('NaCL');

        // Other
        $("#lsor_low_estimate").val('50');
        $("#lsor_best_estimate").val('100');
        $("#lsor_high_estimate").val('150');
        $("#lsor_year_survey").val('2010, 2012');
        $("#lsor_remark").val('Perhaps, this is 3D');

        gcfTest('lead');
    });

    function gcfTest(classification) {
        $("[name=src_data]").val("Proven");
        $("[name=src_age_period]").val("Cambrian");
        $("[name=src_age_epoch]").val("Early");
        $("[name=src_formation]").val("Baturaja");
        $("[name=src_formation_level]").val("Lower");
        $("[name=src_kerogen]").val("I/II");
        $("[name=src_toc]").val("> 4");
        $("[name=src_hfu]").val("> 3.0");
        $("[name=src_distribution]").val("Localized");
        $("[name=src_continuity]").val("Bad");
        $("[name=src_maturity]").val("Overmature");
        $("[name=src_other]").val("Yes");

        $("[name=res_data]").val("Proven");
        $("[name=res_distribution]").val("Single Distribution");
        $("[name=res_continuity]").val("Tank");
        $("[name=res_dep_set]").val("Paralic");
        $("[name=res_primary]").val("0 - 10");
        $("[name=res_second]").val("Vugs Porosity");

        $("[name=trp_data]").val("Proven");
        $("[name=trp_age_period]").val("Miocene");
        $("[name=trp_age_epoch]").val("Late");
        $("[name=trp_geometry]").val("Horst Simple");
        $("[name=trp_closure]").val("2-Way");
        $("[name=trp_seal_age_period]").val("Miocene");
        $("[name=trp_seal_age_epoch]").val("Late");
        $("[name=trp_seal_formation]").val("Talangakar");
        $("[name=trp_seal_formation_level]").val("Lower");
        $("[name=trp_seal_distribution]").val("Single Distribution Impermeable Rocks");
        $("[name=trp_seal_continuity]").val("Truncated");
        $("[name=trp_seal_type]").val("Primary");

        $("[name=dyn_data]").val("Proven");
        $("[name=dyn_authenticate]").val("Oil Seep");
        $("[name=dyn_kitchen]").val("Near (2 - 5 Km)");
        $("[name=dyn_tectonic]").val("Single Order");
        $("[name=dyn_regime_early_period]").val("Miocene");
        $("[name=dyn_regime_early_epoch]").val("Late");
        $("[name=dyn_regime_late_period]").val("Miocene");
        $("[name=dyn_regime_late_epoch]").val("Late");
        $("[name=dyn_preservation]").val("Occur");
        $("[name=dyn_pathway]").val("Vertical");
        $("[name=dyn_age_period]").val("Holocene");
        $("[name=dyn_age_epoch]").val("Late");

        if (classification === 'play') {
            $("[name=res_age_period").val("Cambrian");
            $("[name=res_age_epoch").val("Early");
            $("[name=res_formation").val("Baturaja");
            $("[name=res_formation_level").val("Lower");
            $("[name=res_litho").val("Sandstone");
            $("[name=res_dep_env").val("Ridge");
            $("[name=trp_type").val("Structural Drape");
        }
    }
});