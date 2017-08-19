
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
 
   <div class="col-lg-9 col-lg-9 col-sm-9">

<!-- ================================================ -->
	<?php if($results){
      foreach($results as $res){ ?>	  
		<div class="blog-entry post-1">
			<div class="entry-title mt-30 mb-20">
				 <i class="fa fa-file-text-o"></i>
				 <h3><?=$res->title;?></h3>
			  </div>
			  <div class="entry-meta">
				<a href="#"><i class="fa fa-user"></i> By BossForexSignal.com</a>
				<a href="#"><i class="fa fa-folder-open"></i> <?=$res->catname;?></a>
				<a href="#"><i class="fa fa-calendar"></i> <?=$this->common->date_time($res->timestamp,"d M Y");?></a>
			
			  </div>
			  <div class="entry-content mt-20 mb-20">
				<?=$this->common->limitString($res->content,500)?>
			  </div>
			   <div class="entry-share clearfix">
			   <a class="button pull-left" href="<?php echo $this->common->slug_link("post/withid/".$res->ID) ?>">
					 <span>Read More</span>
					  <i class="fa fa-hand-o-right"></i>
				   </a>
					<div class="share pull-right">
				   <a class="share-button" href="#">
					  <i class="fa fa-share-alt"></i>
				   </a>
						<ul>
							<li><a href="http://www.facebook.com/share.php?u=<?=urlencode($this->common->slug_link("post/withid/".$res->ID));?>&title=<?=urlencode($res->title);?>"><i class="fa fa-facebook"></i></a></li>
							<li> <a href="http://twitter.com/home?status=<?=urlencode($res->title);?>+<?=urlencode($this->common->slug_link("post/withid/".$res->ID))?>"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://plus.google.com/share?url=<?=urlencode($this->common->slug_link("post/withid/".$res->ID));?>"><i class="fa fa-google-plus"></i></a></li>
					   </ul>
				   </div>
			  </div>
			 </div>
		<hr>
	<?php }}else{?>
				<div class="blog-entry post-1">
			<div class="entry-title mt-30 mb-20">
				 <i class="fa fa-file-text-o"></i>
				 <h3>Tidak ada post untuk kategori ini.</h3>
			  </div>
			</div>
		<hr>
	<?php }?>	
<!-- ================================================ -->
  
	<div class="blog-entry post-1">
          <div class="entry-pagination">
            <div class="pagination-nav text-center">
                 <?php echo $links ?>
             </div>
          </div>
         </div>
<!-- ================================================ -->
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
		  <?php $i=1; ?>
		  <?php foreach ($recentposts as $recentpost): ?>
			  <div class="recent-post mb-20">
			   <div class="recent-post-image">
				<img src="<?php echo site_url().$this->settings->info->upload_path_relative.$recentpost->image."_600x600.".$recentpost->ext_image;?>" alt="">
			   </div>
			   <div class="recent-post-info">
				<a href="<?php echo $this->common->slug_link("post/withid/".$recentpost->id) ?>"><?=$this->common->limitString($recentpost->title,27)?></a> 
				<span><i class="fa fa-calendar"></i> <?=$this->common->date_time($recentpost->timestamp);?></span>
			   </div>
			  </div>
			  <?if ($i++ == 4) break;?>
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