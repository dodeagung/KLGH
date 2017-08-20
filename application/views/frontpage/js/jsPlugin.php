<?php
$plugin_url = base_url()."theme_costume/plugin/";
?>

<script src="<?=$plugin_url; ?>owl-carousel/owl.carousel.js"></script>


<script>
	$( document ).ready(function() {
		$('.video_pop').magnificPopup({type:'iframe'});	/* video modal*/
	

    GalleryRoomDetail();
    function GalleryRoomDetail() {

        if($('.room-detail_img').length ) {

            $(".room-detail_img").owlCarousel({
                navigation : true,
                pagination: false,
                navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                singleItem: true,
                mouseDrag:false,
                transitionStyle:'fade'
            });
        }

        if($('.room-detail_thumbs').length ) {

            $(".room-detail_thumbs").owlCarousel({
                items: 7,
                pagination: false,
                navigation : true,
                mouseDrag:false,
                navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                itemsCustom:[[0,3], [320,4], [480,5], [768,6], [992,7], [1200,7]]
            });

            if( $(".room-detail_img").data("owlCarousel") !== undefined && $(".room-detail_thumbs").data("owlCarousel") !== undefined ) {
                $('.room-detail_thumbs').on('click','.owl-item',function(event) {

                    var $this= $(this),
                        index = $this.index();
                    $('.room-detail_thumbs').find('.active').removeClass('active');
                    $this.addClass('active');
                    $(".room-detail_img").data("owlCarousel").goTo(index);

                    return false;
                });
            }
        }
    }


	});
</script>
