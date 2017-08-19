

<!--=================================
 inner-intro-->

<section class="inner-intro bg-2 bg-opacity-white-70">
  <div class="container">
     <div class="row text-center intro-title">
            <h1 class="text-blue">Signal Release</h1>
            <p class="text-grey">Our Related Post</p>
            <ul class="page-breadcrumb">
               <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="#">signal</a></li>
           </ul>
     </div>
  </div>
</section>

<!--=================================
 inner-intro-->

 
<!--=================================
 Blog-->

<section class="blog blog-single white-bg page-section-ptb">
  <div class="container">
    <div class="row">
       <div class="col-lg-3 col-md-3 col-sm-3">
          <div class="sidebar-widget">
            <div class="widget-search">
               <i class="fa fa-search"></i>
               <input type="search" class="form-control" placeholder="Search...." />
              </div>  
          </div>
         <div class="sidebar-widget">
             <h3 class="mt-30 mb-20">Category</h3>
            <div class='widget-menu'>
              <ul>
				<?php foreach ($categories as $cat): ?>
                 <li><a href='<?php echo site_url("post/categories/".$cat->ID."/". $this->security->get_csrf_hash()) ?>'><span><?=$cat->name;?></span></a></li>
                 <?php endforeach; ?>
             </ul>
          </div>
       </div>    
      <div class="sidebar-widget">
          <h3 class="mt-30 mb-20">Recent Posts</h3>
		  <?php foreach ($posts as $post): ?>
			  <div class="recent-post mb-20">
			   <div class="recent-post-image">
				<img src="<?php echo site_url().$this->settings->info->upload_path_relative.$post->image."_600x600.".$post->ext_image;?>" alt="">
			   </div>
			   <div class="recent-post-info">
				<a href="#"><?=$this->common->limitString($post->title,27)?></a> 
				<span><i class="fa fa-calendar"></i> <?=$this->common->date_time($post->timestamp);?></span>
			   </div>
			  </div>
		  <?php endforeach; ?> 
      </div> 
      <div class="sidebar-widget">
       <h3 class="mt-30 mb-20">Tags</h3>
        <div class="tags">
         <ul>
          <li><a href="#">Forex Signal</a></li>
          <li><a href="#">Forex</a></li>
          <li><a href="#">Signal</a></li>
        </ul>
      </div>
     </div>

 </div>
<!-- ========================== -->
     <div class="col-lg-9 col-md-9 col-sm-9">
        <div class="blog-entry post-1">
        <div class="entry-title mt-30 mb-20">
             <i class="fa fa-picture-o"></i>
             <h3><?=$signal->title;?></h3>
          </div>
          <div class="entry-meta">
              <a href="#"><i class="fa fa-user"></i> By BossForexSignal.com</a>
              <a href="#"><i class="fa fa-folder-open"></i> <?=$signal->catname;?></a>
              <a href="#"><i class="fa fa-calendar"></i> <?=$this->common->date_time($signal->timestamp);?></a>
            </div>

         <div class="blog-entry entry-content mt-20 mb-30 post-1 clearfix">

			  
			<div class="blog-entry-slider">
				  <div class="owl-carousel-6">
				  <div class="item">           
					 <img src="<?php echo site_url().$this->settings->info->upload_path_relative.$signal->image."_600x600.".$signal->ext_image;?>" alt="<?=$signal->title;?>">
				   </div>
				  <div class="item">
					  <img src="<?php echo site_url().$this->settings->info->upload_path_relative.$signal->image."_600x600.".$signal->ext_image;?>" alt="<?=$signal->title;?>">
				   </div>

				 </div>
			</div>
             
             <div class="tags-2 mt-30 mb-30 pull-left clearfix">
              <h5>Tags:</h5>
              <ul>
                <li><a href="#">Forex Signal</a></li>
                <li><a href="#">Forex</a></li>
                <li><a href="#">Signal</a></li>
              </ul>
          </div>
           <div class="share small mt-30 mb-20 pull-right clearfix">
               <a class="share-button" href="#">
                  <i class="fa fa-share-alt"></i>
               </a>
					  <ul>
						<li>
							<a href="http://www.facebook.com/share.php?u=<?=urlencode(site_url("signal/withid/".$signal->ID));?>&title=<?=urlencode($signal->title);?>"><i class="fa fa-facebook"></i></a>
						</li>
                    <li> <a href="http://twitter.com/home?status=<?=urlencode($signal->title);?>+<?=urlencode(site_url("signal/withid/".$signal->ID))?>"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/share?url=<?=urlencode(site_url("signal/withid/".$signal->ID));?>"><i class="fa fa-google-plus"></i></a></li>
					   </ul>
               </div>
          </div>

<!--
 <div class="related-work hover-direction">
   <div class="row">
    <div class="col-ld-12 col-md-12">
         <h3 class="text-blue mb-20">Related Post</h3>  
		<div class="owl-carousel-blog">
		  <?php foreach ($signalbyCategories as $pbc): ?>	
          <div class="item">
				<div class="blog-box">
				 <div class="blog-info">
				  <h4 class="text-black mb-30"> <a href="#"><?=$this->common->limitString($pbc->title,15);?></a></h4>
					<span><i class="fa fa-user"></i> BossForexSignal.com</span>
					<span><i class="fa fa-calendar-check-o"></i><?=$this->common->date_time($pbc->timestamp);?></span>
					<p class="front"><?=$this->common->limitString($pbc->summary,120);?></p>
					<a class="blog-btn" href="<?php echo site_url("post/withid/".$pbc->id."/". $this->security->get_csrf_hash()) ?>">Read more <i class="fa fa-long-arrow-right"></i></a>
				  </div>	
				  <div class="blog-box-img" style="background-image:url(<?=site_url().$this->settings->info->upload_path_relative.$pbc->image."_600x600.".$pbc->ext_image;;?>);"></div>
   	 			 <span class="border"></span>
				</div>
           </div>
		   <?php endforeach; ?>
         </div>
       </div>
      </div>
     </div> -->

<br/>
<!-- ================================================ -->
     </div> 
    </div>
   </div>
  </section>
 
<!--=================================
 Blog-->


<!--=================================
 action-box -->

<section class="action-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<h3 class="text-white">Join us know! and become a successful Forex trader</h3>
				<p class="text-white">We provide easy access for forex signal anywhere anytime.</p>
			</div>
			<div class="col-lg-4 col-md-4 text-right action-box-button">
         <a href="<?=site_url("join")?>" class="button button-white mt-15">
            <span>Join Now!</span>
            <i class="fa fa-thumbs-o-up"></i>
         </a>
        
			</div>
		</div>
	</div>
</section>

<!--=================================
 action-box -->