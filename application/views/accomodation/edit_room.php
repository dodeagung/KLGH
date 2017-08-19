<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo "Room" ?></div>
    <div class="db-header-extra">
    <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
        <a href="<?php echo site_url("backend/hotel/accomodation/add_page") ?>" class="btn btn-warning btn-sm"><?php echo "Add Another Room" ?></a>
    <?php endif; ?>
    </div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("backend/hotel/accomodation/edit_room_pro/" . $room->id), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_404") ?></label>
                    <div class="col-md-9 ui-front">
                        <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $room->image.".".$room->ext_image ?>" width = "300px"><br />
                        <input type="file" name="userfile" class="form-control">
                        <span class="help-block"><?php echo lang("ctn_405") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo "Room Code"?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="code" id="name" value="<?php echo $room->code ?>">
                    </div>
            </div>   

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo "Room Name"?></label>
                    <div class="col-md-9 ui-front">
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $room->name ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo "Type" ?></label>
                    <div class="col-md-9">
                        <select name="idtype" class="form-control">
                        <?php foreach($room_type->result() as $rt) : ?>
                            <option value="<?php echo $rt->id ?>" <?php if($rt->id == $room->idtype) echo "selected" ?>><?php echo $rt->type ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>       

            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo "Status" ?></label>
                    <div class="col-md-9">
                        <select name="idstatus" class="form-control">
                        <?php foreach($room_status->result() as $rs) : ?>
                            <option value="<?php echo $rt->id ?>" <?php if($rs->id == $room->idstatus) echo "selected" ?>><?php echo $rs->status ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-3 label-heading"><?php echo lang("ctn_399") ?></label>
                    <div class="col-md-9">
                        <textarea name="description" id="project-descriptionroom"><?php echo $room->description ?></textarea>
                    </div>
            </div>
         
            
<input type="submit" class="btn btn-primary btn-sm form-control" value="<?php echo lang("ctn_434") ?>" />
<?php echo form_close()  ?>
</div>
</div>

</div>


<!-- ======================Image====================== -->
<div class="white-area-content">

  <div class="db-header clearfix">
      <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo "Facility Images" ?></div>
      <div class="db-header-extra"> <?php if($this->common->has_permissions(array("admin", "content_manager"), $this->user)) : ?><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addModal"><?php echo "Add Image" ?></button><?php endif; ?>
      </div>
  </div>

  <table class="table table-hover table-bordered table-striped">
  <tr class="table-header">
    <td><?php echo "Image" ?></td>
    <td><?php echo "Name" ?></td>
    <td><?php echo lang("ctn_52") ?></td>
  </tr>
  <?php foreach($image->result() as $img) : ?>
    <tr>
    <td><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $img->image."_50x50.".$img->ext_image ?>" class="content-category"></td>
    <td><?php echo $img->name ?></td> 
    <td><a href="<?php echo site_url("backend/hotel/accomodation/edit_image/" . $img->id) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_55") ?>"><span class="glyphicon glyphicon-cog"></span></a> <a href="<?php echo site_url("backend/hotel/accomodation/delete_image/" . $img->id . "/" .$room->id. "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_317") ?>')" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_57") ?>"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
  <?php endforeach; ?>
  </table>

</div>

<!-- ================modal Image ==================-->
<?php if($this->common->has_permissions(array("admin", "content_manager"), $this->user)) : ?>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <?php echo "Add Image" ?></h4>
      </div> 
      <div class="modal-body">
         <?php echo form_open_multipart(site_url("backend/hotel/accomodation/add_image"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_81") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="name" value="">
                    </div>
            </div>
             <input type="hidden" name="idroom" value ="<?php echo $room->id ?>">  
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_430") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="file" class="form-control" name="userfile">
                        <span class="help-block"><?php echo lang("ctn_431") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_432") ?></label>
                    <div class="col-md-8">
                        <textarea name="desc" id="project-description"></textarea>
                    </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo "Add Image" ?>">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>



<!-- ======================Facility====================== -->
<div class="white-area-content">

  <div class="db-header clearfix">
      <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo "Addons" ?></div>
      <div class="db-header-extra"> 
      </div>
  </div>  

  <div class="">
 <div class="form-group">
                    <div class="col-md-6 col-sm-12 col-xs-12" style="padding-left: 0">
                        <select id="idfacility" class="form-control">
                        <?php foreach($listfacility->result() as $lfct) : ?>
                            <option value="<?php echo $lfct->id ?>"><?php echo $lfct->name ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>            
                    <div class="col-md-1 col-sm-12 col-xs-6 " style="padding-right: 2px;padding-left: 0">
                       <?php if($this->common->has_permissions(array("admin", "content_manager"), $this->user)) : ?><button class="btn btn-primary btn-sm form-control" id="btnselect"><?php echo "Select" ?></button><?php endif; ?>
                    </div>         
                    <div class="col-md-2 col-sm-12 col-xs-6" style="padding-left: 0">
                       <?php if($this->common->has_permissions(array("admin", "content_manager"), $this->user)) : ?><button class="btn btn-warning btn-sm form-control" data-toggle="modal" data-target="#addModalFacility"><?php echo "Addons New" ?></button><?php endif; ?>
                    </div>
            </div>
  </div>

  <br/>         
  <br/>         
  <table class="table table-hover table-bordered table-striped">
  <tr class="table-header headerFacility">
    <td><?php echo "Addons" ?></td>
    <td><?php echo "Description" ?></td>
    <td><?php echo lang("ctn_52") ?></td>
  </tr>
  <?php foreach($facility->result() as $fct) : ?>
    <tr>
      <td><?php echo $fct->name ?></td> 
      <td><?php echo $fct->description ?></td> 
       <td><a href="<?php echo site_url("backend/hotel/accomodation/edit_facility/" . $fct->id) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_55") ?>"><span class="glyphicon glyphicon-cog"></span></a> <a href="<?php echo site_url("backend/hotel/accomodation/delete_facility/" . $fct->id . "/" .$room->id. "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_317") ?>')" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_57") ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
  <?php endforeach; ?>
  </table>

</div>

<!-- ================modal Facility ==================-->
<?php if($this->common->has_permissions(array("admin", "content_manager"), $this->user)) : ?>
<div class="modal fade" id="addModalFacility" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <?php echo "Add Facility" ?></h4>
      </div> 
      <div class="modal-body">
         <?php echo form_open_multipart(site_url("backend/hotel/accomodation/add_newfacility"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_81") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="name" value="">
                    </div>
            </div>
             <input type="hidden" name="idroom" value ="<?php echo $room->id ?>">  
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_432") ?></label>
                    <div class="col-md-8">
                        <textarea name="desc" id="project-descriptionFacility"></textarea>
                    </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo "Add Facility" ?>">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>



<script type="text/javascript">
    var BASE_URL = "<?php echo base_url()?>";
</script>

<script type="text/javascript">
$(document).ready(function() {
CKEDITOR.replace('project-descriptionroom', { height: '150'});

CKEDITOR.replace('project-description', { height: '250'});
CKEDITOR.replace('project-descriptionFacility', { height: '200'});
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

<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', "#btnselect", function() {
          var data = "facilityid="+ $( "#idfacility :selected" ).val()+ "&" + "roomid="+ <?=$room->id;?>;
          
    	   $.ajax({
            url: '<?php echo site_url("backend/hotel/accomodation/add_facilityAjax/") ?>',
            type: 'get',
            dataType: 'json',
            data: data,
            error: function() {
              //callback();
              alert("error"); 
            },
            success: function(res) {
                $(".headerFacility").after(res.list);
            }
        });
    });
});
</script>



