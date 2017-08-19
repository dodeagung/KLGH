<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="Forex Signal Provider" />
<meta name="description" content="<?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?>" />
<meta name="author" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url().$this->settings->info->upload_path_relative."/".$this->settings->info->favicon; ?>" />

<!-- bootstrap -->
<link href="<?php echo $this->common->theme_link(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- plugins -->
<link href="<?php echo $this->common->theme_link(); ?>css/plugins-css.css" rel="stylesheet" type="text/css" />

<!-- mega menu -->
<link href="<?php echo $this->common->theme_link(); ?>css/mega-menu/mega_menu.css" rel="stylesheet" type="text/css" />

<!-- Scrollbar -->
<link href="<?php echo $this->common->theme_link(); ?>css/portfolio/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />

<!-- Webfont -->
<link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:700" rel="stylesheet">

<!-- revoluation -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->common->theme_link(); ?>js/revolution/css/extralayers.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $this->common->theme_link(); ?>js/revolution/rs-plugin/css/settings.css" media="screen" />

<!-- default -->
<link href="<?php echo $this->common->theme_link(); ?>css/default.css" rel="stylesheet" type="text/css" />

<!-- main style -->
<link href="<?php echo $this->common->theme_link(); ?>css/style.css" rel="stylesheet" type="text/css" />

<!-- responsive -->
<link href="<?php echo $this->common->theme_link(); ?>css/responsive.css" rel="stylesheet" type="text/css" />

<!-- Style customizer (Remove these two lines please) 
<link href="<?php echo $this->common->theme_link(); ?>#" data-style="styles" rel="stylesheet">
<link href="<?php echo $this->common->theme_link(); ?>css/style-customizer.css" rel="stylesheet" type="text/css" />-->

<!-- custominstom style -->
<link href="<?php echo $this->common->theme_link(); ?>css/custom.css" rel="stylesheet" type="text/css" />

<link href="<?php echo $this->common->theme_link(); ?>css/logo-bank.css" rel="stylesheet" type="text/css" />
<!-- 
<link href="<?php echo $this->common->theme_link(); ?>fonts/bossfxsignal/font/flaticon.css" rel="stylesheet" type="text/css" /> -->

<?php echo $cssincludes; ?>

</head>

<body>

<div class="page-wrapper">

<!--=================================
 preloader -->
 
<div id="preloader">
  <div class="clear-loading loading-effect"> <span></span> </div>
</div>

<!--=================================
 preloader -->


<!--=================================
 header -->

<header id="header" class="header">

<div class="menu">  
  <!-- menu start -->
   <nav id="menu-1" class="mega-menu">
    <!-- menu list items container -->
    <section class="menu-list-items">
     <div class="container"> 
      <div class="row"> 
       <div class="col-lg-12 col-md-12"> 
        <!-- menu logo -->
        <ul class="menu-logo">
            <li>
                <a href="<?=site_url()?>"><img id="logo_img" src="<?php echo $this->common->theme_link(); ?>images/logo-dark.png" alt="logo"> </a>
            </li>
        </ul>
        <!-- menu links -->
        <ul class="menu-links">
            <!-- active class -->
            <li class="active"><a href="<?=site_url()?>"> Home</i></a></li>
            <li><a href="<?=site_url("join")?>">Service</a></li>   
			            <li><a href="<?=$this->common->slug_link("join/plan/1")?>">Free Signal</a></li>   
			<!-- <li><a href="<?=site_url("signal")?>">Signal</a></li> -->
            <li><a href="<?=site_url("post")?>">News</a></li>
            <li><a href="<?=site_url("home/about")?>">About us</a></li>
            <li><a href="<?=site_url("contact")?>">Contact</a></li>
            <li class="hidden-md hidden-lg"><a href="<?=site_url("join")?>">Join Now</a></li>
            <li class="hidden-sm" ><a href="<?=site_url('join')?>" class="button small">Join Now</a></li>
		</ul>
       </div>
      </div>
     </div>
    </section>
   </nav>
  <!-- menu end -->
 </div>
</header>

<!--=================================
 header -->


		<?php  echo $content;?>
		


	 
<footer class="footer-4 page-section-pt">
 <div class="container">
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6">
<div class="footer-logo">
        <img id="logo-footer" class="pb-10" src="<?php echo $this->common->theme_link(); ?>images/logo-white.png" alt="">
        <p class="text-white pb-10"> was started by 10 years Experienced Forex Traders team who are worked with Major banks, Financial Institutions and various Forex brokers as Forex Trader, Fund Manager, MT4 Administrator, MT4 Dealer and different positions in Forex Trading Companies. <a href=""> Join us NOW!</a></p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
      <div class="office-hours footer-hedding">
        <h4 class="text-blue mb-20">Office Hours</h4>
         <p>Mon-Fri : 10 a.m. – 7 p.m. (GMT +8)</p>
         <p>Saturday : 9 a.m. – 1 p.m. (GMT +8)</p>
         <img src="<?php echo $this->common->theme_link(); ?>images/clock.png" alt="">
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
       <div class="tags footer-hedding">
        <h4 class="text-blue mb-20">Tagcloud</h4>
        <ul>
          <li><a href="#">Forex</a></li>
          <li><a href="#">Signal</a></li>
          <li><a href="#">Traders</a></li>
          <li><a href="#">Trading</a></li>
          <li><a href="#">Money</a></li>
          <li><a href="#">Risk-management</a></li>
          <li><a href="#">point</a></li>
          <li><a href="#">pips</a></li>
        </ul>
      </div>
      </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
      <div class="recent-post footer-hedding">
        <h4 class="text-blue mb-20">Recent Posts</h4>
		<?php if (isset($posts)): ?>
		<?php foreach ($posts as $post): ?>
        <div class="recent-post mb-30">
         <div class="recent-post-image">
          <img src="<?=base_url("/uploads/").$post->image."_600x600.".$post->ext_image;?>" alt="">
         </div>
         <div class="recent-post-info">
          <a href="<?php echo site_url("post/withid/".$post->id) ?>"><?=$this->common->limitString($post->title,26);?></a> 
          <span><i class="fa fa-calendar"></i> <?=$this->common->date_time($post->timestamp);?></span>
         </div>
        </div>
		<?php endforeach; ?>
         <?php endif;?>
      </div>
    </div>
   </div>
  </div>
  <div class="footer-widget mt-60">
   <div class="container"> 
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <p class="text-white mt-15"> &copy;Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="#"> BossForexSignal.com</a> All Rights Reserved </p>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <p class="text-white text-right mt-15">If you are interested in Forex Signal, do not wait and <a target="_blank" href="<?=site_url("join");?>">Join Now!</a></p>
      </div>
    </div>    
   </div>
  </div>
</footer>

<!--=================================
 footer -->






<!--=================================
 style-customizer  -->

<!--=================================
 style-customizer --> 

<div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-long-arrow-up"></i></a></div>  
 
<!--=================================
 jquery -->

<!-- jquery  -->
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>/js/jquery.min.js"></script>

<!-- bootstrap -->
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>/js/bootstrap.min.js"></script>

<!-- plugins-jquery -->
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>/js/plugins-jquery.js"></script>

<!-- mega menu -->
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>/js/mega-menu/mega_menu.js"></script>

<!-- Style Customizer --> 
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>/js/style-customizer.js"></script> 
 
 <!-- custom -->
<script type="text/javascript" src="<?php echo $this->common->theme_link(); ?>/js/custom.js"></script>
  
</body>

<?php echo $jsincludes;?>
</html>