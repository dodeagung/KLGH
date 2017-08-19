<?php
	$plugin_url = base_url()."theme_costume/";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js"></script>


<script>

$(document).ready(function() {
	var idkomentar = "";
	$(document).on('click','.port-post-social', function() {
		//alert("replay comment");
		var form = "<div class='row comments-1 comments-2 formkomentar'> <div class='col-lg-12 col-md-12'> <div class='contact-form' id='contact-form'> <div class='section-field'> <i class='fa fa-user'></i> <input type='text' name='name' placeholder='Name*' > </div><div class='section-field'> <i class='fa fa-envelope-o'></i> <input type='email' name='email' placeholder='Email*' > </div><div class='section-field textarea'> <i class='fa fa-pencil'></i> <textarea name='message' rows='7' placeholder='Comment*' class='input-message'></textarea> </div><a class='button kirimpesan pull-right mt-20' href='javascript:void(0)'> <span>Post comment</span> </a> </div></div></div>";
		
		$(".formkomentar").remove();
		idkomentar = $(this).find("a").data("comment");
		
		//alert(idkomentar);
		$(this).parentsUntil(".comments-1").after(form);
		
		
		
	});	
	$(document).on('click', "a.kirimpesan", function() {
		//alert("masuk");
		var datakomentar = $('.formkomentar :input').serialize();
		var parentid = idkomentar;
		var postid = $("#idpost").val();
		
		var data = "parentid="+ parentid + "&" + "postid="+ postid + "&" + datakomentar;
		$.ajax({
				url: '<?php echo site_url("post/addcomment/") ?>',
				type: 'get',
				dataType: 'json',
				data: data,
				error: function() {
					//callback();
					alert("error"); 
				},
				success: function(res) {
					//callback(res);
					//console.log(res.arrItem);
					if(res.success == "TRUE"){
						$(".komenblock").remove();
						var komen = '<div class="blog-comments mt-40 komenblock">' + res.comment + '</div>'
						$(".formkomenUtama").after(komen);
					}else{
						$.alert({
							title: 'Alert!',
							content: res.message
						});
					}				
				}
		});
    });
	
	$(document).on('click', "a.replyformkomenUtama", function() {
		//alert("masuk");
		
		var datakomentar = $('.formkomenUtama :input').serialize();
		var name = ($('#name').val() == $('#name').attr('placeholder'))?'':$('#name').val();
		var email = ($('#email').val() == $('#email').attr('placeholder'))?'':$('#email').val();
		var message = ($('#message').val() == $('#message').attr('placeholder'))?'':$('#message').val();
		var parentid = 0;
		var postid = $("#idpost").val();
		
		
		var data = "parentid="+ parentid + "&" + "postid="+ postid + "&" + "name="+name+ "&" + "email="+ email+ "&"+ "message=" + message;
		$.ajax({
				url: '<?php echo site_url("post/addcomment/") ?>',
				type: 'get',
				dataType: 'json',
				data: data,
				error: function() {
					//callback();
					alert("error"); 
				},
				success: function(res) {
					//callback(res);
					//console.log(res.arrItem);
					if(res.success == "TRUE"){
						$(".komenblock").remove();
						$('#message').attr('placeholder', "Comment*");
						var komen = '<div class="blog-comments mt-40 komenblock">' + res.comment + '</div>'
						$(".formkomenUtama").after(komen);
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


</script>
