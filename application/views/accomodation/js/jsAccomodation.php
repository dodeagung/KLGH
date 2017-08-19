<?php
	$plugin_url = base_url()."theme_backend/";
?>


<script type="text/javascript" src="<?php echo $plugin_url; ?>scripts/libraries/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo $plugin_url; ?>scripts/libraries/calendar.otakita.js"></script>
<script>

			//add selectable function here as well
			//ANOTHER SOLUTION, bikinkan icon untuk ambil element agar bisa di drag 
			$(document).on("dragstart", ".calendar-selected", function (event) {
						//
						  var dt = event.originalEvent.dataTransfer;
						  dt.setData('classAwal', $(this).attr('class'));
						  dataOri = "containingBlock     calendar-active calendar-selected"; 

						  $(this).removeAttr('class');
						  $(this).attr('class', dataOri);
						  
						  $(this).children().first().removeAttr('class');
						  $(this).children().first().attr('class', "day");

						  $(this).children().last().removeAttr('class');
						  $(this).children().last().attr('class', "price");
						});
				    $(document).on("dragenter dragover drop",".calendar-active", function (event) {	
					   event.preventDefault();
					   if (event.type === 'drop') {

						  var data = event.originalEvent.dataTransfer.getData('classAwal',$(this).attr('class'));

						  de=$('#'+data).detach();
						  $(this).removeAttr('class');
						  $(this).attr('class', data);

						  //add Ajax to update the server HERE!!!
				   };
			 });
      	
            // currentDate format mm-yyyy, start jan is 0 and dec is 11
            var currentDate = <?php echo $currentDateval;?>;
            var cal;


            $(document).on("click", "#update", function() {
            	roomId = $("select[name=room]").val();
                roomStatus = $("select[name=status]").val();
                roomPrice = $("input[name=price]").val();

                var calendarSelected = "";
                $.each($(".calendar-selected"), function( index, value, as ) {
                    calendarSelected += $(value).attr("data-value")+",";
                });
                calendarSelected = calendarSelected.replace(/,+$/,"");

                $.ajax({
                    url: "update_plan",
                    data: {room_id:roomId,room_status:roomStatus,room_price:roomPrice,calendar_selected:calendarSelected,current_date:currentDate},
                    type: "get",
                    success: function(data) {
                        json = jQuery.parseJSON(data);
                        if (json.status == "false") {
                            alert(json.message);
                        } else {
                            cal = new Calendar(json.dataEvent, json.month, json.year);
                            cal.generateHTML();
                            $("#calendarData").html(cal.getHTML());
                        }
                        $("#roomSetting").unblock();
                        $("#calendarData").unblock();
                    },
                    beforeSend: function(){
                        $("#roomSetting").block({ message: null });
                        $("#calendarData").block({ message: null });
                    }
                });
            });

            $("select[name=room]").change(function() {
                roomId = $(this).val();
                $.ajax({
                    url: "get_room",
                    data: {room_id:roomId},
                    type: "get",
                    success: function(data) {
                        json = jQuery.parseJSON(data);
                        if (json.status == "false") {
                            alert(json.message);
                            $("#calendarData").html("<p style=\"text-align:center\">Please select room first.</p>");
                        } else {
                        	//the magic generateHTML start here!
                            $("#update").prop("disabled", false);
                            cal = new Calendar(json.dataEvent, json.month, json.year);
                            cal.generateHTML();
                            $("#calendarData").html(cal.getHTML());
                        }
                        $("#roomSetting").unblock();
                        $("#calendarData").unblock();
                    },
                    beforeSend: function() {
                        $("#update").prop("disabled", true);
                        $("#roomSetting").block({ message: null });
                        $("#calendarData").block({ message: null });
                    }
                });
            });

            $(document).on("click", ".calendar-nav", function(e) {
                e.preventDefault();
                roomId = $("select[name=room]").val();
                var month = $(this).attr("data-month");
                var year = $(this).attr("data-year");
                $.ajax({
                    url: "get_navigate",
                    data: {room_id:roomId, month:month, year:year},
                    type: "get",
                    success: function(data) {
                        json = jQuery.parseJSON(data);
                        if (json.status == "false") {
                            alert(json.message);
                        } else {
                            currentDate = json.month+"-"+json.year;
                            cal = new Calendar(json.dataEvent, json.month, json.year);
                            cal.generateHTML();
                            $("#calendarData").html(cal.getHTML());
                        }
                        $("#roomSetting").unblock();
                        $("#calendarData").unblock();
                    },
                    beforeSend: function() {
                        $("#roomSetting").block({ message: null });
                        $("#calendarData").block({ message: null });
                    }
                });
            });
        
        /*
            Javascript use for manage drag/select block calendar
            For first click, it will release all selected calendar
        */
           var isDragging = false;
            var isClicking = false;
            var firstRange = "";
            var secondRange = "";

            $(document).on("mouseover", ".calendar-active", function() {
                $(this).mousedown(function() {
                    isClicking = true;
                    firstRange = $(this).attr("data-value");
                    $(".calendar-selected").removeClass("calendar-selected");
                    if ($(this).hasClass("calendar-selected")) {
                        $(this).removeClass("calendar-selected");
                    }
                    else {
                        $(this).addClass("calendar-selected");
                        $(".log").append("<li>" + $(this).attr("data-value") + "</li>");
                    }
                })
                .mousemove(function() {
                    if (isClicking) {
                        isDragging = true;
                        if (!$(this).hasClass("calendar-selected")) {
                            $(this).addClass("calendar-selected");
                            $(".log").append("<li>" + $(this).attr("data-value") + "</li>");
                        }
                    }
                })
                .mouseup(function(e) {
                    isDragging = false;
                    isClicking = false;
                });
            });

            function str_pad(data) {
                var str = "" + data;
                var pad = "00";
                return pad.substring(0, pad.length - str.length) + str;
            }
</script>
