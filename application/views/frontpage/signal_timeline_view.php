
<!--=================================
 inner-intro-->

<section class="inner-intro bg-2 bg-opacity-white-70">
  <div class="container">
     <div class="row text-center intro-title">
            <h1 class="text-blue">Signal Release</h1>
            <p class="text-grey">Our Recent Signal Subcription Post</p>
            <ul class="page-breadcrumb">
               <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="#">news</a></li>
           </ul>
     </div>
  </div>
</section>

<!--=================================
 inner-intro-->

 
<!--=================================
 Blog-->

<!--=================================
 Blog-->
<section class="white-bg blog timeline-sidebar page-section-ptb">
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
					 <li><a href='<?php echo site_url("home/post/categories/".$cat->ID."/". $this->security->get_csrf_hash()) ?>'><span><?=$cat->name;?></span></a></li>
					 <?php endforeach; ?>
				</ul>
               </ul>
              </div>
          </div>    
     <div class="sidebar-widget">
          <h3 class="mt-30 mb-20">Recent Post</h3>
		  <?php foreach ($recentposts as $recentpost): ?>
			  <div class="recent-post mb-20">
			   <div class="recent-post-image">
				<img src="<?php echo site_url().$this->settings->info->upload_path_relative.$recentpost->image."_300x201.".$recentpost->ext_image;?>" alt="">
			   </div>
			   <div class="recent-post-info">
				<a href="<?php echo site_url("post/withid/".$recentpost->id."/". $this->security->get_csrf_hash()) ?>"><?=$this->common->limitString($recentpost->title,27)?></a> 
				<span><i class="fa fa-calendar"></i> <?=$this->common->date_time($recentpost->timestamp);?></span>
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
<!-- ================================= -->
 <div class="col-lg-9 col-md-9 col-sm-9"> 
    <ul class="timeline">
       <li class="entry-date"> <span> Timeline Signal </span></li> 
		<!-- =========================================== -->
		<?php
			$count=1;	
			foreach ($signals as $sig): 
				$newproperty = $count;	?>
			<li class="timeline-inverted">
			  <div class="timeline-badge primary"><a><?=$this->common->date_time($sig->timestamp,"d");?> <span><?=$this->common->date_time($sig->timestamp,"M");?></span></a></div>
			  <div class="timeline-panel">
				<div class="blog-entry post-1">
				 <div class="blog-entry-grid hover-direction  popup-gallery clearfix">
				  <ul class="grid-post">
					 <li>
					  <div class="portfolio-item timeline-signal">
					   <img class="img-responsive" src="<?php echo $this->settings->info->upload_path_relative.$sig->image."_600x600.".$sig->ext_image; ?>" alt="">
						 <div class="portfolio-caption">
					<div class="portfolio-overlay">
						<a class="portfolio-img" title="<?=$sig->title?>" href="<?php echo $this->settings->info->upload_path_relative.$sig->image."_600x600.".$sig->ext_image;?>"><i class="fa fa-plus"></i></a>
						
						<a href="<?php echo site_url("signal/withid/".$sig->ID."/". $this->security->get_csrf_hash()) ?>"><i class="fa fa-link"></i></a>
					</div>
						  </div>
						 </div>
					  </li>
					</ul>
			  </div>
			  <div class="entry-title mt-30 mb-20">
				 <i class="fa fa-th"></i>
				 <h4><?=$this->common->limitString($sig->title,62)?></h4>
				 <p><?=$sig->summary?></p>
			  </div>
			  <div class="entry-meta">
				<a href="#"><i class="fa fa-user"></i> By BossForexSignal.com</a>
				<a href="#"><i class="fa fa-folder-open"></i> <?=$sig->catname?></a>
			  </div>
	
			  <div class="entry-share clearfix">

					<div class="share small pull-right">
				   <a class="share-button" href="#">
					  <i class="fa fa-share-alt"></i>
				   </a>
					  <ul>
						<li>
							<a href="http://www.facebook.com/share.php?u=<?=urlencode(site_url("signal/withid/".$sig->ID));?>&title=<?=urlencode($sig->title);?>"><i class="fa fa-facebook"></i></a>
						</li>
                    <li> <a href="http://twitter.com/home?status=<?=urlencode($sig->title);?>+<?=urlencode(site_url("signal/withid/".$sig->ID))?>"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/share?url=<?=urlencode(site_url("signal/withid/".$sig->ID));?>"><i class="fa fa-google-plus"></i></a></li>
					   </ul>
				   </div>
			  </div>
			 </div>
			</div>
		  </li>
	<!-- =========================================== -->
        <?php 
			$count++;
			endforeach; ?>
		 

			
		   <?php if(1):?>
                <li class="entry-date-bottom" id="showmore"> <a href="javascript:void(0);" id="load-more">Load more...</a></li>
			
				<input type="hidden" name="limit" id="limit" value="2"/>
				<input type="hidden" name="offset" id="offset" value="2"/>
                <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>  

                    
			<?php endif;?>
		
		
		
		
		
		
		
		
 <!-- =========================================== -->
        <li class="clearfix timeline-inverted" style="float: none;"></li>
    </ul>
   </div>
  </div>
</div>  
</section>


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