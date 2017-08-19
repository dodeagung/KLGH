<?php
	$plugin_url = base_url()."theme_costume/";
?>

<script src="<?php echo $plugin_url; ?>js/icheck.js"></script>
<script src="<?php echo $plugin_url; ?>js/jquery.validate.js"></script>
<script src="<?php echo $plugin_url; ?>plugin/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $plugin_url; ?>plugin/selectize.js-master/dist/js/standalone/selectize.js"></script>



<script>

$(document).ready(function() {


	$('#birth_apply').datepicker({
			format: 'dd/mm/yyyy',
			   autoclose: true
			});






	$('input').iCheck({
	   checkboxClass: 'icheckbox_square-blue',
	   radioClass: 'iradio_square-blue'
	 });

	  $("#apply_online").validate({
			ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input'
 		});

	$('#skemajabatan_apply').selectize({
    valueField: 'id',
    labelField: 'text',
    searchField: 'text', //perhatikan disini, mau ngesearch pake text apa id
    options: [],
    create: true,
		render: {
        option: function(item,escape) {

					return '<div> <span class="name">' + escape(item.text) + '</span></div>';
        },
				option_create: function(data, escape) {
					return '<div class="create">Tambahkan > <strong>' + escape(data.input) + '</strong>&hellip;</div>';
				}
    },
    load: function(query, callback) {
        //if (!query.length) return callback();
        $.ajax({
            url: '<?php echo site_url("backend/registrasi/getskema") ?>',
            type: 'get',
            dataType: 'json',
            data: {
								q: query,
								page_limit: 10
            },
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
                //console.log(res.arrItem);
            }
        });
    }

})

	var lnk2="<?php echo base_url().'registrasi/getperusahaan' ?>";

	$('#company_apply').selectize({
    valueField: 'id',
    labelField: 'text',
    searchField: 'text', //perhatikan disini, mau ngesearch pake text apa id
    options: [],
    create: true,
		render: {
        option: function(item,escape) {
					return '<div>' +
					                ('<span class="name">' + escape(item.text) + '</span>') +
					            '</div>';
        },
				option_create: function(data, escape) {
					return '<div class="create">Tambahkan > <strong>' + escape(data.input) + '</strong>&hellip;</div>';
				}
    },
    load: function(query, callback) {
        //if (!query.length) return callback();
        $.ajax({
            url: lnk2,
            type: 'get',
            dataType: 'json',
            data: {
								q: query,
								page_limit: 10
            },
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
                //console.log(res.arrItem);
            }
        });
    }

})
})


</script>
