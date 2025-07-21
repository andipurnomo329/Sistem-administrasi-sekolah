    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle . " " . date('Y'); ?></h1>
            
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
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $pageTitle; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama kelas</th>
                                        <th>Tingkat</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Ajaran</th>
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
            "url": "<?php echo base_url('kelas/getData/') ?>",
            "type": "POST",
            "data": function(d) {
                d.tahun_ajaran = '<?php echo date("Y"); ?>';
                d.inOut = '<?php echo $inOut; ?>' // Menambahkan parameter tambahan
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
            { "data": "nama_kelas" },
            { "data": "tingkat","width": "10%"},
            { "data": "jurusan" },
            { "data": "tahun_ajaran" },
            {
                "data": null,
                "className": 'text-center',
                "width": "15%",
                "render": function (data, type, row) {
                    return '<a href="<?php echo base_url('kelas/detail/') ?>'+row.id_kelas+'" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" ><i class="fas fa-eye"></i></a>';
                }
            }
        ]
    });

    $('#inputForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('kelas/addNewTask') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                // console.log(data.status);
                // console.log(response.status); 
                if(data.status){
                    $('#inputData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    alert('Data Berhasil Ditambah')
                }
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('kelas/getDataById') ?>',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                $('#idEdit').val(data.id_kelas);
                $('#namaEdit').val(data.nama_kelas);
                $('#tingkatEdit').val(data.tingkat);
                $('#jurusnEdit').val(data.jurusan);
                $('#tahunAjaranEdit').val(data.tahun_ajaran);
            }
        });

        $("#editData").modal('show');
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('kelas/updateData') ?>',
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

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        if (confirm("Are you sure !") == true) {
            $.ajax({
                url: '<?php echo base_url('kelas/deleteData') ?>',
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
    });
    
    $('#searchButton').on('click',function () {
        $('#SearchData').modal('show');
        $('#myTable2').removeAttr('style');
    });

});
</script>