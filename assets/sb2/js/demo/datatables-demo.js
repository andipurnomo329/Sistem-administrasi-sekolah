// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
  $('#myTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "<?php echo base_url('param/getData') ?>",
          "type": "POST"
      },
      "columns": [
          { "data": "id" },
          { "data": "title" },
          { "data": "description" },
          {
            "data": null,
            "render": function (data, type, row) {
                return '<button class="btn btn-primary btn-edit" data-id="'+row.id+'">Edit</button> ' +
                       '<button class="btn btn-danger btn-delete" data-id="'+row.id+'">Delete</button>';
            }
        }
      ]
  });
});

