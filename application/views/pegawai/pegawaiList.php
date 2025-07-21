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
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $pageTitle; ?> </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>NIP</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Jenis Kelamin</th>
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
    var control = 'pegawai',
    table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '<?php echo base_url() ?>' + control + '/getData',
            "type": "POST",
            "data": function(d) {
                d.param = <?php echo $param; ?>,
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
            { "data": "nama" },
            { "data": "nik"},
            { "data": "nip" },
            { "data": "tanggal_masuk" },
            { 
            "data": "jenis_kelamin", 
            "render": function(data, type, row) {
                return data === 'P' ? 'Laki-laki' : data === 'W' ? 'Perempuan' : 'Tidak Diketahui';
                }
            },
            {
                "data": null,
                "className": 'text-center',
                "width": "15%",
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id_pegawai+'"><i class="fas fa-wrench"></i></button> ' +
                           '<button class="btn btn-danger btn-delete btn-sm" data-id="'+row.id_pegawai+'"><i class="fas fa-trash"></i></button> ' +
                           '<button class="btn btn-success btn-view btn-sm" data-id="'+row.id_pegawai+'"><i class="fas fa-eye"></i></button>';
                }
            }
        ]
    });

    $('#inputForm').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: '<?php echo base_url() ?>' + control + '/addNewTask',
        type: 'POST',
        data: formData,
        contentType: false,  // Harus false agar FormData bisa mengirim file
        processData: false,  // Harus false agar data tidak diubah oleh jQuery
        cache: false,        // Opsional, mencegah caching
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status) {
                $('#inputForm')[0].reset();
                $('#inputData').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                alert('Data Berhasil Ditambah');
            } else {
                alert('Gagal: ' + response.message);
            }
        }, 
        error: function(xhr) {
                console.log(xhr.responseText)
        }
        });
    });



    $('#myTable tbody').on('click', '.btn-edit', function () {
        var id = $(this).data('id');

        $("#editData").modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>' + control + '/getDataById',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                $('#id_popleEdit').val(data.id);
                $('#idEdit').val(data.id_pegawai);
                $('#namaEdit').val(data.nama);
                $('#nikEdit').val(data.nik);
                $('#nipEdit').val(data.nip);
                $('#tanggalmasukEdit').val(data.tanggal_masuk);
                $('#tempatlahirEdit').val(data.tempat_lahir);
                $('#tanggal_lahirEdit').val(data.tanggal_lahir);
                $('#alamatEdit').val(data.alamat);
                $('#notelpEdit').val(data.no_telp);
                $('#agamaEdit').val(data.agama).change();
                $("input[name='jenis_kelamin'][value='" + data.jenis_kelamin.trim() + "']").prop("checked", true);
            }
        });
    });

    $('#editForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '<?php echo base_url('pegawai/updateData') ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $('#editData').modal('hide');
                $('#myTable').DataTable().ajax.reload(null, false);
                alert(response.message);
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.log("Response:", xhr.responseText);
            alert("Terjadi kesalahan. Cek console untuk detail.");
        }
        });
    });


    $('#myTable tbody').on('click', '.btn-delete', function () {
        var id_pegawai = $(this).data('id'); 

        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            $.ajax({
                url: '<?php echo base_url() ?>' + control + "/deleteData",
                type: 'POST',
                data: {id_pegawai: id_pegawai},
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                    if (data.status) {
                        $('#myTable').DataTable().ajax.reload(null, false);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan saat menghapus data.");
                }
            });
        }
    });

    $('#myTable tbody').on('click', '.btn-view', function () {
    var id = $(this).data('id');

    $.ajax({
        url: '<?php echo base_url() ?>' + control + "/getDataViewById",
        type: 'POST',
        data: {id: id},
        success: function(response) {
            var data = JSON.parse(response);
            if (data.status) {
                $('#detail_nama').text(data.result.nama);
                $('#detail_nik').text(data.result.nik);
                $('#detail_nip').text(data.result.nip);
                $('#detail_tanggal_masuk').text(data.result.tanggal_masuk);
                $('#detail_tempat_lahir').text(data.result.tempat_lahir);
                $('#detail_tanggal_lahir').text(data.result.tanggal_lahir);
                $('#detail_alamat').text(data.result.alamat);
                $('#detail_no_telp').text(data.result.no_telp);
                $('#detail_agama').text(data.result.agama);
                $('#detail_jenis_kelamin').text(data.result.jenis_kelamin == "W" ? "Perempuan" : "Laki-laki");

                let fotoPath = data.result.foto 
                    ? '<?php echo base_url("files/guru/") ?>' + data.result.foto 
                    : '<?php echo base_url("assets/images/default-avatar.png") ?>';

                    $('#detail_foto').attr('src', fotoPath);

                $('#viewDataModal').attr('data-id', id);

                $('#viewDataModal').modal('show');
            } else {
                alert('Gagal mengambil data.');
            }  
        },
        error: function() {
            alert('Terjadi kesalahan saat mengambil data.');
        }
        });
    });

    $('#searchButton').on('click',function () {
        $('#SearchData').modal('show');
        $('#myTable2').removeAttr('style');
    });


    $(document).on('click', '#btnPrintCV', function() {
    var pegawaiId = $('#viewDataModal').attr('data-id');

    console.log("ID Pegawai saat Cetak CV:", pegawaiId);

    if (!pegawaiId) {
        alert('ID Guru tidak ditemukan!');
        return;
    }

    $.ajax({
        url: '<?php echo base_url() ?>' + control + "/generate_pdf",
        method: 'POST',
        data: { id_pegawai: pegawaiId },
        success: function(response) {
            var data = JSON.parse(response);
            if (data.status === 'success') {
                window.open(data.file_url, '_blank');
            } else {
                alert(data.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan. Coba lagi!');
        }
    });
});


    
});
</script>