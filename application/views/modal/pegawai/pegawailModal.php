

<div class="modal fade bd-example-modal-lg" id="inputData" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Input <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="inputForm">
                <div class="modal-body">
                    <!-- Nama -->
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control required" id="nama" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Nama Tidak Boleh Kosong">
                        </div>
                    </div>

                    <!-- NIK -->
                    <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nik" name="nik" value="<?php echo set_value('nik'); ?>" placeholder="NIK" required>
                        </div>
                    </div>

                    <!-- NIP -->
                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip" name="nip" value="<?php echo set_value('nip'); ?>" placeholder="NIP" required>
                        </div>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="form-group row">
                        <label for="tanggal_masuk" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo set_value('tanggal_masuk'); ?>" placeholder="Tanggal Masuk">
                        </div>
                    </div>

                    <!-- Tempat dan Tanggal Lahir -->
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Tgl Lahir</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo set_value('tempat_lahir'); ?>" placeholder="Tempat Lahir">
                        </div>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo set_value('tanggal_lahir'); ?>" placeholder="Tanggal Lahir">
                        </div>
                    </div>

                    <!-- No Telepon -->
                    <div class="form-group row">
                        <label for="no_telp" class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo set_value('no_telp'); ?>" placeholder="No Telepon">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control required" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"><?php echo set_value('alamat'); ?></textarea>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
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

                    <!-- Agama -->
                    <div class="form-group row">
                        <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-9">
                            <select class="form-control required" id="agama" name="agama">
                                <option value="">Pilih Agama</option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen Protestan</option>
                                <option value="katolik">Katolik</option>
                                <option value="hindu">Hindu</option>
                                <option value="buddha">Buddha</option>
                                <option value="konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <!-- Upload Foto -->
                    <div class="form-group row">
                        <label for="foto" class="col-sm-3 col-form-label">Upload Foto</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="foto" name="foto">
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


<!-- Edit Detail Guru -->
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
            <input type="hidden" id="idEdit" name="id_pegawai" /> 
            <input type="hidden" id="id_popleEdit" name="id" /> 
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="namaEdit" name='nama' value="<?php echo set_value('nama'); ?>" required >
                        <!-- <input type="hidden" value="3" name="type" id="type" /> -->
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nikEdit" name='nik' value="<?php echo set_value('nik'); ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nipEdit" name='nip' value="<?php echo set_value('nip'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tanggalmasukEdit" name='tanggal_masuk' value="<?php echo set_value('tanggal_masuk'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Tempat Tgl Lahir</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="tempatlahirEdit" name='tempat_lahir' value="<?php echo set_value('tempat_lahir'); ?>">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tanggal_lahirEdit" name='tanggal_lahir' value="<?php echo set_value('tanggal_lahir'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="notelpEdit" value="<?php echo set_value('no_telp'); ?>" name='no_telp'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control required" id="alamatEdit" name='alamat' value="<?php echo set_value('alamat'); ?>" placeholder="Alamat" ></textarea>
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
                    <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                <div class="col-sm-9">
                    <select class="form-control required" id="agamaEdit" name="agama">
                        <option value="">Pilih Agama</option>
                        <option value="islam">Islam</option>
                        <option value="kristen">Kristen Protestan</option>
                        <option value="katolik">Katolik</option>
                        <option value="hindu">Hindu</option>
                        <option value="buddha">Buddha</option>
                        <option value="konghucu">Konghucu</option>
                    </select>
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
</div>

<!-- View Detail Guru -->
<!-- Modal Detail Guru -->
<div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="detailModalLabel">Detail <?php echo $pageTitle; ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <div class="card shadow border-left-primary">
                    <div class="card-body">
                        <div class="row d-flex align-items-start">
                            <!-- Identitas Guru & Informasi Lain -->
                            <div class="col-md-8">
                                <h6 class="font-weight-bold">Identitas <?php echo $pageTitle; ?> :</h6>
                                <hr>
                                <p><strong>Nama:</strong> <span id="detail_nama"></span></p>
                                <p><strong>NIK:</strong> <span id="detail_nik"></span></p>
                                <p><strong>NIP:</strong> <span id="detail_nip"></span></p>
                                <p><strong>Tanggal Masuk:</strong> <span id="detail_tanggal_masuk"></span></p>
                                <br>
                                <h6 class="font-weight-bold mt-3">Informasi Lain :</h6>
                                <hr>
                                <p><strong>Tempat, Tanggal Lahir:</strong> 
                                    <span id="detail_tempat_lahir"></span>, 
                                    <span id="detail_tanggal_lahir"></span>
                                </p>
                                <p><strong>No. Telepon:</strong> <span id="detail_no_telp"></span></p>
                                <p><strong>Alamat:</strong> <span id="detail_alamat"></span></p>
                                <p><strong>Jenis Kelamin:</strong> <span id="detail_jenis_kelamin"></span></p>
                                <p><strong>Agama:</strong> <span id="detail_agama"></span></p>
                            </div>

                            <!-- Foto Guru -->
                            <div class="col-md-4 text-center align-self-start">
                                <h6 class="font-weight-bold">Foto Guru</h6>
                                <hr>
                                <img id="detail_foto" src="" class="img-fluid rounded shadow" 
                                     alt="Foto Guru" style="max-width: 100%; max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnPrintCV">Cetak CV</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

