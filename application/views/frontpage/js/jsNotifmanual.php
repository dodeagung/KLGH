<?php
	$plugin_url = base_url()."theme_costume/";
?>

<script type="text/javascript" src="<?php echo $plugin_url; ?>addons/dropzone-4.3.0/dist/dropzone.js"></script>
<script src="<?php echo $plugin_url; ?>addons/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js"></script>
<script>
jQuery(document).ready(function() {
	jQuery('#date_transfer').datepicker({
			format: 'dd/mm/yyyy',
			   autoclose: true
			});
	
	
})


</script>
