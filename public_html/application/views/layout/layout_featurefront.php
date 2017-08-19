
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="keywords" content="Kampus Pariwisata, Kampus bosssignalfx, cruiseline & Hotel Training Center Bali ">
    <meta name="description" content="Kampus Politeknik Nasional Denpasar, Bali">
  <!--  <meta name="author" content="nce18cex"> -->
    <link rel="icon" href="<?php echo $this->common->theme_link(); ?>ico/favicon.png">

    <title>Politeknik Negeri Nasional (bosssignalfx) Bali</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->common->theme_link(); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo $this->common->theme_link(); ?>css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $this->common->theme_link(); ?>css/style.css" rel="stylesheet">

    <!-- Theme skins -->
    <link id="skin" href="<?php echo $this->common->theme_link(); ?>skins/blue.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo $this->common->theme_link(); ?>js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

    <!--[if IE 9]>
      <link href="css/ie.css" rel="stylesheet">
    <![endif]-->
		<?php echo $cssincludes; ?>
  </head>

  <body>
	<!-- Start top area
	<div class="top-container">
		<div class="container">
			<div class="row">
				<div class="top-column-left">
					<ul class="contact-line">
						<li><i class="fa fa-envelope"></i> info@yourdomain.com</li>
						<li><i class="fa fa-phone"></i> (0021)-123-456-789-90</li>
					</ul>
				</div>
				<div class="top-column-right">
					<div class="top-social-network">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
					</div>
					<ul class="register">
						<li><a href="#">Login</a></li>
						<li><a href="#">Register</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	 End top area -->

	<div class="clearfix"></div>

    <!-- Start Navbar -->
	<nav class="navbar navbar-default navbar-dark megamenu">

        <div class="container">

			<!-- Start navbar right
			<div class="navlink-right">
				<div class="dropdown shopping-cart">
					<button class="btn-navlink" type="button" data-toggle="dropdown">
						<i class="fa fa-shopping-basket"></i><span class="cart-item">3</span>
					</button>
					<div class="dropdown-menu cart-dropdown">
						<ul class="cart-list">
							<li>
								<a href="#"><img src="img/product/thumbs//thumb01.jpg" class="cart-thumb" alt="" /></a>
								<h6><a href="#">Delica omittantur</a></h6>
								2x - <span class="price">$99.99</span>
							</li>
							<li>
								<a href="#"><img src="img/product/thumbs//thumb02.jpg" class="cart-thumb" alt="" /></a>
								<h6><a href="#">Omnes ocurreret</a></h6>
								1x - <span class="price">$33.33</span>
							</li>
							<li>
								<a href="#"><img src="img/product/thumbs//thumb03.jpg" class="cart-thumb" alt="" /></a>
								<h6><a href="#">Agam facilisis</a></h6>
								2x - <span class="price">$99.99</span>
							</li>
						</ul>
						<div class="clearfix"></div>
						<a href="shopping-cart.html" class="btn btn-bordered btn-block btn-sm">View cart</a>
						<a href="shopping-checkout.html" class="btn btn-primary btn-block btn-sm">Checkout</a>
					</div>
				</div>
				<button class="btn-navlink show-form"><i class="fa fa-search"></i></button>
				<button class="btn-navlink close-form"><i class="fa fa-remove"></i></button>
			</div>
			End navbar right -->

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html"><img src="<?php echo $this->common->theme_link(); ?>img/logo.png" alt="" /></a>
            </div>

			<!-- Start Form Search
			<div class="search-wrapper animated">
				<input type="text" class="form-search" placeholder="Type something and hit enter...">
			</div>
			 End Form Search -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li class="<?php if(isset($activeLink['home'])) echo "active"; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="dropdown <?php if(isset($activeLink['prodi']['all'])) echo "active"; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Program Profesional</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown <?php if(isset($activeLink['prodi']['d1'])) echo "active"; ?>">
                                <a href="<?php echo base_url()."home/prodi1" ?>" class="dropdown-toggle" data-toggle="dropdown">Basic Level (1 Year)</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url()."home/prodi1" ?>">Food & Beverage Service</a></li>
                                    <li><a href="<?php echo base_url()."home/prodi1" ?>">Culinary</a></li>
                                    <li><a href="<?php echo base_url()."home/prodi1" ?>">Housekeeping</a></li>
                                    <li><a href="<?php echo base_url()."home/prodi1" ?>">Front Office</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if(isset($activeLink['prodi']['d2'])) echo "active"; ?>">
                                <a href="<?php echo base_url()."home/prodi2" ?>" class="dropdown-toggle" data-toggle="dropdown">Middle Level (2 Years)</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url()."home/prodi2" ?>">Food And Beverage Management</a></li>
                                    <li><a href="<?php echo base_url()."home/prodi2" ?>">Room Division Management</a></li>
                                </ul>
                            </li>
                            <li class="<?php if(isset($activeLink['prodi']['d3'])) echo "active"; ?>"><a href="<?php echo base_url()."home/prodi3" ?>">Upper Level (3 Years)</a></li>

                        </ul>
                    </li>

                    <li class="<?php if(isset($activeLink['cruiseline'])) echo "active"; ?>"><a href="<?php echo base_url()."home/cruiseline" ?>">Cruiseline</a></li>
                    <li class="<?php if(isset($activeLink['pendaftaran'])) echo "active"; ?>"><a href="<?php echo base_url()."home/registrasi" ?>">Pendaftaran</a></li>
                    <li class="dropdown <?php if(isset($activeLink['about']['all'])) echo "active"; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >About</a>
                        <ul class="dropdown-menu">
                            <li class="<?php if(isset($activeLink['about']['facility'])) echo "active"; ?>"><a href="<?php echo base_url()."home/facility" ?>">Fasilitas</a></li>
                            <li class="<?php if(isset($activeLink['about']['desc'])) echo "active"; ?>"><a href="<?php echo base_url()."home/about" ?>">Tentang Kami</a></li>
                            <li class="<?php if(isset($activeLink['about']['news'])) echo "active"; ?>"><a href="<?php echo base_url()."home/news" ?>">News</a></li>

                        </ul>
                    </li>
                    <li class="<?php if(isset($activeLink['map'])) echo "active"; ?>"><a href="<?php echo base_url()."home/contact" ?>">Kontak</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
	<!-- End Navbar -->

  
