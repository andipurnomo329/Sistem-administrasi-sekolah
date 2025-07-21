    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Input <?php echo $pageTitle; ?></a>
        </div>

        <div class="row">            
            <!-- Approach -->
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data <?php echo $pageTitle; ?> </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Deskripsi</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- <script src="<?php echo base_url(); ?>assets/sb2/js/demo/datatables-demo.js"></script> -->
<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('param/getData') ?>",
            "type": "POST"
        },
        "searchDelay": 500,
        "columns": [
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "title" },
            { "data": "description" },
            {
                "data": null,
                "className": 'text-center',
                "render": function (data, type, row) {
                    if(row.id > 14){
                        button = '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id+'"><i class="fas fa-wrench"></i></button> ' +
                            '<button class="btn btn-danger btn-delete btn-sm" data-id="'+row.id+'"><i class="fas fa-trash"></i></button>';
                    }else{
                        button = '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id+'"><i class="fas fa-eye"></i></button> '
                    }
                    return button;
                }
            }
        ]
    });
    
    $('#myTable_filter input').unbind().bind('input', function(e) {
        var value = $(this).val();
        if (value.length >= 3) {
            table.search(value).draw();
        } else {
            table.search('').draw();
        }
    });
    $('#myTable tbody').on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        // Tambahkan logika untuk mengedit data
        alert('Edit ID: ' + id);
    });

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        // Tambahkan logika untuk menghapus data
        alert('Delete ID: ' + id);
    });
});
</script>