    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#inputData"><i
                    class="fas fa-download fa-sm text-white-50"></i> Input <?php echo $pageTitle; ?></a>
        </div>
        
        <div id='notif'></div>
        <div class="row">            
            <!-- Approach -->
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $pageTitle; ?> </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mata Pelajaran</th>
                                        <th>Keterangan</th>
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
</div>
<script>
$(document).ready(function() {
    var control = 'mapel' ;
    koloms = [
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "className": 'text-center',
                "width": "5%"
            },
            { "data": "nama" },
            { "data": "keterangan"},
            {
                "data": null,
                "className": 'text-center',
                "width": "15%",
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id+'"><i class="fas fa-wrench"></i></button> ' +
                           '<button class="btn btn-danger btn-delete btn-sm" data-id="'+row.id+'"><i class="fas fa-trash"></i></button> ' ;
                }
            }
        ];

    var table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url() ?>"+control+"/getData/",
            "type": "POST"
        },
        "searchDelay": 500,
        "columns": koloms
    });

    $('#inputForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url() ?>'+control+'/addNewTask',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                // console.log(response.status); 
                if(data.status){
                    $('#inputData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    $('#inputForm')[0].reset();
                    notifikasi = notifInput('success', 'Input  Mata Pelajaran <b>'+ data.data.nama+'</b> berhasil !!');
                }
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url() ?>'+control+'/getDataById',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                $.each(data, function (key, value) {
                    $('#'+key+'_edit').val(value);
                });
            }
        });

        $("#editData").modal('show');
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url() ?>'+control+'/updateData',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data.status);
                // console.log(response.status);
                if(data.status){
                    $('#editData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    notifikasi = notifInput('success', 'Edit  Mata Pelajaran <b>'+ data.data.nama+'</b> berhasil !!');
                }
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        if (confirm("Are you sure !") == true) {
            $.ajax({
                url: '<?php echo base_url() ?>'+control+'/deleteData',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);
                    // console.log(response.status);
                    if(data.status){
                        $('#myTable').DataTable().ajax.reload();
                        notifikasi = notifInput('success', 'Delete  Mata Pelajaran <b>'+ data.data.nama+'</b> berhasil !!');
                    }
                }
            });
        } else {
            alert('cancel Delete ID: ' + id);
            
        }
    });
    
    $('#searchButton').on('click',function () {
        $('#SearchData').modal('show');
        $('#myTable2').removeAttr('style');
    });

});
</script>