    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#inputData" id="tombolTambah"><i
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
                                        <th>Nik</th>
                                        <th>Jenis Kelamin (P/W)</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
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
        "ajax": {
            "url": "<?php echo base_url('people/getData') ?>",
            "type": "POST",
            "data": function(d) {
                d.type = 1 // Menambahkan parameter tambahan
            }
        },
        "searchDelay": 500,
        "columns": [
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "nama" },
            { "data": "nik" },
            // { "data": "jenis_kelamin" },
            {
                "data": null,
                "render": function (data, type, row) {
                    if(row.jenis_kelamin == 'P'){
                        kelamin = 'Laki-Laki';
                    }else{
                        kelamin = 'Perempuan';
                    }
                    return kelamin;
                }
            },
            { "data": "tempat_lahir" },
            { "data": "tanggal_lahir" },
            {
                "data": null,
                "className": 'text-center',
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id+'"><i class="fas fa-wrench"></i></button> ' +
                           '<button class="btn btn-danger btn-delete btn-sm" data-id="'+row.id+'"><i class="fas fa-trash"></i></button>';
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
            url: '<?php echo base_url('people/getDataById') ?>',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                var data = JSON.parse(response);
                // console.log(data);
                $('#idEdit').val(data.id);
                $('#namaEdit').val(data.nama);
                $('#alamatEdit').val(data.alamat);
                $('#nikEdit').val(data.nik);
                $('#tanggal_lahirEdit').val(data.tanggal_lahir);
                $('#tempat_lahirEdit').val(data.tempat_lahir);
                $('#no_telpEdit').val(data.no_telp);
                $('#jenis_kelaminEdit').find(':radio[name=jenis_kelamin][value="'+data.jenis_kelamin+'"]')
                .prop('checked', true);
            }
        });

        $("#editData").modal('show');
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('people/updateData') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data.status);
                // console.log(response.status);
                if(data.status){
                    $('#editData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                }
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        if (confirm("Are you sure !") == true) {
            $.ajax({
                url: '<?php echo base_url('people/deleteData') ?>',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data.status);
                    // console.log(response.status);
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
    
    $('#tombolTambah').on('click',function () {
        $('#type').val(1);
    });
});
</script>