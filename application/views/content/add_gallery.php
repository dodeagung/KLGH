<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_494") ?></div>
    <div class="db-header-extra"> <a href="<?php echo site_url("backend/content/add_gallery") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_495") ?></a>
    </div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("backend/content/add_gallery_pro"), array("class" => "form-horizontal")) ?>
			<div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_430") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="file" name="userfile" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_405") ?></span>
                    </div>
            </div>
			<div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_497") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="title" value="">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_271") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="summary" value="">
                        <span class="help-block"><?php echo lang("ctn_403") ?></span>
                    </div>
            </div>

            
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_406") ?></label>
                    <div class="col-md-9">
                        <select name="categoryid" class="form-control">
                        <?php foreach($categories->result() as $r) : ?>
                        	<option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>  

			<div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_498") ?></label>
                    <div class="col-md-9">
                        <select name="albumid" class="form-control">
                        <?php foreach($albums->result() as $a) : ?>
                        	<option value="<?php echo $a->ID ?>"><?php echo $a->name ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>

            <h3><?php echo lang("ctn_421") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_422") ?></label>
                    <div class="col-md-9">
                        <input type="checkbox" name="comments" value="1" checked> <?php echo lang("ctn_423") ?>
                    </div>
            </div>           

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_510") ?></label>
                    <div class="col-md-9">
                        <input type="checkbox" name="Displayimage" value="1" checked> <?php echo lang("ctn_423") ?>
                    </div>
            </div>
            <h3><?php echo lang("ctn_424") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_425") ?></label>
                    <div class="col-md-9">
                        <input type="text" name="seo_title" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_426") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_427") ?></label>
                    <div class="col-md-9">
                        <input type="text" name="seo_description" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_428") ?></span>
                    </div>
            </div>
<input type="submit" class="btn btn-primary btn-sm form-control" value="<?php echo lang("ctn_495") ?>" />
<?php echo form_close() ?>
</div>
</div>

</div>

<script type="text/javascript">
$(document).ready(function() {

});
</script>