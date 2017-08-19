

$(document).ready(function() {
	$(document).on('keyup', "#title", function() {
		
		var titlestring = $("#title").val();

		$.ajax({
				url:  BASE_URL +"backend/content/create_link/",
				type: 'get',
				dataType: 'json',
				data: "title=" +titlestring,
				error: function() {
					//callback();
					alert("error"); 
				},
				success: function(res) {
					//callback(res);
					//console.log(res.arrItem);
					if(res.success == "TRUE"){
						$("#slug").val(res.link);
					}else{
						$.alert({
							title: 'Alert!',
							content: res.message
						});
					}				
				}
		});
    });
});
