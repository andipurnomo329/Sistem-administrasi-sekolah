<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>150</h3>
                  <p>Mustahiq</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>5.000.000<sup style="font-size: 20px"></sup></h3>
                  <p>Pemasukan Minggu ini</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>3.245.000</h3>
                  <p>Pengeluaran Minggu Ini</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-md-10 box-body">
              <table class="table table-hover table-striped">
                <tr>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th class="text-center">Actions</th>
                </tr>
              </table>
            </div>
            <div class="col-md-2 box-body text-center">
              <h4>Jadwal Solat <span style="color:green"> Jakarta</span>.</h4>
              <?php echo "<h5>". $tanggal . "<h5>"; ?>
              <?php echo "<h5>". $hijri . "<h5>"; ?>
              <table class="table table-hover table-striped">
                <tr>
                  <td>Subuh</td>
                  <td><?php echo $adzan['Fajr']; ?></td>
                </tr>
                <tr>
                  <td>Dzuhur</td>
                  <td><?php echo $adzan['Dhuhr']; ?></td>
                </tr>
                <tr>
                  <td>Ashar</td>
                  <td><?php echo $adzan['Asr']; ?></td>
                </tr>
                <tr>
                  <td>Magrib</td>
                  <td><?php echo $adzan['Maghrib']; ?></td>
                </tr>
                <tr>
                  <td>Isy'a</td>
                  <td><?php echo $adzan['Isha']; ?></td>
                </tr>
              </table>
            </div>
        </div>
    </section>
    
</div>