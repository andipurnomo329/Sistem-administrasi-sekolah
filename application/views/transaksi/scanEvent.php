    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $paramDetail->title; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id='tombolTambah'><i
                    class="fas fa-download fa-sm text-white-50"></i> Export Data </a>
        </div>
        <div class="row">            
            <!-- Approach -->
        </div>
        <!-- Card Example -->
        <div class="row">            
            <!-- Approach -->
            <div class="col-xl-4 col-md-4 mb-4 ">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div id="reader" class="col-xl-4 text-center"></div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <form role="form" id="genReport">
                                        <div class="form-group row">
                                                <div class="col-sm-8 col-md-8">
                                                    <input type="text" class="form-control required" id="search" name='search' placeholder="input nama / ID" required >
                                                </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="text-center" id='foto'>
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url(); ?>assets/dist/img/deflt.jpg">
                                </div>
                                <h6 class="m-0 font-weight-bold text-primary text-center" id='namaJemaah'> </h6>
                                <h6 class="m-0 font-weight-bold text-primary text-center" id='peopleCode'> </h6><hr/>
                                <h6 class="m-0 font-weight-bold text-primary text-center" id='absen'> </h6><br/>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 hide" id='kol2'>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h6 class="m-0 font-weight-bold text-primary text-center" id='namaEvent'> </h6><hr/>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td id='keterangan'></td>
                            </tr>
                            <tr>
                                <td id='amount'></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card shadow mb-4 hide">
                    <div class="card-header py-3 ">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Penyaluran</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>ID Jemaah</th>
                                        <th>Amount</th>
                                        <th>Keterangan</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-3 text-right">
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/jquery/html5-qrcode.min.js"></script>
<script>
$(document).ready(function() {
    function onScanSuccess(decodedText, decodedResult) {
        $('#search').val(`${decodedText}`);
        console.log(`Scan result: ${decodedText}`, decodedResult);
        getEventByPeopleCode(`${decodedText}`);
    }

    function onScanFailure(error) {
        console.warn(`Scan error: ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", 
        { 
            fps: 15, 
            qrbox: { width: 250, height: 250 },
            aspectRatio: 1.0 
        }
    );

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    
    $('.hide').hide();

    $('#myTable_filter input').unbind().bind('input', function(e) {
        var value = $(this).val();
        if (value.length >= 3) {
            table.search(value).draw();
        } else {
            table.search('').draw();
        }
    });

    // Menggunakan event input untuk menangani setiap kali pengguna mengetik
    $('#search').on('input', function() {
        var search = $(this).val();
        var characterCount = search.length;
        console.log('Jumlah karakter: ' + characterCount);
        if( characterCount > 6){
            getEventByPeopleCode(search);
        }
    });

    function getEventByPeopleCode(search){
        
        $.ajax({
            url: '<?php echo base_url('transaksiDetail/getEventByPerson') ?>',
            type: 'POST',
            data: { search: search }, // Mengirimkan nilai search secara langsung
            success: function(response) {
                try {
                    var data = JSON.parse(response);
                    console.log(data);
                    var foto = ''; // Inisialisasi variabel foto
                    if (data[0].title) {
                        $('#namaJemaah').html(data[0].nama);
                        $('#peopleCode').html(data[0].peopleCode);
                        $('#namaEvent').html(data[0].title);
                        $('#absen').html(data[0].absen);
                        $('#keterangan').html(data[0].keterangan + ' ' + convertToRupiah(data[0].amount) + ' ' + data[0].satuan);
                        $('#amount').html(data[0].tanggal_transaksi);
                        $('#kol2').show();
                        if (data[0].foto) {
                            foto = '<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url().'files/foto/'; ?>'+data.foto+'">';
                        }
                    } else {
                        $('#namaJemaah').html(data.nama);
                        $('#peopleCode').html('Tidak Terdaftar Event Hari Ini !');
                        foto = '<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url().'assets/dist/img/deflt.jpg'; ?>">';
                        $('#kol2').hide();
                        $('#absen').html('');
                    }
                    $('#foto').html(foto);

                } catch (e) {
                    console.error("Error parsing JSON response: ", e);
                    alert('Data yang diterima tidak valid.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown);
                alert('Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.');
            }
        });
    }
});
</script>