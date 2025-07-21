    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#inputData"><i
                    class="fas fa-download fa-sm text-white-50"></i> Input <?php echo $pageTitle; ?></a>
        </div>
        
        <div class="row">
            <?php
                $flash_message = $this->session->flashdata();
                if ($flash_message) {
                    $type = isset($flash_message['success']) ? 'success' : 'danger';
                    $message = isset($flash_message['success']) ? $flash_message['success'] : $flash_message['error'];
                ?>
                    <div class="alert alert-<?= $type ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?= $message; ?>
                    </div>
            <?php } ?>
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
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Creted Date</th>
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
    
    var table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ajax": {
            "url": "<?php echo base_url('roles/getList/') ?>",
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
            { "data": "role" },
            {
                "data": null,
                "className": 'text-center',
                "width": "15%",
                "render": function (data, type, row) {
                    if(row.status == 1){
                        wording = 'Active';
                        color = 'success';
                    }else{
                        wording = 'Inactive';
                        color = 'danger';
                    }
                    return '<button class="btn btn-'+color+' btn-sm" ">'+wording+'</button> ';
                }
            },
            { "data": "createdDtm"},
            {
                "data": null,
                "className": 'text-center',
                "width": "15%",
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.roleId+'"><i class="fas fa-wrench"></i></button> ' +
                            '<button class="btn btn-success btn-add btn-sm" data-id="'+row.roleId+'"><i class="fas fa-plus"></i></button> ' +
                           '<button class="btn btn-danger btn-delete btn-sm" data-id="'+row.roleId+'" data-nama="'+row.role+'"><i class="fas fa-trash"></i></button> ' ;
                }
            }
        ]
    });
    $('#myTable_filter input').unbind().bind('input', function(e) {
        var value = $(this).val();
        // if (value.length < 3) return;  
        table.search(value).draw();

    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('roles/getRowById') ?>',
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
            url: '<?php echo base_url('roles/addRoles') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                if(data.status){
                    $('#inputData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    // alert('Update Data Berhasil')
                }
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('roles/getRowById') ?>',
            type: 'POST',
            data: {roleId: id},
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                $('#roleEdit').val(data.role);
                $('#statusEdit').val(data.status);
            }
        });

        $("#editData").modal('show');
    });
    
    $('#myTable tbody').on('click', '.btn-add', function () {
        var roleId = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('menu/getMenuByRole') ?>',
            type: 'POST',
            data: {roleId: roleId},
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                var tbody = $('#bodyTableDraw');
                tbody.empty();

                // Tambahkan data ke tabel
                data.forEach((item, index) => {
                    var canView = item.canView ? '<input type="checkbox" checked>' : '<input type="checkbox">';
                    var canCreate = item.canCreate ? '<input type="checkbox" checked>' : '<input type="checkbox">';
                    var canUpdate = item.canUpdate ? '<input type="checkbox" checked>' : '<input type="checkbox">';
                    var canDelete = item.canDelete ? '<input type="checkbox" checked>' : '<input type="checkbox">';
                    var dis = item.tmrId !== null && item.tmrId !== undefined ? '' : 'disabled';

                    var row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.nama}</td>
                        <td class="text-center">${item.parent_id}</td>
                        <td class="text-center"><input type="checkbox" class="update-permission" data-tmrId="${item.tmrId}" data-menuid="${item.tmId}" data-roleid="${roleId}" data-action="canView" ${item.canView == 1 ? 'checked' : ''}></td>
                        <td class="text-center"><input type="checkbox" class="update-permission" data-tmrId="${item.tmrId}" data-menuid="${item.tmId}" data-roleid="${roleId}" data-action="canCreate" ${item.canCreate == 1 ? 'checked' : ''} ${dis}></td>
                        <td class="text-center"><input type="checkbox" class="update-permission" data-tmrId="${item.tmrId}" data-menuid="${item.tmId}" data-roleid="${roleId}" data-action="canUpdate" ${item.canUpdate == 1 ? 'checked' : ''} ${dis}></td>
                        <td class="text-center"><input type="checkbox" class="update-permission" data-tmrId="${item.tmrId}" data-menuid="${item.tmId}" data-roleid="${roleId}" data-action="canDelete" ${item.canDelete == 1 ? 'checked' : '' } ${dis}></td>
                    </tr>`;

                    tbody.append(row);
                });
            }
        });

        $("#addMenu").modal('show');
    });

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var ids = $(this).data('id');
        if (confirm("konfirmasi hapus data "+$(this).data('nama')+' !!') == true) {
            $.ajax({
                url: '<?php echo base_url('roles/deleteRole') ?>',
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
    $('#tableMenuList').on('change', '.update-permission', function () {
        // jeda();
        var checkbox = $(this);
        var menuId = checkbox.data('menuid');
        var tmrId = checkbox.data('tmrid');
        var roleId = checkbox.data('roleid');
        var action = checkbox.data('action');
        var value = checkbox.is(':checked') ? 1 : 0;

        $.ajax({
            url: '<?php echo base_url('menu/updatePermission') ?>',
            type: 'POST',
            data: {
                menuId: menuId,
                tmrId: tmrId,
                roleId: roleId,
                action: action,
                value: value
            },
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                document.querySelectorAll('input[data-menuid="'+menuId+'"]').forEach(function(checkbox) {
                    checkbox.removeAttribute('disabled');
                    checkbox.setAttribute('data-tmrid', data); 
                });

            },
            error: function(xhr, status, error) {
                console.error('Error updating permission:', error);
                // Optionally, revert the checkbox state on error
                checkbox.prop('checked', !value);
            }
        });
    });
    $('#searchButton').on('click',function () {
        $('#SearchData').modal('show');
        $('#myTable2').removeAttr('style');
    });
});
</script>