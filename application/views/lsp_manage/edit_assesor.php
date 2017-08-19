<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_465") ?></div>

</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("backend/lsp/assesor_pro/true/". $asesor->idasesor), array("class" => "form-horizontal")) ?>
      <h3><?php echo lang("ctn_476") ?></h3>
			<div class="form-group">
                      <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_460") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="name" value="<?php echo $asesor->name ?>" placeholder="Name">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_477") ?></label>
                    <div class="col-md-5 ui-front">
                        <input type="text" class="form-control" name="pob" value="<?php echo $asesor->pob ?>" placeholder="Place of Birth">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_478") ?></label>
                    <div class="col-md-5 ui-front">
                        <input type="text" class="form-control" name="dob" id="dob" value="<?php echo date_format(date_create($asesor->dob),"d/m/Y") ?>" placeholder="dd/mm/yyyy">

                    </div>
            </div>

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_463") ?></label>
                    <div class="col-md-5 ui-front">
                        <input type="text" class="form-control" name="telp" value="<?php echo $asesor->phone ?>" placeholder="phone">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_466") ?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="address" placeholder="Home Address" value="<?php echo $asesor->address ?>">

                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_464") ?></label>
                    <div class="col-md-9 ui-front">
                      <input type="text" class="form-control" name="instansi" value="<?php echo $asesor->instansi ?>" placeholder="Work Place">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_24") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="email" value="<?php echo $asesor->email ?>" placeholder="Email">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_404") ?></label>
                    <div class="col-md-9 ui-front">
                        <img style="max-height:100px;height: expression(this.height > 100 ? 100: true);" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/assesors/<?php echo $asesor->image ?>"><br />
                        <input type="file" name="userfile" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_405") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_475") ?></label>
                    <div class="col-md-9">
                        <textarea name="desc" id="assesor-description"> <?php echo $asesor->description ?></textarea>
                    </div>
            </div>
            <h3><?php echo lang("ctn_473") ?></h3>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_467") ?></label>
                    <div class="col-md-9 ui-front">
                        <img style="max-height:100px;height: expression(this.height > 100 ? 100: true);" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/certificate/<?php echo $asesor->image_certif ?>"><br />
                        <input type="file" name="userfileSertifikat" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_468") ?></span>
                    </div>
            </div>

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_469") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="noreg" value="<?php echo $asesor->no_reg ?>" placeholder="Number of Registration (see assesor certificate)">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_470") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="nocertif" value="<?php echo $asesor->no_certificate ?>" placeholder="Number of Certificate (see assesor certificate)">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_471") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="noblanko" value="<?php echo $asesor->no_blanko ?>" placeholder="Number of Blanko (see assesor certificate)">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_472") ?></label>
                    <div class="col-md-5 ui-front">
                      <input type="text" class="form-control" name="expdate" id="expdate" value="<?php echo date_format(date_create($asesor->exp_certificate),"d/m/Y") ?>" placeholder="dd/mm/yyyy (see assesor certificate)">
                    </div>
            </div>

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_474") ?></label>
                    <div class="col-md-9">
                        <select name="iddep" class="form-control">
                        <?php foreach($departments->result() as $r) : ?>
                            <option value="<?php echo $r->iddep ?>" <?php if($r->iddep == $asesor->iddep) echo "selected" ?>><?php echo $r->nama_departemen ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>

<input type="submit" class="btn btn-primary btn-sm form-control" value="<?php echo lang("ctn_479") ?>" />
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
