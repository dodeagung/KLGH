

<script src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>
<script>
$(document).ready(function() {

   var st = $('#search_type').val();
    var table = $('#lsp-table').DataTable({
      "responsive": true,
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
				"order": [
          [3, "desc" ]
        ],
        "columns": [
        null,
        null,
        null,
        null],
        "ajax": {
            url : "<?php echo site_url("tuk/table_tuk") ?>",
            type : 'GET',
            data : function ( d ) {
                d.search_type = $('#search_type').val();
            }
        },
        "drawCallback": function(settings, json) {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
    $('#form-search-input').on('keyup change', function () {
    table.search(this.value).draw();
});

} );
function change_search(search)
    {
      var options = [
        "search-like",
        "search-exact",
      ];
      set_search_icon(options[search], options);
        $('#search_type').val(search);
        $( "#form-search-input" ).trigger( "change" );
    }

function set_search_icon(icon, options)
    {
      for(var i = 0; i<options.length;i++) {
        if(options[i] == icon) {
          $('#' + icon).fadeIn(10);
        } else {
          $('#' + options[i]).fadeOut(10);
        }
      }
    }


</script>
