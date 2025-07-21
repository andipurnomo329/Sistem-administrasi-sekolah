
<!-- modal input -->
<div class="modal fade bd-example-modal-lg" id='inputData' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Input Data <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="addTask" action="<?php echo base_url() ?>transaksi/addNewTask/" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" id="title" name='title' value="<?php echo set_value('title'); ?>" placeholder="Title Tidak Boleh Kosong" required >
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-success" id='searchButton'>Search</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label">Jumlah</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="amount" name='amount' value="<?php echo set_value('amount'); ?>" placeholder="Nominal" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label">Satuan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="satuan" name='satuan' value="<?php echo set_value('satuan'); ?>" placeholder="Satuan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_transaksi" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" id="tanggal_transaksi" name='tanggal_transaksi' value="<?php echo set_value('tanggal_transaksi'); ?>" placeholder="Tanggal Transaksi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="keterangan" name='keterangan' value="<?php echo set_value('keterangan'); ?>" placeholder="keterangan" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dokumen" class="col-sm-3 col-form-label">Upload Dokumen</label>
                    <div class="col-sm-6">
                        <input type="file" class="custom-file-input" id="dokumen" name="dokumen">
                        <label class="custom-file-label" for="foto">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="inOut" id="inOut" value='<?php echo $inOut; ?>'/>
                <input type="hidden" name="isCash" id="isCash" value='0'/>
                <input type="hidden" name="peopleId" id="peopleId"/>
                <input type="hidden" name="paramId" id="paramId" value='<?php echo $param; ?>' />
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
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Edit Data <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="editForm" >
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="id" id="idEdit" />
                        <input type="text" class="form-control required" id="titleEdit" name='title'  placeholder="Title Tidak Boleh Kosong" disabled >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amountEdit" class="col-sm-3 col-form-label">Jumlah</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="amountEdit" name='amount' placeholder="Nominal">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amountEdit" class="col-sm-3 col-form-label">Satuan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="satuanEdit" name='satuan' placeholder="Satuan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_transaksiEdit" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" id="tanggal_transaksiEdit" name='tanggal_transaksi' placeholder="Tanggal Transaksi">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keteranganEdit" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="keteranganEdit" name='keterangan' placeholder="Keterangan">
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