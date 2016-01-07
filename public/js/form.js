function updateGcf(gcfUrl, id) {
  $.ajax({
    url: gcfUrl,
    data: {play_id: id},
    type: 'POST',
    dataType: 'json',
    success: function(r) {
      $("#gcf_is_sr").val(r.gcf_is_sr);
      $("#gcf_sr_age_system").val(r.gcf_sr_age_system);
      $("#gcf_sr_age_serie").val(r.gcf_sr_age_serie);
      $("#gcf_sr_formation").val(r.gcf_sr_formation);
      $("#gcf_sr_formation_serie").val(r.gcf_sr_formation_serie);
      $("#gcf_sr_kerogen").val(r.gcf_sr_kerogen);
      $("#gcf_sr_toc").val(r.gcf_sr_toc);
      $("#gcf_sr_hfu").val(r.gcf_sr_hfu);
      $("#gcf_sr_distribution").val(r.gcf_sr_distribution);
      $("#gcf_sr_continuity").val(r.gcf_sr_continuity);
      $("#gcf_sr_maturity").val(r.gcf_sr_maturity);
      $("#gcf_sr_otr").val(r.gcf_sr_otr);

      $("#gcf_is_res").val(r.gcf_is_res);
      $("#gcf_res_distribution").val(r.gcf_res_distribution);
      $("#gcf_res_continuity").val(r.gcf_res_continuity);
      $("#gcf_res_age_system").val(r.gcf_res_age_system);
      $("#gcf_res_age_serie").val(r.gcf_res_age_serie);
      $("#gcf_res_formation").val(r.gcf_res_formation);
      $("#gcf_res_formation_serie").val(r.gcf_res_formation_serie);
      $("#gcf_res_lithology").val(r.gcf_res_lithology);
      $("#gcf_res_depos_env").val(r.gcf_res_depos_env);
      $("#gcf_res_depos_set").val(r.gcf_res_depos_set);
      $("#gcf_res_por_primary").val(r.gcf_res_por_primary);
      $("#gcf_res_por_secondary").val(r.gcf_res_por_secondary);

      $("#gcf_is_trap").val(r.gcf_is_trap);
      $("#gcf_trap_type").val(r.gcf_trap_type);
      $("#gcf_trap_age_system").val(r.gcf_trap_age_system);
      $("#gcf_trap_age_serie").val(r.gcf_trap_age_serie);
      $("#gcf_trap_geometry").val(r.gcf_trap_geometry);
      $("#gcf_trap_closure").val(r.gcf_trap_closure);
      $("#gcf_trap_seal_age_system").val(r.gcf_trap_seal_age_system);
      $("#gcf_trap_seal_age_serie").val(r.gcf_trap_seal_age_serie);
      $("#gcf_trap_seal_formation").val(r.gcf_trap_seal_formation);
      $("#gcf_trap_seal_formation_serie").val(r.gcf_trap_seal_formation_serie);
      $("#gcf_trap_seal_distribution").val(r.gcf_trap_seal_distribution);
      $("#gcf_trap_seal_continuity").val(r.gcf_trap_seal_continuity);
      $("#gcf_trap_seal_type").val(r.gcf_trap_seal_type);

      $("#gcf_is_dyn").val(r.gcf_is_dyn);
      $("#gcf_dyn_migration").val(r.gcf_dyn_migration);
      $("#gcf_dyn_kitchen").val(r.gcf_dyn_kitchen);
      $("#gcf_dyn_petroleum").val(r.gcf_dyn_petroleum);
      $("#gcf_dyn_early_age_system").val(r.gcf_dyn_early_age_system);
      $("#gcf_dyn_early_age_serie").val(r.gcf_dyn_early_age_serie);
      $("#gcf_dyn_late_age_system").val(r.gcf_dyn_late_age_system);
      $("#gcf_dyn_late_age_serie").val(r.gcf_dyn_late_age_serie);
      $("#gcf_dyn_preservation").val(r.gcf_dyn_preservation);
      $("#gcf_dyn_pathways").val(r.gcf_dyn_pathways);
      $("#gcf_dyn_migration_age_system").val(r.gcf_dyn_migration_age_system);
      $("#gcf_dyn_migration_age_serie").val(r.gcf_dyn_migration_age_serie);
    },
  });
}

// Survey toggle
$('#s3-cb').click(function() {
  $('#s3-form').toggleClass('hidden');
});

$('#s2-cb').click(function() {
  $('#s2-form').toggleClass('hidden');
});

$('#geological-cb').click(function() {
  $('#geological-form').toggleClass('hidden');
});

$('#gravity-cb').click(function() {
  $('#gravity-form').toggleClass('hidden');
});

$('#electromagnetic-cb').click(function() {
  $('#electromagnetic-form').toggleClass('hidden');
});

$('#resistivity-cb').click(function() {
  $('#resistivity-form').toggleClass('hidden');
});

$('#geochemistry-cb').click(function() {
  $('#geochemistry-form').toggleClass('hidden');
});

$('#other-cb').click(function() {
  $('#other-form').toggleClass('hidden');
});

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