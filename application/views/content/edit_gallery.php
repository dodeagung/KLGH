<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_399") ?></div>
    <div class="db-header-extra">
    <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
        <a href="<?php echo site_url("backend/content/add_gallery") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_400") ?></a>
    <?php endif; ?>
    </div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("backend/content/edit_gallery_pro/" . $gallery->ID), array("class" => "form-horizontal")) ?>

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_430") ?></label>
                    <div class="col-md-9 ui-front">
                        <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $gallery->image."_300x201.".$gallery->ext_image ?>" width="300px"><br />
                        <input type="file" name="userfile" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_405") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_497") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="title" value="<?php echo $gallery->title ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_271") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="summary" value="<?php echo $gallery->summary ?>">
                        <span class="help-block"><?php echo lang("ctn_403") ?></span>
                    </div>
            </div>


 
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_406") ?></label>
                    <div class="col-md-9">
                        <select name="categoryid" class="form-control">
                        <?php foreach($gallery_categories->result() as $r) : ?>
                            <option value="<?php echo $r->ID ?>" <?php if($r->ID == $gallery->categoryid) echo "selected" ?>><?php echo $r->name ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>      

			<div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_496") ?></label>
                    <div class="col-md-9">
                        <select name="albumid" class="form-control">
                        <?php foreach($gallery_albums->result() as $r) : ?>
                            <option value="<?php echo $r->ID ?>" <?php if($r->ID == $gallery->albumid) echo "selected" ?>><?php echo $r->name ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>

            <h3><?php echo lang("ctn_421") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_422") ?></label>
                    <div class="col-md-9">
                        <input type="checkbox" name="comments" value="1" <?php if($gallery->comments) echo "checked" ?>> <?php echo lang("ctn_423") ?>
                    </div>
            </div>
            <h3><?php echo lang("ctn_424") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_425") ?></label>
                    <div class="col-md-9">
                        <input type="text" name="seo_title" class="form-control" value="<?php echo $gallery->seo_title ?>">
                        <span class="help-block"><?php echo lang("ctn_426") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_427") ?></label>
                    <div class="col-md-9">
                        <input type="text" name="seo_description" class="form-control" value="<?php echo $gallery->seo_description ?>">
                        <span class="help-block"><?php echo lang("ctn_428") ?></span>
                    </div>
            </div>
<input type="submit" class="btn btn-primary btn-sm form-control" value="<?php echo lang("ctn_434") ?>" />
<?php echo form_close() ?>
</div>
</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
/* CKEDITOR.replace('project-description', { height: '250'}); */
$(".chosen-select-no-single").chosen({
    disable_search_threshold:10
});
});
</script>