<?php  echo $content;?>





    <!-- Start footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<div class="widget">
						<h5>Tentang Kami</h5>
						<img src="<?php echo $this->common->theme_link(); ?>img/logo.png" class="marginbot10" alt="" />
						<p>
						Lembaga Pendidikan & Pelatihan Perhotelan Dan Kapal Pesiar.
						</p>
						<div class="social-network">
							<a href="#"><i class="fa fa-facebook fa-2x icon-square"></i></a>
							<a href="#"><i class="fa fa-twitter fa-2x icon-square"></i></a>
							<a href="#"><i class="fa fa-google-plus fa-2x icon-square"></i></a>
							<a href="#"><i class="fa fa-instagram fa-2x icon-square"></i></a>
							<a href="#"><i class="fa fa-linkedin fa-2x icon-square"></i></a>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-2">
					<div class="widget">
						<h5>Explore link</h5>
						<ul class="list-icons link-list">
							<li><i class="fa fa-angle-double-right"></i> <a href="<?php echo base_url()."home/cruiseline" ?>">Cruiseline</a></li>
							<li><i class="fa fa-angle-double-right"></i> <a href="<?php echo base_url()."home/registrasi" ?>">Pendaftaran</a></li>
							<li><i class="fa fa-angle-double-right"></i> <a href="<?php echo base_url()."home/facility" ?>">Fasilitas</a></li>
							<li><i class="fa fa-angle-double-right"></i> <a href="<?php echo base_url()."home/contact" ?>">Kontak</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="widget">
						<h5>Latest post</h5>
						<ul class="recent-post">
							<li>
								<div class="recent-post-date"><strong>17</strong> Jun</div>
								<h6><a href="#">Luptatum omittantur duo ne impetus indoctum</a></h6>
							</li>
							<li>
								<div class="recent-post-date"><strong>17</strong> Jun</div>
								<h6><a href="#">Eu pro ponderum gloriatur cu lorem denique</a></h6>
							</li>
							<li>
								<div class="recent-post-date"><strong>17</strong> Jun</div>
								<h6><a href="#">No timeam sanctus dicam iudicabit nec eum</a></h6>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="widget">
						<h5>Newsletter</h5>
						<!-- Start Subscribe -->
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Enter your email address...">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="button"><i class="fa fa-send-o"></i></button>
							</span>
						</div>
						<!-- End Subscribe -->
					</div>
					<div class="widget">
						<h5>Twitter Feed</h5>
						<div id="tweecool"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="subfooter">
			<p>2016 &copy; Copyright <a href="">nce18cex.</a> All rights Reserved.</p>
		</div>
	</footer>
	<!-- End footer -->

    <!-- Start to top -->
    <a href="#" class="toTop">
        <i class="fa fa-chevron-up"></i>
    </a>
    <!-- End to top -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $this->common->theme_link(); ?>js/jquery.min.js"></script>
    <script src="<?php echo $this->common->theme_link(); ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $this->common->theme_link(); ?>js/jquery.easing-1.3.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo $this->common->theme_link(); ?>js/ie10-viewport-bug-workaround.js"></script>

	<!-- Custom form -->
	<script src="<?php echo $this->common->theme_link(); ?>js/form/jcf.js"></script>
	<script src="<?php echo $this->common->theme_link(); ?>js/form/jcf.scrollable.js"></script>
	<script src="<?php echo $this->common->theme_link(); ?>js/form/jcf.select.js"></script>

	<!-- Custom checkbox and radio -->
	<script src="<?php echo $this->common->theme_link(); ?>js/checkator/fm.checkator.jquery.js"></script>
	<script src="<?php echo $this->common->theme_link(); ?>js/checkator/setting.js"></script>

	<!-- ticker -->
	<script src="<?php echo $this->common->theme_link(); ?>js/ticker/ticker.js"></script>

    <!-- Twitter -->
    <!--[if lte IE 9]>
    	<script src="js/tweecool/jquery.xdomainrequest.min.js"></script>
	<![endif]-->


    <!-- Custom javaScript for this theme -->
    <script src="<?php echo $this->common->theme_link(); ?>js/custom.js"></script>
		<?php

    //js
     echo $jsincludes;

    //EoF js
    ?>
  </body>
</html>
