function updateGcf(data) {
  $("[name='gcf[src_data]']").val(data.gcf.src_data);
  $("[name='gcf[src_formation]']").val(data.gcf.src_formation);
  $("[name='gcf[src_formation_level]']").val(data.gcf.src_formation_level);
  $("[name='gcf[src_age_period]']").val(data.gcf.src_age_period);
  $("[name='gcf[src_age_epoch]']").val(data.gcf.src_age_epoch);
  $("[name='gcf[src_kerogen]']").val(data.gcf.src_kerogen);
  $("[name='gcf[src_capacity]']").val(data.gcf.src_capacity);
  $("[name='gcf[src_heatflow]']").val(data.gcf.src_heatflow);
  $("[name='gcf[src_distribution]']").val(data.gcf.src_distribution);
  $("[name='gcf[src_continuity]']").val(data.gcf.src_continuity);
  $("[name='gcf[src_maturity]']").val(data.gcf.src_maturity);
  $("[name='gcf[src_other]']").val(data.gcf.src_other);
  $("[name='gcf[res_data]']").val(data.gcf.res_data);
  $("[name='gcf[res_litho]']").val(data.gcf.res_litho);
  $("[name='gcf[res_formation]']").val(data.gcf.res_formation);
  $("[name='gcf[res_formation_level]']").val(data.gcf.res_formation_level);
  $("[name='gcf[res_age_period]']").val(data.gcf.res_age_period);
  $("[name='gcf[res_age_epoch]']").val(data.gcf.res_age_epoch);
  $("[name='gcf[res_dep_env]']").val(data.gcf.res_dep_env);
  $("[name='gcf[res_dep_set]']").val(data.gcf.res_dep_set);
  $("[name='gcf[res_distribution]']").val(data.gcf.res_distribution);
  $("[name='gcf[res_continuity]']").val(data.gcf.res_continuity);
  $("[name='gcf[res_primary]']").val(data.gcf.res_primary);
  $("[name='gcf[res_second]']").val(data.gcf.res_second);
  $("[name='gcf[trp_data]']").val(data.gcf.trp_data);
  $("[name='gcf[trp_type]']").val(data.gcf.trp_type);
  $("[name='gcf[trp_age_period]']").val(data.gcf.trp_age_period);
  $("[name='gcf[trp_age_epoch]']").val(data.gcf.trp_age_epoch);
  $("[name='gcf[trp_geometry]']").val(data.gcf.trp_geometry);
  $("[name='gcf[trp_seal_type]']").val(data.gcf.trp_seal_type);
  $("[name='gcf[trp_seal_distribution]']").val(data.gcf.trp_seal_distribution);
  $("[name='gcf[trp_seal_continuity]']").val(data.gcf.trp_seal_continuity);
  $("[name='gcf[trp_seal_age_period]']").val(data.gcf.trp_seal_age_period);
  $("[name='gcf[trp_seal_age_epoch]']").val(data.gcf.trp_seal_age_epoch);
  $("[name='gcf[trp_seal_formation]']").val(data.gcf.trp_seal_formation);
  $("[name='gcf[trp_seal_formation_level]']").val(data.gcf.trp_seal_formation_level);
  $("[name='gcf[trp_closure]']").val(data.gcf.trp_closure);
  $("[name='gcf[dyn_data]']").val(data.gcf.dyn_data);
  $("[name='gcf[dyn_authenticate]']").val(data.gcf.dyn_authenticate);
  $("[name='gcf[dyn_kitchen]']").val(data.gcf.dyn_kitchen);
  $("[name='gcf[dyn_tectonic]']").val(data.gcf.dyn_tectonic);
  $("[name='gcf[dyn_regime_early_period]']").val(data.gcf.dyn_regime_early_period);
  $("[name='gcf[dyn_regime_early_epoch]']").val(data.gcf.dyn_regime_early_epoch);
  $("[name='gcf[dyn_regime_late_period]']").val(data.gcf.dyn_regime_late_period);
  $("[name='gcf[dyn_regime_late_epoch]']").val(data.gcf.dyn_regime_late_epoch);
  $("[name='gcf[dyn_preservation]']").val(data.gcf.dyn_preservation);
  $("[name='gcf[dyn_pathway]']").val(data.gcf.dyn_pathway);
  $("[name='gcf[dyn_age_period]']").val(data.gcf.dyn_age_period);
  $("[name='gcf[dyn_age_epoch]']").val(data.gcf.dyn_age_epoch);
}

// Disable enter key, sehingga tidak ada lagi kecelakaan
// dalam menekan enter.
$('#form-main').on('keyup keypress', function(e) {
  var code = e.keyCode || e.which;
  if (code == 13 && e.target.nodeName != 'TEXTAREA') {
    e.preventDefault();
    return false;
  }
});

// Disable button submit, pada saat KKKS submit isiannya.
$('#form-main').submit(function() {
  $('#submit-button').prop('disabled', true);
})