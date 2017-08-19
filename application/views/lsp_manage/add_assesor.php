<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_465") ?></div>

</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("backend/lsp/assesor_pro"), array("class" => "form-horizontal")) ?>
      <h3><?php echo lang("ctn_476") ?></h3>
			<div class="form-group">
                      <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_460") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="name" value="" placeholder="Name">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_477") ?></label>
                    <div class="col-md-5 ui-front">
                        <input type="text" class="form-control" name="pob" value="" placeholder="Place of Birth">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_478") ?></label>
                    <div class="col-md-5 ui-front">
                        <input type="text" class="form-control" name="dob" id="dob" value="" placeholder="dd/mm/yyyy">

                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_463") ?></label>
                    <div class="col-md-5 ui-front">
                        <input type="text" class="form-control" name="telp" value="" placeholder="phone">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_466") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="address" placeholder="Home Address" value="">

                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_464") ?></label>
                    <div class="col-md-9 ui-front">
                      <input type="text" class="form-control" name="instansi" value="" placeholder="Work Place">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_24") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="email" value="" placeholder="Email">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_462") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="file" name="userfile" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_405").' '.lang("ctn_461") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_475") ?></label>
                    <div class="col-md-9">
                        <textarea name="desc" id="assesor-description"></textarea>
                    </div>
            </div>
            <h3><?php echo lang("ctn_473") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_467") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="file" name="userfileSertifikat" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_468") ?></span>
                    </div>
            </div>

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_469") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="noreg" value="" placeholder="Number of Registration (see assesor certificate)">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_470") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="nocertif" value="" placeholder="Number of Certificate (see assesor certificate)">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_471") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="noblanko" value="" placeholder="Number of Blanko (see assesor certificate)">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_472") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="expdate" id="expdate" value="" placeholder="dd/mm/yyyy (see assesor certificate)">
                    </div>
            </div>


            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_474") ?></label>
                    <div class="col-md-9">
                        <select name="iddep" class="form-control">
                        <?php foreach($departments->result() as $r) : ?>
                        	<option value="<?php echo $r->iddep ?>"><?php echo $r->nama_departemen ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>

<input type="submit" class="btn btn-primary btn-sm form-control" value="<?php echo lang("ctn_400") ?>" />
<?php echo form_close() ?>
</div>
</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
CKEDITOR.replace('assesor-description', { height: '250'});
$(".chosen-select-no-single").chosen({
	disable_search_threshold:10
});
$('#dob').datepicker({
			format: 'dd/mm/yyyy',
			   autoclose: true
});
$('#expdate').datepicker({
			format: 'dd/mm/yyyy',
			   autoclose: true
});


});
</script>
