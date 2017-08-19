<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	
	<!-- Website Title -->
	<title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>
	
	<!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+-->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta property="og:type" content="article" />
	
	<!-- SEO Meta Tags -->
	<meta name="description" content="<?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?>">
	<meta name="keywords" content="Sanur Guesthouse, sanur, guesthouse, villa, cottage,  lodge, guest house, tourism, booking, bali">
	
	<!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700i" rel="stylesheet">
	<link href="<?php echo $this->common->theme_link(); ?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $this->common->theme_link(); ?>css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo $this->common->theme_link(); ?>css/swiper.css" rel="stylesheet">
	<link href="<?php echo $this->common->theme_link(); ?>css/magnific-popup.css" rel="stylesheet">
	<link href="<?php echo $this->common->theme_link(); ?>css/bootstrap-datepicker3.css" rel="stylesheet">
	<link href="<?php echo $this->common->theme_link(); ?>css/styles.css" rel="stylesheet">
	<link href="<?php echo $this->common->theme_link(); ?>css/custom.css" rel="stylesheet">
	
	<!-- Favicon  -->
    <link rel="icon" href="<?php echo $this->common->theme_link(); ?>images/favicon.png">
	
	<?php echo $cssincludes; ?>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>
<body data-spy="scroll" data-target=".navbar-fixed-top">
	
	<!-- Preloader -->
	<div class="spinner-wrapper">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
	
	<?php  echo $content;?>

	
	<!-- FOOTER -->
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4 footer-section">
					<h3>About Villa</h3>
					<p>Villa is a unique bed & breakfast tourism facility situated on the magnificent Mediterranean sea shores. Come and visit us!</p>
				</div>
				<div class="col-md-4 footer-section">
					<h3>Important Links</h3>
					<p><a class="inverse" href="#insert-link">Local Authorities</a>, <a class="inverse" href="#insert-link">First Aid Hospital</a>, <a class="inverse" href="#insert-link">Train Station</a>, <a class="inverse" href="#insert-link">Bus Schedule</a>, <a class="inverse" href="#insert-link">Shuttle Company</a>, <a class="inverse" href="#insert-link">Auto Help</a>, <a class="inverse" href="#insert-link">Car Rental</a>, <a class="inverse" href="#insert-link">Bicycle Rides</a>, <a class="inverse" href="#insert-link">Extreme Tours</a></p>
				</div>
				<div class="col-md-4 footer-section">
					<h3 class="last">Follow Us On</h3>
					<div class="social-icons-container">
						<a href="#your-link"><i class="fa fa-facebook fa-lg circle-icon"></i></a>
						<a href="#your-link"><i class="fa fa-twitter  circle-icon"></i></a>
						<a href="#your-link"><i class="fa fa-instagram  circle-icon"></i></a>
						<a href="#your-link"><i class="fa fa-pinterest  circle-icon"></i></a>
						<a href="#your-link"><i class="fa fa-linkedin  circle-icon"></i></a>
						<a href="#your-link"><i class="fa fa-google-plus  circle-icon"></i></a>
					</div>
				</div>
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of footer -->
	
	
	<!-- COPYRIGHT -->
	<div id="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p><script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></p>
				</div> 
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of copyright -->
			
	
	<!-- SCRIPTS -->
	<script src="<?php echo $this->common->theme_link(); ?>js/jquery-2.2.4.min.js" type="text/javascript"></script> <!-- jQuery v2.2.4 - necessary for Bootstrap's JavaScript plugins -->
	<script src="<?php echo $this->common->theme_link(); ?>js/bootstrap.min.js" type="text/javascript"></script> <!-- Bootstrap v3.3.7 -->
	<script src="<?php echo $this->common->theme_link(); ?>js/jquery.easing.min.js" type="text/javascript"></script> <!-- jQuery Easing v1.3 for smooth scrolling between anchors-->
	<script src="<?php echo $this->common->theme_link(); ?>js/swiper.min.js" type="text/javascript"></script> <!-- Swiper v3.4.2 for image gallery slider -->
	<script src="<?php echo $this->common->theme_link(); ?>js/jquery.magnific-popup.js" type="text/javascript"></script> <!-- Magnific Popup v1.1.0 for lightboxes -->
	<script src="<?php echo $this->common->theme_link(); ?>js/bootstrap-datepicker.min.js" type="text/javascript"></script> <!-- Datepicker for Bootstrap v1.6.4 -->
	<script src="<?php echo $this->common->theme_link(); ?>js/validator.min.js" type="text/javascript"></script> <!--  Validator.js v0.11.8 Bootstrap plugin that validates the registration form -->
	<script src="<?php echo $this->common->theme_link(); ?>js/scripts.js" type="text/javascript"></script> <!-- Custom scripts -->
	<?php echo $jsincludes;?>
</body>

<!-- Mirrored from inovatik.com/villa-bed-and-breakfast-landing-page/04-sliding-header/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Aug 2017 20:54:05 GMT -->
</html>