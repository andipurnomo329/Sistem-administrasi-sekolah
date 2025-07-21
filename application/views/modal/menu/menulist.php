
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
            <form role="form" id="inputForm" >
            <div class="modal-body">
            <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="nama" name='nama' placeholder="Nama Menu" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Url</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="url" name='url' placeholder="Url" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="icon" name='icon' placeholder="Icon" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Parent</label>
                <div class="col-sm-9">
                    <select class="form-control required" id="parent" name="parent">
                        <option value="">Pilih Parent</option>
                    </select>
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
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Edit Data <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="editForm" >
            <div class="modal-body">
            <div class="form-group row">
            <input type="hidden" class="form-control required" id="idEdit" name='id' >
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="namaEdit" name='nama' value="<?php echo set_value('namaEdit'); ?>" placeholder="Nama Menu" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Url</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="urlEdit" name='url' value="<?php echo set_value('urlEdit'); ?>" placeholder="Url" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="iconEdit" name='icon' value="<?php echo set_value('iconEdit'); ?>" placeholder="Icon" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Parent</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="parentEdit" name='parent' value="<?php echo set_value('parentEdit'); ?>" placeholder="Parent" >
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