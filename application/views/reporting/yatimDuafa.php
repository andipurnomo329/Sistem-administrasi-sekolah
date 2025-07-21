    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
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
                        <h6 class="m-0 font-weight-bold text-primary">Data Reporting Penyaluran </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class='text-center'>No.</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th class='text-center'>Umur (Thn)</th>
                                        <th class='text-center'>Total Bantuan</th>
                                        <th class='text-center'>Total Nominal</th>
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
            url: '<?php echo base_url('reporting/getYatimDuafaByPeriode') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                noA = 1;
                htmls = '';
                let totalA = 0;
                let totalB = 0;
                data.datas.forEach(function(item) {
                    htmls += '<tr><td class="text-center">'+noA+'</td><td>'+item.nama.toUpperCase()+'</td><td>'+item.tanggal_lahir+'</td><td class="text-center">'+item.umur_tahun+' Th '+item.umur_hari+' Hr</td><td class="text-center">'+item.trx+'</td><td class="text-center">'+convertToRupiah(item.jumlah)+'</td>';
                    htmls += '<td class="text-center"><button class="btn btn-primary btn-dtl1 btn-sm" data-id="'+item.id+'" data-tgl1="'+tgl1+'" data-tgl2="'+tgl2+'"><i class="fas fa-eye"></i></button></td></tr> ';
                    noA++;
                    totalA += parseFloat(item.jumlah);
                });
                htmls += '<tfooter><tr><th colspan="5" >Jumlah</th><th class="text-center">'+convertToRupiah(totalA)+'</th></tr></tfooter>';
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
                    d.param = paramId,
                    d.inOut = inOut // Menambahkan parameter tambahan
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
                { "data": "title" },
                { "data": "tanggal_transaksi","width": "15%" },
                { "data": "keterangan" },
                { "data": "amount" }
            ]
        });
        $('#pemasukan').removeAttr('style');
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
            url: '<?php echo base_url() ?>' + 'reporting/exportYatimDuafaToExcell', // URL untuk memanggil controller di CI
            type: 'POST',
            data: {tgl1: stgl1, tgl2: stgl2 }, // Mengambil semua data dari form
            xhrFields: {
                responseType: 'blob' // Merespon sebagai blob untuk file unduhan
            },
            success: function(data) {
                // Membuat file Excel dan men-triger download
                // console.log(data); // Debug respons untuk melihat apakah data berupa blob
                tglDonlot = today.toISOString();
                console.log(tglDonlot); 
                if (data instanceof Blob) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = 'Report_yatim_duafa('+tglDonlot+').xlsx';
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