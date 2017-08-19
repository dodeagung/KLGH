<?php
	$plugin_url = base_url()."theme_costume/";
?>
<!-- Specific scripts -->
<script src="<?php echo $plugin_url; ?>layerslider/js/greensock.js"></script>
 <script src="<?php echo $plugin_url; ?>layerslider/js/layerslider.transitions.js"></script>
<script src="<?php echo $plugin_url; ?>layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
<script src="<?php echo $plugin_url; ?>js/tabs.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
		"use strict";
     $("#layerslider").layerSlider({
            autoStart: true,
						responsive: true,
						responsiveUnder: 1280,
						layersContainer: 1170,
            skinsPath: "<?php echo $plugin_url; ?>layerslider/skins/"
            // Please make sure that you didn"t forget to add a comma to the line endings
            // except the last line!
        });
			new CBPFWTabs( document.getElementById( "tabs" ) );
    });
</script>
