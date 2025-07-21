    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-5 col-lg-7">
                <div class="card shadow border-left-primary mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Penerimaan Siswa</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow border-left-primary mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Persentase Siswa by Angkatan</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class='col-xl-12'>
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Siswa Aktif</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id='totalPemasukan'></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-xl-12">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Guru Aktif</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id='totalPengeluaran'></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="col-xl-12">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Kelas Berjalan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id='totalNonTunai'></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-6 col-lg-5">
                <div class="card shadow border-left-primary mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Jadwal Sholat</h6>
                    </div>
                    <div class="card-body">
                        <h6 class='m-0 text-primary text-center' id='dateHijriah'></h6>
                        <h6 class='m-0 text-primary text-center' id='dateMasehi'></h6><br/>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <tbody id='jadwalSolat'>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5">
                <div class="card shadow border-left-primary mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Info Kelas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td>No.</td>
                                        <td>Kelas</td>
                                        <td>Guru</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->


        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Uncomplete Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto" >
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id='pendingTask'></div>
                                    </div>
                                    <!-- <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="#" id='uncompleteTask'>
                                    <i class="fas fa-clipboard-list fa-2x text-primary-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Next Event</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id='nextEvent'></div>
                            </div>
                            <div class="col-auto">
                                <a href="#" id='nextEventBtn'>
                                    <i class="fas fa-comments fa-2x text-primary-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Today Event
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto" >
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id='todayEvent'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="#" id='TodayEventBtn'>
                                    <i class="fas fa-clipboard-list fa-2x text-primary-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- modal uncomplete Event -->
<div class="modal fade bd-example-modal-xl" id='uncompleteTaskModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Uncomplete Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3" ><h5 id='alertTab2'> </h5></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pemasukan" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kegiatan</th>
                                        <th class='text-center'>Estimasi</th>
                                        <th class='text-center'>Realisasi</th>
                                        <th class='text-center'>Tgl Transaksi</th>
                                        <th class='text-center'>Total Peserta</th>
                                        <th class='text-center'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id='drawUncompleteTask'>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- modal drawNextEvent  -->
<div class="modal fade bd-example-modal-xl" id='drawNextEventModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Next Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3" ><h5> </h5></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="nextEventTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kegiatan</th>
                                        <th class='text-center'>Amount</th>
                                        <th class='text-center'>Tanggal</th>
                                        <th class='text-center'>Keterangan</th>
                                        <th class='text-center'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id='drawNextEvent'>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- modal drawNextEvent  -->
<div class="modal fade bd-example-modal-xl" id='drawTodayEventModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Today Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3" ><h5> </h5></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="nextEventTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kegiatan</th>
                                        <th class='text-center'>Amount</th>
                                        <th class='text-center'>Tanggal</th>
                                        <th class='text-center'>Keterangan</th>
                                        <th class='text-center'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id='drawTodayEvent'>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>assets/sb2/vendor/chart.js/Chart.min.js"></script>

