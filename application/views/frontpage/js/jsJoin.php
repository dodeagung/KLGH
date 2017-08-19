<?php
	$plugin_url = base_url()."theme_costume/";
?>



<script>

$(document).ready(function() {
	$('.daftar').submit(function() {
		alert ("ok!");
		
	});	

	var $container = $("html,body");
	var $scrollTo = $('.register-form');

	$container.animate({scrollTop: $scrollTo.offset().top - $container.offset().top + $container.scrollTop()-100, scrollLeft: 0},300);
	
	$('select#dos').on('change', function() {
		$(".priceamount").text( $('option:selected', this).data( "factor" ));

		var text = $('option:selected', this).text();
		var arr = text.split('-');
		$(".duration_value").text($.trim(arr[0]));
		
	});	
	
	$('select#payment_method').on('change', function() {
		if(this.value == "paypal"){
			//alert($("input#emailpaypal").val()  );
			if( $("input#emailpaypal").val() == $("input#emailpaypal").attr("placeholder")){
				alert("please fill out the paypal email account!");
			}
		}
		
	});
	


	
})


</script>
