<!-- modal input -->
<div class="modal fade bd-example-modal-lg" id='inputData' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Input <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="inputForm" >
            <div class="modal-body">
            <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="nama_kelas" name='nama_kelas' placeholder="Nama Kelas" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Tingkat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="tingkat" name='tingkat' placeholder="Tingkat" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label">Jurusan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="jurusan" name='jurusan' placeholder="Jurusan" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="tahun_ajaran" name='tahun_ajaran' placeholder="Tahun Ajaran" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- modal edit -->
<div class="modal fade bd-example-modal-lg" id='editData' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Edit <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="editForm" >
            <div class="modal-body">
            <div class="form-group row">
            <input type="hidden" class="form-control required" id="idEdit" name='id_kelas' >
                    <label for="nama" class="col-sm-3 col-form-label">Nama Kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="namaEdit" name='nama_kelas' value="<?php echo set_value('nama_kelas'); ?>" placeholder="Nama Kelas" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Tingkat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="tingkatEdit" name='tingkat' value="<?php echo set_value('tingkat'); ?>" placeholder="Tingkat" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label">Jurusan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="jurusnEdit" name='jurusan' value="<?php echo set_value('jurusan'); ?>" placeholder="Jurusan" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="tahunAjaranEdit" name='tahun_ajaran' value="<?php echo set_value('tahun_ajaran'); ?>" placeholder="Tahun Ajaran" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- modal SearchData -->
<div class="modal fade bd-example-modal-lg" id='SearchData' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Pilih Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3" ><h4 id='alertTab2'></h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nik</th>
                                        <th>Jenis Kelamin (P/W)</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
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
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>