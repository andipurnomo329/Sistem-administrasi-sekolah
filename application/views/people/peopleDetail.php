    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Data Jema'ah</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id='tombolTambah'><i
                    class="fas fa-download fa-sm text-white-50"></i> Print <?php echo $pageTitle; ?></a>
        </div>
        <!-- Card Example -->
        
        <div class="row"></div>

        <div class="row">            
            <!-- Approach -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <h6 class="m-0 font-weight-bold text-primary text-center"><?php echo $people->nama; ?> </h6>
                                </div>
                                <div class="text-center">
                                    <?php if($people->foto){ ?>
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 7rem;" src="<?php echo base_url().'files/foto/'.$people->foto; ?>">
                                    <?php }else{ ?>
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 7rem;" src="<?php echo base_url(); ?>assets/sb2/img/User-Pict-Profil.svg.png">
                                    <?php } ?>
                                </div>
                                <hr/>
                                <!-- <div class="mb-0 font-weight-bold text-gray-800"><?php echo date("d-m-Y", strtotime($people->tanggal_lahir)); ?></div> -->
                                <div class="mb-0 font-weight-bold text-gray-800 text-center">
                                    <div id="qrcode"></div>
                                    (<?php echo $people->peopleCode; ?>)
                                </div>
                            </div>
                            <div class="col-auto">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-4">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header py-3 text-right">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="myTable" class="table ">
                                <tbody>
                                    <tr>
                                        <td>NIK</th>
                                        <td><?php echo $people->nik; ?></th>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</th>
                                        <td><?php echo ($people->jenis_kelamin == 'W') ? 'Wanita': 'Pria' ; ?></th>
                                    </tr>
                                    <tr>
                                        <td>Tempat/ Tanggal Lahir</th>
                                        <td><?php echo $people->tempat_lahir .' / '. $people->tanggal_lahir; ?> </th>
                                    </tr>
                                    <tr>
                                        <td>Alamat</th>
                                        <td><?php echo $people->alamat; ?></th>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</th>
                                        <td><?php echo $people->no_telp; ?></th>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan</th>
                                        <td><?php echo $people->pekerjaan; ?></th>
                                    </tr>
                                </tbody>
                                <tbody>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <div class="card-footer py-3 text-right">
                        <h6 class="m-0 font-weight-bold text-primary" id='sisaPemakaian'></h6>
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
    $('#qrcode').qrcode({
        text: "<?php echo $people->peopleCode; ?>",
        width: 75,
        height: 75
    });
  });
</script>