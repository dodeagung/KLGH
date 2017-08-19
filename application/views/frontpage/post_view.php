
<!--=================================
 inner-intro-->

<section class="inner-intro bg-2 bg-opacity-white-70">
  <div class="container">
     <div class="row text-center intro-title">
            <h1 class="text-blue">Post Release</h1>
            <p class="text-grey">Our Related Post</p>
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

<section class="blog blog-single white-bg page-section-ptb">
  <div class="container">
    <div class="row">
    <!-- ========================== -->
     <div class="col-lg-9 col-md-9 col-sm-9">
        <div class="blog-entry post-1">
        <div class="entry-title mt-30 mb-20">
             <i class="fa fa-picture-o"></i>
             <h3><?=$post->title;?></h3>
          </div>
          <div class="entry-meta">
              <a href="#"><i class="fa fa-user"></i> By BossForexSignal.com</a>
              <a href="#"><i class="fa fa-folder-open"></i> <?=$post->catname;?></a>
            </div>
			 <input type="hidden" id="idpost" value="<?=$post->ID;?>">
         <div class="blog-entry entry-content mt-20 mb-30 post-1 clearfix">
             <?=$post->content;?><br/>
             
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
							<a href="http://www.facebook.com/share.php?u=<?=urlencode(site_url("post/withid/".$post->ID));?>&title=<?=urlencode($post->title);?>"><i class="fa fa-facebook"></i></a>
						</li>
                    <li> <a href="http://twitter.com/home?status=<?=urlencode($post->title);?>+<?=urlencode(site_url("post/withid/".$post->ID))?>"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/share?url=<?=urlencode(site_url("post/withid/".$post->ID));?>"><i class="fa fa-google-plus"></i></a></li>
					   </ul>
               </div>
          </div>

<?php if ($postbyCategories): ?>
 <div class="related-work hover-direction">
   <div class="row">
    <div class="col-ld-12 col-md-12">
         <h3 class="text-blue mb-20">Related Post</h3>  
		<div class="owl-carousel-blog">
		  <?php foreach ($postbyCategories as $pbc): ?>	
          <div class="item">
				<div class="blog-box">
				 <div class="blog-info">
				  <h4 class="text-black mb-30"> <a href="#"><?=$this->common->limitString($pbc->title,15);?></a></h4>
					<span><i class="fa fa-user"></i> BossForexSignal.com</span>
					<span><i class="fa fa-calendar-check-o"></i><?=$this->common->date_time($pbc->timestamp);?></span>
					<p class="front"><?=$this->common->limitString($pbc->summary,120);?></p>
					<a class="blog-btn" href="<?php echo $this->common->slug_link("post/withid/".$pbc->id) ?>">Read more <i class="fa fa-long-arrow-right"></i></a>
				  </div>	
				  <div class="blog-box-img" style="background-image:url(<?=site_url().$this->settings->info->upload_path_relative.$pbc->image."_600x600.".$pbc->ext_image;;?>);"></div>
   	 			 <span class="border"></span>
				</div>
           </div>
		   <?php endforeach; ?>
         </div>
       </div>
      </div>
     </div>
	 <?php endif;?>

<br/>
<!-- ================================================ -->
	<div class="row formkomenUtama">
       <div class="col-lg-12 col-md-12">
       <h3 class="text-blue mb-30">Leave a Reply </h3> 
         <div class="contact-form" id="contact-form">
           <div class="section-field">
            <i class="fa fa-user"></i>
            <input id="name" name="name" placeholder="Name*" >
           </div> 
           <div class="section-field">
              <i class="fa fa-envelope-o"></i>
              <input id="email" name="email" placeholder="Email*" >
            </div>
           <div class="section-field textarea">
             <i class="fa fa-pencil"></i>
             <textarea id="message" name="message" rows="7" placeholder="Comment*" class="input-message"></textarea>
            </div>
            <a class="button pull-right mt-20 replyformkomenUtama" href="javascript:void(0)">
                 <span>Post comment</span>
               </a>
         </div> 
       </div> 
     </div>
		<?php if (isset($comments)): ?>
			<div class="blog-comments mt-40 komenblock">
				<?=$comments?>
			</div>
		<?php endif;?>
	</div> 
    </div>
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
				<li><a href='<?php echo site_url("post/all") ?>'><span>All</span></a></li>
				<?php foreach ($categories as $cat): ?>
                 <li><a href='<?php echo site_url("post/all/".$cat->ID) ?>'><span><?=$cat->name;?></span></a></li>
                 <?php endforeach; ?>
             </ul>
          </div>
       </div>  
      <div class="sidebar-widget">
          <h3 class="mt-30 mb-20">Recent Posts</h3>
		  <?php foreach ($recentposts as $recentpost): ?>
			  <div class="recent-post mb-20">
			   <div class="recent-post-image">
				<img src="<?php echo site_url().$this->settings->info->upload_path_relative.$recentpost->image."_600x600.".$recentpost->ext_image;?>" alt="">
			   </div>
			   <div class="recent-post-info">
				<a href="#"><?=$this->common->limitString($recentpost->title,27)?></a> 
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