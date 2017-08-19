<?php
	$plugin_url = base_url()."theme_costume/";
?>
<!-- GOOGLE map -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0yNE8aOxZfRd247dSVXFKhxluxlBrRSY"></script>
<script type="text/javascript" src="<?php echo $plugin_url; ?>js/mapmarker.jquery.js"></script>
<script type="text/javascript" src="<?php echo $plugin_url; ?>js/mapmarker_func.jquery.js"></script>

<!-- Date and time pickers -->
<script src="<?php echo $plugin_url; ?>js/bootstrap-datepicker.js"></script>
<script src="<?php echo $plugin_url; ?>js/bootstrap-timepicker.js"></script>
<script>
$(document).ready(function() {
	$('input.date-pick').datepicker();
  $('input.time-pick').timepicker({
    minuteStep: 15,
    showInpunts: false
	});
	
});


</script>
