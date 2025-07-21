    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#inputData"><i
                    class="fas fa-download fa-sm text-white-50"></i> Input <?php echo $pageTitle; ?></a>
        </div>
        
        <div class="row">
            <div class="col-md-12" id='infoProses'>
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
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
                                        <th>Nama</th>
                                        <th>role</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
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

<script>
$(document).ready(function() {
    $.ajax({
        url: '<?php echo base_url('roles/getData') ?>',
        type: 'POST',
        data: {isDeleted: 0},
        success: function(response) {
            var data = JSON.parse(response);
            // console.log(response);
            const selectElement = document.getElementById('roleList');
            const selectEditElement = document.getElementById('roleListEdit');
            option = [];
            data.forEach( role => {
                const option1 = document.createElement('option');
                option1.value = role.roleId;
                option1.text = role.role;
                
                // Buat elemen option untuk roleListEdit
                const option2 = document.createElement('option');
                option2.value = role.roleId;
                option2.text = role.role;

                // Tambahkan masing-masing option ke selectElement dan selectEditElement
                selectElement.appendChild(option1);
                selectEditElement.appendChild(option2);
            });
        }
    });
    var table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('user/getData/') ?>",
            "type": "POST",
            "data": function(d) {
                d.param = 1,
                d.inOut = 1 // Menambahkan parameter tambahan
            }
        },
        "searchDelay": 500,
        "columns": [
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "className": 'text-center',
                "width": "5%"
            },
            { "data": "name" },
            { "data": "role" },
            { "data": "email","width": "10%"},
            { "data": "mobile" },
            {
                "data": null,
                "className": 'text-center',
                "width": "15%",
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.userId+'"><i class="fas fa-wrench"></i></button> ' +
                           '<button class="btn btn-danger btn-delete btn-sm" data-id="'+row.userId+'" data-nama="'+row.name+'"><i class="fas fa-trash"></i></button> ' ;
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
        $.ajax({
            url: '<?php echo base_url('user/getRowById') ?>',
            type: 'POST',
            data: {userId: id},
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                $('#nameEdit').val(data.name);
                $('#emailEdit').val(data.email);
                $('#mobileEdit').val(data.mobile);
                $('#roleListEdit').val(data.roleId);
                $('#isAdminEdit').val(data.isAdmin);
            }
        });

        $("#editData").modal('show');
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('transaksi/updateData') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data.status);
                // console.log(response.status);
                if(data.status){
                    $('#editData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    alert('Update Data Berhasil')
                }
            }
        });
    });

    $('#addTask').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('user/addNewUser2') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                if(data.status){
                    $('#inputData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    alert('Update Data Berhasil')
                }
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var ids = $(this).data('id');
        if (confirm("konfirmasi hapus data "+$(this).data('nama')+' !!') == true) {
            $.ajax({
                url: '<?php echo base_url('user/deleteUser') ?>',
                type: 'POST',
                data: {id: ids},
                success: function(response) {
                    var data = JSON.parse(response);
                    if(data.status){
                        $('#myTable').DataTable().ajax.reload();
                    }
                }
            });
        } else {
            alert('cancel Delete ID: ' + id);
            
        }
        // Tambahkan logika untuk menghapus data
    });
    
    $('#searchButton').on('click',function () {
        $('#SearchData').modal('show');
        $('#myTable2').removeAttr('style');
    });
});
</script>