<script>
$(document).ready(function() {
    
    // getPengeluaran1Bulan
    get1Bln('totalPemasukan', 'I');
    get1Bln('totalPengeluaran', 'O');

    $('#uncompleteTask').on('click', function() {
        $('#uncompleteTaskModal').modal('show');
    });

    $('#nextEventBtn').on('click', function() {
        $('#drawNextEventModal').modal('show');
    });

    $('#TodayEventBtn').on('click', function() {
        $('#drawTodayEventModal').modal('show');
    });

    function get1Bln(htmlId, inOuts){
        $.ajax({
            url: '<?php echo base_url() ?>' + 'transaksi/getMonthTransaction',
            type: 'POST',
            "data": {isCash: 1, inOut: inOuts },
            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);
                $('#'+htmlId).html(convertToRupiah(data.amount));
            }
        });
    }
    
    $.ajax({
        url: '<?php echo base_url() ?>' + 'transaksi/getTotalPendapatan3Bulan',
        type: 'POST',
        "data": {paramId: 0, inOut: 'O' },
        success: function(response) {
            var data = JSON.parse(response);
            // console.log(data);
            var amounts = data.map(function(item) {
                return parseInt(item.amount);
            });
            var labelss = data.map(function(item) {
                return item.month;
            });
            createAreaCart(amounts,labelss);
            // color = ['#77E4C8', '#36C2CE', '#478CCF', '#4535C1','#021526'];
            // drawPieChart(labelss,amounts,'myPieChart',color);
        }
    });
    
    $.ajax({
        url: '<?php echo base_url() ?>' + 'transaksi/getTotalPendapatan3Bulan',
        type: 'POST',
        "data": {paramId: 1, inOut: 'O' },
        success: function(response) {
            var data = JSON.parse(response);
            // console.log(data);
            var amounts = data.map(function(item) {
                return parseInt(item.amount);
            });
            var labelss = data.map(function(item) {
                return item.title;
            });

            drawPieChart(labelss,amounts,'myPieChart');
        }
    });
    
    $.ajax({
        url: '<?php echo base_url() ?>' + 'transaksi/nextEvent',
        type: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
            $('#nextEvent').html(data.length +' Event');
            // console.log(data);
            no = 1;
            htmls = '';
            data.forEach(function(item) {
                htmls += '<tr><td>'+no+'</td><td>'+item.title+'</td><td class="text-center">'+convertToRupiah(item.amount)+'</td>';
                htmls += '<td class="text-center">'+item.tanggal_transaksi+'</td><td class="text-center">'+item.keterangan+'</td>';
                htmls += '<td class="text-center"><a href="<?php echo base_url(); ?>transaksi/detail/'+item.id+' "  class="btn btn-primary btn-dtl1 btn-sm"><i class="fas fa-eye"></i></a></td></tr> ';
                no++;
            });
            $('#drawNextEvent').html(htmls);
        }
    });
    
    $.ajax({
        url: '<?php echo base_url() ?>' + 'transaksi/todayEvent',
        type: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
            $('#todayEvent').html(data.length +' Event');
            console.log(data);
            no = 1;
            htmls = '';
            data.forEach(function(item) {
                if(item.isCash == 0){
                    direct = 'detailNonTunai/';
                }else{
                    direct = 'detail/';
                }
                htmls += '<tr><td>'+no+'</td><td>'+item.title+'</td><td class="text-center">'+convertToRupiah(item.amount)+'</td>';
                htmls += '<td class="text-center">'+item.tanggal_transaksi+'</td><td class="text-center">'+item.keterangan+'</td>';
                htmls += '<td class="text-center"><a href="<?php echo base_url(); ?>transaksi/'+direct+item.id+' "  class="btn btn-primary btn-dtl1 btn-sm"><i class="fas fa-eye"></i></a></td></tr> ';
                no++;
            });
            $('#drawTodayEvent').html(htmls);
        }
    });
    
    $.ajax({
        url: '<?php echo base_url() ?>' + 'reporting/getPendingEvent',
        type: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
            $('#pendingTask').html(data.length +' Event');
            // console.log(data);
           
            noA = 1;
            htmls = '';
            data.forEach(function(item) {
                htmls += '<tr><td>'+noA+'</td><td>'+item.title+'</td><td class="text-center">'+convertToRupiah(item.amount)+'</td><td class="text-center">'+convertToRupiah(item.totalAmount)+'</td>';
                htmls += '<td class="text-center">'+item.tanggal_transaksi+'</td><td class="text-center">'+item.personTotal+'</td>';
                htmls += '<td class="text-center"><a href="<?php echo base_url(); ?>transaksi/detail/'+item.id+' "  class="btn btn-primary btn-dtl1 btn-sm" data-id="'+item.id+'" ><i class="fas fa-eye"></i></a></td></tr> ';
                noA++;
            });
            $('#drawUncompleteTask').html(htmls);
            // console.log(htmls);
        }
    });

    $.ajax({
    url: '<?php echo base_url() ?>' + 'user/getJadwalSholat2',
    type: 'GET',
    success: function(response) {
        var data = JSON.parse(response);
        console.log(data);
        $('#dateMasehi').html(data.data.date.readable);
        $('#dateHijriah').html(data.data.date.hijri.day + ' ' + data.data.date.hijri.month.en + ' ' + data.data.date.hijri.year);
        drawTable = '<tr><td>Subuh</td><td>'+data.data.timings.Fajr+'</td></tr>'
        drawTable += '<tr><td>Dzuhur</td><td>'+data.data.timings.Dhuhr+'</td></tr>'
        drawTable += '<tr><td>Ashar</td><td>'+data.data.timings.Asr+'</td></tr>'
        drawTable += '<tr><td>Magrib</td><td>'+data.data.timings.Maghrib+'</td></tr>'
        drawTable += '<tr><td>Isya</td><td>'+data.data.timings.Isha+'</td></tr>'
        $('#jadwalSolat').html(drawTable);
        // console.log(data.data);
    }
});


});
</script>


<script src="<?php echo base_url(); ?>assets/sb2/js/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url(); ?>assets/sb2/js/demo/chart-pie-demo.js"></script>