    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id='generateCV'><i class="fas fa-download fa-sm text-white-50"></i> Download CV</a>
        </div>
        
        <div class="row">
            <div class="col-md-12" id='infoProses'></div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    
                                </div>
                                <div class="text-center">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 " style="width: 20rem;" src="<?php echo base_url().'files/murid/'.$dataDetail->foto; ?>">
                                    <div class="mb-0 font-weight-bold text-primary"><?= $dataDetail->nama ?></div><hr/>
                                </div>
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>NIS</td><td class="text-center"><?php echo $dataDetail->nis;?></td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td><td class="text-center"><?= $dataDetail->nik ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Lahir</td><td class="text-center"><?= $dataDetail->tanggal_lahir ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td><td class="text-center" id='belumDisalurkan'><?= $dataDetail->agama ?></td>
                                    </tr>
                                </table>
                                
                                    <tr>
                                        <td class="text-center"><?= $dataDetail->alamat ?></td>
                                    </tr>
                            </div>
                            <div class="col-auto">            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">Data Keluarga</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class='text-center'>No.</th>
                                        <th>Nama</th>
                                        <th>Hubungan Keluarga</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <th class='text-center'>1</th>
                                        <th><?= strtoupper($dataDetail->namaAyahKandung) ?></th>
                                        <th>Orang Tua Laki-laki</th>
                                        <th></th>
                                    </tr>
                                    
                                    <tr>
                                        <th class='text-center'>2</th>
                                        <th><?= strtoupper($dataDetail->namaIbuKandung) ?></th>
                                        <th>Orang Tua Perempuan</th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">History Kelas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class='text-center'>No.</th>
                                        <th>Nama</th>
                                        <th>Tingkat</th>
                                        <th>Tahun Ajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <th class='text-center'>1</th>
                                        <th>VII A</th>
                                        <th>7</th>
                                        <th>2023/2024</th>
                                    </tr>
                                    
                                    <tr>
                                        <th class='text-center'>2</th>
                                        <th>VII B</th>
                                        <th>8</th>
                                        <th>2024/2025</th>
                                    </tr>
                                    
                                    <tr>
                                        <th class='text-center'>3</th>
                                        <th>IX C</th>
                                        <th>9</th>
                                        <th>2025/2026</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">Prestasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Keterangan</th>
                                        <th>Penyelenggara</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Juara Umum Cerdas cermat tingkat kecamatan</td>
                                        <td>Pem Prov DKI</td>
                                        <td>2024</td>
                                    </tr>
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
        $(document).on('click', '#generateCV', function() {
            var id = <?php echo $dataDetail->id; ?>;
            console.log("ID murid saat Cetak CV:", id);
            if (!id) {
                alert('ID Murid tidak ditemukan!');
                return;
            }
            window.location.href = '<?php echo base_url("murid/generate_cv") ?>/' + id;
        });
    });
</script>