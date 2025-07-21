
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
            <form role="form" id="addTask" action="<?php echo base_url() ?>people/addNewTask" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Type</label>
                    <div class="col-sm-9">
                        <select class="form-select form-control" aria-label="Default select example" id='type' name='type'>
                            <option value="2" class="subtype1">Jema'ah</option>
                            <option value="3" class="subtype2">Pengurus</option>
                        </select>
                        <div class="form-check form-check-inline subtype1">
                            <input class="form-check-input" type="radio" name="subType" id="subType" value="1">
                            <label class="form-check-label" for="inlineRadio1">Yatim</label>
                        </div>
                        <div class="form-check form-check-inline subtype1" >
                            <input class="form-check-input" type="radio" name="subType" value="2">
                            <label class="form-check-label" for="inlineRadio2">Dua'fa</label>
                        </div><br/>
                        <div class="form-check form-check-inline subtype2">
                            <input class="form-check-input" type="radio" name="subType" value="1">
                            <label class="form-check-label" for="inlineRadio1">Pengurus</label>
                        </div>
                        <div class="form-check form-check-inline subtype2">
                            <input class="form-check-input" type="radio" name="subType" value="2">
                            <label class="form-check-label" for="inlineRadio2">Pegawai</label>
                        </div>
                        <div class="form-check form-check-inline subtype2">
                            <input class="form-check-input" type="radio" name="subType"  value="3">
                            <label class="form-check-label" for="inlineRadio2">Guru</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="nama" name='nama' value="<?php echo set_value('nama'); ?>" placeholder="Nama Tidak Boleh Kosong" required >
                        <!-- <input type="hidden" value="3" name="type" id="type" /> -->
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nik" name='nik' value="<?php echo set_value('nik'); ?>" placeholder="NIK">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Tempat Tgl Lahir</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="tempat_lahir" name='tempat_lahir' value="<?php echo set_value('tempat_lahir'); ?>" placeholder="Tempat Lahir">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tanggal_lahir" name='tanggal_lahir' value="<?php echo set_value('tanggal_lahir'); ?>" placeholder="Tanggal Lahir">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Pekerjaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="pekerjaan" name='pekerjaan' value="<?php echo set_value('pekerjaan'); ?>" placeholder="Pekerjaan" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="no_telp" value="<?php echo set_value('no_telp'); ?>" name='no_telp' placeholder="No Telepon">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="alamat" name='alamat' value="<?php echo set_value('alamat'); ?>" placeholder="Alamat" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="P">
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="W">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Upload Foto</label>
                    <div class="col-sm-6">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Choose file</label>
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
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="id" id="idEdit" />
                        <input type="text" class="form-control required" id="namaEdit" name='nama'  placeholder="Nama Tidak Boleh Kosong" disabled >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nikEdit" name='nik' value="<?php echo set_value('nik'); ?>" placeholder="NIK">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Tempat Tgl Lahir</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="tempat_lahirEdit" name='tempat_lahir' value="<?php echo set_value('tempat_lahir'); ?>" placeholder="Tempat Lahir">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tanggal_lahirEdit" name='tanggal_lahir' value="<?php echo set_value('tanggal_lahir'); ?>" placeholder="Tanggal Lahir">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Pekerjaan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="pekerjaanEdit" value="<?php echo set_value('pekerjaan'); ?>" name='pekerjaan' placeholder="Pekerjaan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="no_telpEdit" value="<?php echo set_value('no_telp'); ?>" name='no_telp' placeholder="No Telepon">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="alamatEdit" name='alamat' value="<?php echo set_value('alamat'); ?>" placeholder="Alamat" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9" id='jenis_kelaminEdit'>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"  name="jenis_kelamin" id="inlineRadio1" value="P">
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="W">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
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