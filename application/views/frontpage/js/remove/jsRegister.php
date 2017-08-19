<?php
	$plugin_url = base_url()."theme_costume/";
?>

<script src="<?php echo $plugin_url; ?>plugin/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js"></script>


<script>

$(document).ready(function() {


	$('#dob').datepicker({
			format: 'dd/mm/yyyy',
			   autoclose: true
			});

	$('input').iCheck({
	   checkboxClass: 'icheckbox_square-blue',
	   radioClass: 'iradio_square-blue'
	 });

	  $("#apply_online").validate({
			ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input'
 		});

	
})


</script>
