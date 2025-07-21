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
                        <h6 class="m-0 font-weight-bold text-primary">List <?php echo $pageTitle; ?> </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>NIS</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Nama Wali</th>
                                        <th>Foto</th>
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
    var control = 'murid' ;
    koloms =[
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "className": 'text-center',
                "width": "5%"
            },
            { "data": "nama" },
            { "data": "nis","width": "10%"},
            { "data": "tanggal_lahir" },
            { "data": "namaWaliMurid" },
            {
                "data": null,
                "className": 'text-center',
                "width": "8%",
                "render": function (data, type, row) {
                    return '<img class="img-fluid " style="width: 3rem;" src="<?php echo base_url().'files/murid/'; ?>'+row.foto+'">';

                }
            },
            {
                "data": null,
                "className": 'text-center',
                "width": "15%",
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id+'"><i class="fas fa-wrench"></i></button> ' +
                            '<a href="<?php echo base_url('murid/detailMurid/') ?>'+row.id+'" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" ><i class="fas fa-eye"></i></a> ' +
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

        var formData = new FormData(this);

        $.ajax({
            url: '<?php echo base_url() ?>'+control+'/addNewTask',
            type: 'POST',
            data: formData,
            contentType: false,  
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response) {
                // var data = JSON.parse(response);
                console.log(response);
                let notifikasi;
                if (response.status) {
                    notifikasi = notifInput('success', 'Input Siswa <b>'+response.data.nama+'</b> berhasil !!');
                    $('#inputData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    $('#inputForm')[0].reset();
                    $('#showUpload').html('');
                } else {
                    notifikasi = notifInput('danger', 'Input gagal, silakan coba lagi');
                    $('#notif').html(notifikasi);
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
                // console.log(data);
                $.each(data, function (key, value) {
                    $('#edit_'+key+'').val(value);
                });
                document.getElementById('previewImage').src = "<?php echo base_url().'files/murid/'; ?>"+data.foto;
                $('#img-edit').html(foto);
                $('#edit_jenis_kelamin').find(':radio[name=jenis_kelamin][value="'+data.jenis_kelamin+'"]').prop('checked', true);
                $('#edit_agama').val(data.agama).trigger('change');
            }
        });

        $("#editData").modal('show');
    });

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: '<?php echo base_url() ?>'+control+'/deleteData',
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function(response) {                
                // console.log(response);
                if(response.status){
                    $('#myTable').DataTable().ajax.reload();
                    notifikasi = notifInput('success', 'Delete Data Siswa berhasil !!');
                }
            }
        });
    }); 
    
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '<?php echo base_url() ?>'+control+'/updateData',
            type: 'POST',
            data: formData,
            contentType: false,  
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response) {                
                // console.log(response);
                if(response.status){
                    $('#editData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    notifikasi = notifInput('success', 'Update Siswa <b>'+response.data.nama+'</b> berhasil !!');
                }
            }
        });
    });
    $('#foto').on('change', function (event) {
        var file = event.target.files[0]; // Ambil file pertama
        
        if (file) {
            var reader = new FileReader(); // Buat reader untuk membaca file
            
            reader.onload = function (e) {
                // Menampilkan preview gambar di #showUpload
                $('#showUpload').html(`
                    <img src="${e.target.result}" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
                `);
            }
            reader.readAsDataURL(file); // Konversi file ke format Data URL
        }
    });
});
</script>