<!-- REVOLUTION JS FILES -->
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/jquery.themepunch.revolution.min.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS
(Load Extensions only on Local File Systems !
The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>js/revolution/revolution.extension.video.min.js"></script>

<!-- CUSTOM REVOLUTION JS FILES -->
<script>
jQuery(document).ready(function() {
  jQuery("#rev-slider").revolution({
    sliderType:"standard",
    sliderLayout:"auto",
    delay:9000,
          responsiveLevels:[1240,1025,920,767],
    navigation: {
      keyboardNavigation: "on",
      keyboard_direction: "horizontal",
      mouseScrollNavigation: "off",
      onHoverStop: "off",
      touch: {
        touchenabled: "on",
        swipe_threshold: 75,
        swipe_min_touches: 1,
        swipe_direction: "horizontal",
        drag_block_vertical: false
      },
      arrows: {
        style: "hephaistos",
        enable: true,
        hide_onmobile: false,
        hide_onleave: false,
        tmp: '',
        left: {
          h_align: "left",
          v_align: "center",
          h_offset: 30,
          v_offset: 0
        },
        right: {
          h_align: "right",
          v_align: "center",
          h_offset: 30,
          v_offset: 0
        }
      },
      bullets: {
        enable: false,
        hide_onmobile: false,
        style: "hephaistos",
        hide_onleave: false,
        direction: "horizontal",
        h_align: "center",
        v_align: "bottom",
        h_offset: 20,
        v_offset: 30,
        space: 5,
        tmp: ''
      }
    },
    gridwidth:1230,
    gridheight:650
  });
});
</script>

<!-- parallax -->
<script src="<?php echo $this->common->theme_link(); ?>js/parallax/jquery.parallax-1.1.3.js"></script>
<script src="<?php echo $this->common->theme_link(); ?>js/parallax/setting.js"></script>

  <!-- owl carousel -->
<script src="<?php echo $this->common->theme_link(); ?>js/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo $this->common->theme_link(); ?>js/owlcarousel/setting.js"></script>

  <!-- PrettyPhoto -->
<script src="<?php echo $this->common->theme_link(); ?>js/prettyPhoto/jquery.prettyPhoto.js"></script>
<script src="<?php echo $this->common->theme_link(); ?>js/prettyPhoto/setting.js"></script>

  <!-- masonry -->
<script src="<?php echo $this->common->theme_link(); ?>js/masonry/masonry.min.js"></script>
<script src="<?php echo $this->common->theme_link(); ?>js/masonry/masonry.filter.js"></script>
<script src="<?php echo $this->common->theme_link(); ?>js/masonry/setting.js"></script>
