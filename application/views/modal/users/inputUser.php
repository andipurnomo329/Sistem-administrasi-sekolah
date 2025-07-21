<!-- modal input -->
<div class="modal fade bd-example-modal-lg" id='inputData' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Input Data User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="addTask">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label text-right">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" id="name" name='name' placeholder="Nama Tidak Boleh Kosong" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label text-right">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" id="email" name='email' placeholder="Email Tidak Boleh Kosong" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label text-right">No. Telepon</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" id="mobile" name='mobile' placeholder="No. Telepon" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label text-right">Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control required" id="password" name='password' placeholder="Password Tidak Boleh Kosong" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label text-right">Confirm Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control required" id="passwordCfm" name='passwordCfm' placeholder="Konfirmasi Password " >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label text-right">Role</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <select class="form-control" id='roleList' name='roleId'>
                                <option>select Role</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label text-right">Is Admin</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <select class="form-control" id='isAdmin' name='isAdmin'>
                                <option value='0'>Reguler User</option>
                                <option value='1'>Administrator</option>
                            </select>
                        </div>
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
                    <label for="nama" class="col-sm-3 col-form-label text-right">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" id="nameEdit" name='name' placeholder="Nama Tidak Boleh Kosong" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label text-right">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" id="emailEdit" name='email' placeholder="Email Tidak Boleh Kosong" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label text-right">No. Telepon</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" id="mobileEdit" name='mobile' placeholder="No. Telepon" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label text-right">Role</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <select class="form-control" id='roleListEdit' name='roleId'>
                                <option>select Role</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label text-right">Is Admin</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <select class="form-control" id='isAdminEdit' name='isAdmin'>
                                <option value='0'>Reguler User</option>
                                <option value='1'>Administrator</option>
                            </select>
                        </div>
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