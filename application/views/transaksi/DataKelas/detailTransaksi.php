<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle . ' ' . $dataDetail->nama_kelas; ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#inputData">
            <i class="fas fa-download fa-sm text-white-50"></i> Input <?php echo $pageTitle; ?>
        </a>
    </div>

    <!-- Informasi Proses -->
    <div class="row">
        <div class="col-md-12" id="infoProses"></div>
    </div>

    <!-- Detail Kelas & Data Siswa -->
    <div class="row">
        
        <!-- Detail Kelas -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-primary font-weight-bold text-uppercase mb-0">Detail Kelas</h6>
                        <button type="button" class="btn btn-success shadow-sm" id="inputButton">
                            <i class="fas fa-download fa-sm text-white-50"></i> Input Wali Kelas
                        </button>
                    </div>

                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="<?php echo base_url(); ?>assets/sb2/img/undraw_posting_photo.svg">
                    </div>

                    <!-- Tabel Informasi Kelas -->
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td><strong>Wali Kelas</strong></td>
                            <td class="text-center">
                                <?php echo isset($dataGuru[0]->nama_guru) ? $dataGuru[0]->nama_guru : 'Tidak Ada Wali Kelas'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Tingkatan</strong></td>
                            <td class="text-center"><?php echo $dataDetail->tingkat; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Jurusan</strong></td>
                            <td class="text-center"><?php echo $dataDetail->jurusan; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nama Kelas</strong></td>
                            <td class="text-center"><?php echo $dataDetail->nama_kelas; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Siswa</strong></td>
                            <td class="text-center"><?php echo $dataDetail->tahun_ajaran; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tahun Ajaran</strong></td>
                            <td class="text-center"><?php echo $dataDetail->tahun_ajaran; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Siswa -->
        <div class="col-xl-8 col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable2" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>NIP</th>
                                        <th>Tanggal Masuk</th>
                                        <th>JNKL</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-3 text-right"></div>
            </div>
        </div>

    </div>
    
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Script JavaScript -->
<script>

$(document).ready(function() {
    var table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('guru/getData/') ?>",
            "type": "POST",
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
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id_guru+'" data-id-kelas="<?php echo $dataDetail->id_kelas; ?>"><i class="fas fa-plus"></i></button> ';
                }
            }
        ]
    });

    var table2 = $('#myTable2').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('guru/getData/') ?>",
            "type": "POST",
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
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id_guru+'" data-id-kelas="<?php echo $dataDetail->id_kelas; ?>"><i class="fas fa-plus"></i></button> ';
                }
            }
        ]
    });

    $('#inputButton').on('click',function () {
        $('#SearchData').modal('show');
        $('#myTable').removeAttr('style');
    });
    
    $(document).on('click', '.btn-edit', function () {
        var id_guru = $(this).data('id');
        var id_kelas = $(this).data('id-kelas');
        
        // Konfirmasi sebelum mengirim data
        if (!confirm('Apakah Anda yakin ingin menambahkan guru ini ke kelas?')) {
            return;
        }

        $.ajax({
            url: '<?php echo base_url("kelas/AddWaliKelas"); ?>',
            type: 'POST',
            data: {
                id_guru: id_guru,
                id_kelas: id_kelas
            },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    alert('Data berhasil ditambahkan!');
                    $('#myTable').DataTable().ajax.reload(); 
                    $('#SearchData').modal('hide');
                } else {
                    alert('Gagal menambahkan data: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Terjadi kesalahan, coba lagi!');
            }
        });
    });

    var id_kelas = "<?php echo $dataDetail->id_kelas; ?>"; // Ambil ID kelas dari PHP

    $.ajax({
        url: "<?php echo base_url('kelas/cekGuruByKelas'); ?>",
        type: "POST",
        data: { id_kelas: id_kelas },
        dataType: "json",
        success: function(response) {
            console.log("Response dari server:", response); // Debugging

            if (response.status) {
                // Jika guru sudah terdaftar, ubah button menjadi "Edit Wali Kelas"
                $('#inputButton').removeClass('btn-success').addClass('btn-primary');
                $('#inputButton').html('<i class="fas fa-download fa-sm text-white-50"></i> Edit Wali Kelas');
            } else {
                // Jika guru belum terdaftar, tetap "Input Wali Kelas"
                $('#inputButton').removeClass('btn-primary').addClass('btn-success');
                $('#inputButton').html('<i class="fas fa-download fa-sm text-white-50"></i> Input Wali Kelas');
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", xhr.responseText);
        }
    });

});

</script>
