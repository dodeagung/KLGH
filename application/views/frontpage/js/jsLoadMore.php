<?php
	$plugin_url = base_url()."theme_costume/";
?>

<script>

$(document).ready(function(){
	$('#load-more').on('click',function(){
		$.ajax({
			type:'GET',
			dataType: "json",
			url:"<?php echo site_url("signal/loadmoredata");?>",
			data:{
			  offset :$('#offset').val(),
			  limit :$('#limit').val()
			},
			success:function(data){
				$( ".entry-date-bottom" ).before(data.view).hide().fadeIn(2000);
				$('#offset').val(data.offset);
				$('#limit').val(data.limit);
				if($(".hover-direction").length != 0) {
					$('.portfolio-item').directionalHover();
				}
				
				if (data.isnext == false){
					$( "#showmore" ).hide();
				}
				$('.popup-gallery').magnificPopup({
					delegate: 'a.portfolio-img',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					mainClass: 'mfp-img-mobile',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							return item.el.attr('title');
							
							
						}
					}
				});
			}
		});
	});
});
</script>
