<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_399") ?></div>
    <div class="db-header-extra">
    <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
        <a href="<?php echo site_url("backend/content/add_page") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_400") ?></a>
    <?php endif; ?>
    </div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("backend/content/edit_post_pro/" . $post->ID), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_401") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $post->title ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_514") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="slug" id="slug" value="<?php echo $link->slug  ?>">
                        <span class="help-block"><?php echo lang("ctn_513") ?></span>
                    </div>
            </div>     
			<div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_515") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="date_post" id="date_post" value="<?=$this->common->date_time($post->timestamp,"Y-m-d");?>">
                        <span class="help-block"><?php echo lang("ctn_516") ?></span>
                    </div>
            </div> 	
			<div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_402") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="summary" value="<?php echo $post->summary ?>">
                        <span class="help-block"><?php echo lang("ctn_403") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_404") ?></label>
                    <div class="col-md-9 ui-front">
                        <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $post->image."_300x201.".$post->ext_image?>" width = "300px"><br />
                        <input type="file" name="userfile" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_405") ?></span>
                    </div>
            </div>

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_399") ?></label>
                    <div class="col-md-9">
                        <textarea name="content" id="project-description"><?php echo $post->content ?></textarea>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_406") ?></label>
                    <div class="col-md-9">
                        <select name="categoryid" class="form-control">
                        <?php foreach($post_categories->result() as $r) : ?>
                            <option value="<?php echo $r->ID ?>" <?php if($r->ID == $post->idCategory) echo "selected" ?>><?php echo $r->name ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>
         
            <h3><?php echo lang("ctn_421") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_422") ?></label>
                    <div class="col-md-9">
                        <input type="checkbox" name="comments" value="1" <?php if($post->comments) echo "checked" ?>> <?php echo lang("ctn_423") ?>
                    </div>
            </div>
            <h3><?php echo lang("ctn_424") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_425") ?></label>
                    <div class="col-md-9">
                        <input type="text" name="seo_title" class="form-control" value="<?php echo $post->seo_title ?>">
                        <span class="help-block"><?php echo lang("ctn_426") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_427") ?></label>
                    <div class="col-md-9">
                        <input type="text" name="seo_description" class="form-control" value="<?php echo $post->seo_description ?>">
                        <span class="help-block"><?php echo lang("ctn_428") ?></span>
                    </div>
            </div>
<input type="submit" class="btn btn-primary btn-sm form-control" value="<?php echo lang("ctn_434") ?>" />
<?php echo form_close() ?>
</div>
</div>

</div>
<script type="text/javascript">
    var BASE_URL = "<?php echo base_url()?>";
</script>

<script type="text/javascript">
$(document).ready(function() {
CKEDITOR.replace('project-description', { height: '250'});
$(".chosen-select-no-single").chosen({
    disable_search_threshold:10
});
	$('#date_post').datepicker({
			changeMonth: true,
            changeYear: true,
			yearRange: "-10:+0",
			dateFormat: 'yy-mm-dd',
			autoclose: true
	});
});
</script>
