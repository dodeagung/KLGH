<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-list"></span> <?php echo lang("ctn_498") ?></div>
    <div class="db-header-extra form-inline">
    
    </div>
</div>

<p><?php echo lang("ctn_501") ?></p>


<div class="row">
<?php foreach($albums->result() as $r) : ?>
<div class="col-md-4">
<div class="category-page">
<img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->image ?>" class="category-image">
<p class="category-title"><a href="<?php echo site_url("backend/gallery/view_album/" . $r->ID) ?>"><?php echo $r->name ?></a></p>
<p><?php echo $r->description ?></p>
<hr>
<p><div class="circle-buttons"><a href="<?php echo site_url("backend/gallery/view_album/" . $r->ID) ?>"><span class="glyphicon glyphicon-list"></span></a></div></p>
</div>
</div>
<?php endforeach; ?>
</div>

</div>