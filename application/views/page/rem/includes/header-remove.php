<?php
	$plugin_url = base_url()."theme_costume/";
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="sertifikasi, profesi, lsp bali, bali, bnsp, pariwisata, lsp pariwisata">
    <meta name="description" content="LSP Pariwisata Bali - Independent - Reliable - Traceable">
    <meta name="author" content="Ansonika">
    <title>
		<?php
			if(!isset($title))
			{
				$title = COMPANYNAME;
				//$title = "LSP Pariwisata Bali";
			}
			echo $title;

		?>
	</title>

   <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo $plugin_url; ?>img/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo $plugin_url; ?>img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo $plugin_url; ?>img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo $plugin_url; ?>img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo $plugin_url; ?>img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="<?php echo $plugin_url; ?>css/base.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
	<link href="<?php echo $plugin_url; ?>layerslider/css/layerslider.css" rel="stylesheet">
    <link href="<?php echo $plugin_url; ?>css/tabs.css" rel="stylesheet">
	<link href="<?php echo $plugin_url; ?>css/skins/square/blue.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="<?php echo $plugin_url; ?>js/html5shiv.min.js"></script>
      <script src="<?php echo $plugin_url; ?>js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

<div id="preloader">
	<div class="pulse"></div>
</div><!-- Pulse Preloader -->

    <!-- Header================================================== -->
    <header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div id="logo">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo $plugin_url; ?>img/logo.png" width="225" height="40" alt="LSP Pariwisata Bali" data-retina="true"></a>
                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
            <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
            <div class="main-menu">
                <div id="header_menu">
                    <img src="<?php echo $plugin_url; ?>img/logo_mobile.png" width="220" height="40" alt="LSP Pariwisata Bali" data-retina="true">
                </div>
                <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                <ul>
                    <li class="submenu">
                    <a href="javascript:void(0);" class="show-submenu">Home <i class="icon-down-open-mini"></i></a>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>homie/visimisi">Visi & Misi</a></li>
                        <li><a href="<?php echo base_url(); ?>homie/legalitas">Legalitas</a></li>
                        <li><a href="<?php echo base_url(); ?>homie/organisasi">Organisasi</a></li>
                    </ul>
                    </li>
                    <li class="submenu">
						<a href="javascript:void(0);" class="show-submenu">Pendaftaran <i class="icon-down-open-mini"></i></a>
						<ul>
							<li><a href="<?php echo base_url().'registrasi/registrasiPSKK'?>">Pendaftaran Sertifikasi PSKK 2016</a></li>
							<li><a href="<?php echo base_url().'registrasi/registrasiHOD'?>">Pendaftaran Sertifikasi HoD</a></li>
						</ul>
                    </li>
                    <li class="submenu">
						<a href="<?php echo base_url(); ?>homie/asesor" class="show-submenu">Asesor </i></a>
                    </li>
					<li class="submenu">
						<a href="javascript:void(0);" class="show-submenu">Sertifikasi <i class="icon-down-open-mini"></i></a>
						<ul>
							<li><a href="<?php echo base_url(); ?>pemegangsertifikat">Pemegang Sertifikat</a></li>
							<li><a href="<?php echo base_url(); ?>homie/alursertifikasi">Skema Sertifikasi</a></li>
							<li><a href="<?php echo base_url(); ?>homie/alursertifikasi">Alur Sertifikasi</a></li>
							<li><a href="<?php echo base_url(); ?>tuk">Tempat Uji Kompetensi</a></li>
						</ul>
                    </li>
					<li class="submenu">
                    <a href="javascript:void(0);" class="show-submenu">About <i class="icon-down-open-mini"></i></a>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>homie/clientkami">Client Kami</a></li>
                        <li><a href="<?php echo base_url(); ?>homie/tentangkami">Tentang Kami</a></li>
                        <li><a href="contacts.html">Kunjungi Kami</a></li>
                        <li><a href="<?php echo base_url(); ?>homie/ourteam">Staff</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                    </ul>
                    </li>

                    <li><a href="tour.html">Tour</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
                    <li><a href="#search" id="search_bt"><i class=" icon-search"></i><span>Search</span></a></li>
                </ul>
            </div><!-- End main-menu -->
            </nav>
        </div>
    </div><!-- container -->
    </header><!-- End Header -->
