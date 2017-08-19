<div class="white-area-content">
  <div class="row">

  <!-- CANVAS -->
  <div class="col-md-3">
  <div class="panel panel-info">
    <div class="panel-heading"> <?php echo "Room Setting" ?></div>
    <div class="panel-body" id="roomSetting"> 
                <div class="form-group">
                        <label for="room" class="col-md-12 label-heading"><?php echo "Room" ?></label>
                        <div class="col-md-12">
                          <select class="form-control" name="room">
                            <option value=""> -- please select room first --</option>
                              <?php foreach ($roomDomainArray as $houseName => $rooms): ?>
                                  <optgroup label="<?php echo $houseName ?>">
                                   <?php foreach ($rooms as $roomDomain) : ?>
                                        <option value="<?php echo $roomDomain["id"] ?>"><?php echo $roomDomain["code"] ?></option>
                                   <?php endforeach ?>
                                  </optgroup>
                              <?php endforeach ?>
                           </select>
                        </div>
                </div>       

                <div class="form-group">
                        <label for="status" class="col-md-12 label-heading"><?php echo "Status" ?></label>
                        <div class="col-md-12">
                            <select class="form-control" name="status">
                             <option value="block">Block Room</option>
                             <option value="active">Active</option>
                             <option value="renovation">Renovation</option>
                            </select>
                        </div>
                </div>
                <div class="form-group">
                        <label for="price" class="col-md-12 label-heading"><?php echo "Price"?></label>
                        <div class="col-md-12 ui-front">
                            <input type="text" name="price" value="" class="form-control" placeholder="0.00" />
                        </div>
                </div>           

                <div class="form-group">
                        <label for="price" class="col-md-12 label-heading"></label>
                        <div class="col-md-12 ui-front">
                            <input type="button" class="btn btn-primary btn-sm form-control" id="update" value="<?php echo "Update" ?>" />
                        </div>
                </div>
                <hr>
             
    </div>
  <div class="panel panel-info panel-room-info">
    <div class="panel-heading"> <?php echo "Room Color Info" ?></div>
    <div class="panel-body" id="roomSetting"> 

      <div class="form-group">
        <label for="price" class="col-md-12 label-heading"></label>
        <div class="col-md-12 ui-front">
         <div class="btn booked-in" style="width: 100%;height: 30px">Check In</div>
        </div>         
      </div>   

      <div class="form-group">
        <label for="price" class="col-md-12 label-heading"></label>
        <div class="col-md-12 ui-front">
          <div class="btn booked-out" style="width: 100%;height: 30px">Check Out</div>
       </div>         
      </div>     
       <div class="form-group">
        <label for="price" class="col-md-12 label-heading"></label>
        <div class="col-md-12 ui-front">
           <div class="btn booked" style="width: 100%;height: 30px">Booked Room</div>
       </div>         
      </div>     
       <div class="form-group">
        <label for="price" class="col-md-12 label-heading"></label>
        <div class="col-md-12 ui-front">
             <div class="btn blocking" style="width: 100%;height: 30px">Blocking Room</div>
       </div>         
      </div>   
      <div class="form-group">
        <label for="price" class="col-md-12 label-heading"></label>
        <div class="col-md-12 ui-front">
             <div class="btn renov" style="width: 100%;height: 30px">Renovation Room</div>
       </div>         
      </div>
      
       
    </div>  
  </div>  
  </div>  
</div>  

<div class="col-md-9">
  <div class="panel panel-info">
    <div class="panel-heading"> <?php echo "Room Calender" ?></div>
    <div class="panel-body" id="calendarData">
       <p style="text-align:center">Please select room first.</p>
    </div>

  </div>  
</div>

  </div>


  </div>
