    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <!-- <?php echo base_url().'reporting/export'?> -->
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id='exportData'>
                <i class="fas fa-download fa-sm text-white-50"></i> Download <?php echo $pageTitle; ?>
            </a>
        </div>
        
        <div class="row">            
            <!-- Approach -->
            <div class="col-xl-9 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                </div>
                                <div class="mb-0 font-weight-bold text-gray-800"></div>
                                <div>
                                    <form role="form" id="genReport">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Periode :</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="tgl1" name='tgl1'  placeholder="tanggal Awal" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="tgl2" name='tgl2' placeholder="Tanggal Akhir" required>
                                                </div>
                                                <div class="col-sm-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                        </div>
                                    </form> 
                                </div>
                                <p></p>
                            </div>
                            <div class="col-auto">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Reporting Pemasukan </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Akun</th>
                                        <th class='text-center'>Nominal Masuk</th>
                                        <th class='text-center'>Trx Masuk</th>
                                        <th class='text-center'>Nominal Keluar</th>
                                        <th class='text-center'>Trx Keluar</th>
                                        <th class='text-center'>Saldo</th>
                                        <th class='text-center'>Detail</th>
                                    </tr>
                                </thead>
                                <tbody id='genData1'>
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

    $('#genReport').on('submit', function(e) {
        e.preventDefault();
        var tgl1 = $('#tgl1').val();
        var tgl2 = $('#tgl2').val();

        $.ajax({
            url: '<?php echo base_url('reporting/getDataAkunByDate') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                // console.log(data);
                noA = 1;
                htmls = '';
                let totalI = 0;
                let totalO = 0;
                let totalS = 0;
                data.dataAkun.forEach(function(item) {
                    htmls += '<tr><td>'+noA+'</td><td>'+item.title+'</td><td class="text-center">'+convertToRupiah(item.totalIncome)+'</td>';
                    htmls += '<td class="text-center">'+item.trxIncome+'</td><td class="text-center">'+convertToRupiah(item.totalOutcome)+'</td>';
                    htmls += '<td class="text-center">'+item.trxOutcome+'</td><td class="text-center">'+convertToRupiah(item.saldo)+'</td>';
                    htmls += '<td class="text-center"><button class="btn btn-primary btn-dtl1 btn-sm" data-id="'+item.id+'" data-tgl1="'+tgl1+'" data-tgl2="'+tgl2+'"><i class="fas fa-eye"></i></button></td></tr> ';
                    totalI += parseFloat(item.totalIncome);
                    totalO += parseFloat(item.totalOutcome);
                    totalS += parseFloat(item.saldo);
                    noA++;
                });
                htmls += '<tfooter><tr><th colspan="2">Jumlah</th><th class="text-center">'+convertToRupiah(totalI)+'</th><th></th>';
                htmls += '<th class="text-center">'+convertToRupiah(totalO)+'</th><th></th><th class="text-center">'+convertToRupiah(totalS)+'</th></tr></tfooter>';
                
                $('#genData1').html(htmls);
                
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-dtl1', function () {
        paramId = $(this).data('id');
        tgl1 = $(this).data('tgl1');
        tgl2 = $(this).data('tgl2');
        $('#pemasukan').DataTable().destroy();
        $('#pemasukanModal').modal('show');
        drawTable(paramId, tgl1, tgl2, 'I');
    });

    $('#myTable tbody').on('click', '.btn-dtl2', function () {
        paramId = $(this).data('id');
        tgl1 = $(this).data('tgl1');
        tgl2 = $(this).data('tgl2');
        $('#pemasukan').DataTable().destroy();
        $('#pemasukanModal').modal('show');
        drawTable(paramId, tgl1, tgl2, 'O');
    });

    function drawTable(paramId, tgl1, tgl2, inOut){
        var table = $('#pemasukan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('transaksi/getData/') ?>",
                "type": "POST",
                "data": function(d) {
                    d.tgl1 = tgl1,
                    d.tgl2 = tgl2,
                    d.param = paramId
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
                { "data": "title","width": "30%" },
                { "data": "tanggal_transaksi" },
                { "data": "inOut","className": 'text-center' },
                { "data": "amount","className": 'text-right' }
            ]
        });
        $('#pemasukan').removeAttr('style');
        $('#alertTab2').html('Periode : <br/>'+ tgl1 + 's.d ' + tgl2);

    }
    $('#myTable_filter input').unbind().bind('input', function(e) {
        var value = $(this).val();
        if (value.length >= 3) {
            table.search(value).draw();
        } else {
            table.search('').draw();
        }
    });
    
    $('#exportData').on('click', function() {        
        var stgl1 = $('#tgl1').val();
        var stgl2 = $('#tgl2').val();

        $.ajax({
                url: '<?php echo base_url() ?>' + 'reporting/exportAkunToExcell', // URL untuk memanggil controller di CI
                type: 'POST',
                data: {tgl1: stgl1, tgl2: stgl2 }, // Mengambil semua data dari form
                xhrFields: {
                    responseType: 'blob' // Merespon sebagai blob untuk file unduhan
                },
                success: function(data) {
                    // Membuat file Excel dan men-triger download
                    console.log(data); // Debug respons untuk melihat apakah data berupa blob
                    if (data instanceof Blob) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = 'Report_Akun('+tglDonlot+').xlsx';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    } else {
                        alert('Error: Received data is not a blob.');
                    }
                },
                error: function() {
                    alert('Something went wrong.');
                }
            });
    });

});
</script>