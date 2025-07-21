<!-- modal input -->
<div class="modal fade bd-example-modal-lg" id='inputData' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content border-left-primary h-100 ">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Input <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="inputForm" >
            <div class="modal-body " >
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Murid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="nama" name='nama' placeholder="Nama Murid" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">NIS</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control required" id="nis" name='nis' placeholder="Nomer Induk Siswa" >
                    </div>
                    <label for="icon" class="col-sm-1 col-form-label">NIK</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control required" id="nik" name='nik' placeholder="NIK" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Tempat / Tanggal Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control required" id="tempat_lahir" name='tempat_lahir' placeholder="Tempat Lahir" >
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control required" id="tanggal_lahir" name='tanggal_lahir' placeholder="Tanggal Lahir" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-4" style="line-height:2.5">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="P">
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="W">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    </div>
                    <label for="url" class="col-sm-1 col-form-label">Agama</label>
                    <div class="col-sm-4">
                        <select class="form-control required" id="agama" name="agama">
                            <option value="">Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="protestan">Kristen Protestan</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Upload File</label>
                    <div class="col-sm-4 ">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Pilih File</label>
                    </div>
                    <label for="url" class="col-sm-1 col-form-label">Alamat</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" id="alamat" name='alamat' placeholder="Alamat Murid" ></textarea>
                    </div>
                    
                </div>

                    <div id='showUpload'></div>
                
                <hr/>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Nama Ayah & Ibu</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control required" id="namaAyahKandung" name='namaAyahKandung' placeholder="Nama Ayah Kandung" >
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control required" id="namaIbuKandung" name='namaIbuKandung' placeholder="Nama Ibu Kandung" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Nama Wali</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="namaWaliMurid" name='namaWaliMurid' placeholder="Nama Wali Murid" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Pekerjaan Wali</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="pekerjaanWali" name='pekerjaanWali' placeholder="Pekerjaan Wali Murid" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">No. Telepon Wali</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="no_telp" name='no_telp' placeholder="No. Telp Wali Murid" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Tanggal Daftar / Masuk</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control required" id="tanggalPendaftaran" name='tanggalPendaftaran' >
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control required" id="tanggalMasuk" name='tanggalMasuk' >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- modal edit -->
<div class="modal fade bd-example-modal-lg" id='editData' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-left-primary h-100">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Edit <?php echo $pageTitle; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="editForm" >
            <input type="hidden" id="edit_id" name='id' >
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Murid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="edit_nama" name='nama' readonly >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">NIS</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control required" id="edit_nis" name='nis' placeholder="Nomer Induk Siswa" >
                    </div>
                    <label for="icon" class="col-sm-1 col-form-label">NIK</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control required" id="edit_nik" name='nik' placeholder="NIK" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Tempat / Tanggal Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control required" id="edit_tempat_lahir" name='tempat_lahir' placeholder="Tempat Lahir" >
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control required" id="edit_tanggal_lahir" name='tanggal_lahir' placeholder="Tanggal Lahir" >
                    </div>
                </div>
                <div class="form-group row" style="line-height:2.5">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-4" id='edit_jenis_kelamin'>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="P">
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="W">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    </div>
                    <label for="url" class="col-sm-1 col-form-label">Agama</label>
                    <div class="col-sm-4">
                        <select class="form-control required" id="edit_agama" name="agama">
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen Protestan</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="edit_alamat" name='alamat' placeholder="Alamat Murid" >
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Upload Foto</label>
                    <div class="col-sm-6">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Choose file</label>
                    </div>
                    <div class="col-sm-2">
                        <img class="img-fluid" id='previewImage' style="width: 4rem;" src="<?php echo base_url().'files/murid/default.jpg'; ?>">
                    </div>
                </div><hr/>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Nama Ayah & Ibu</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control required" id="edit_namaAyahKandung" name='namaAyahKandung' placeholder="Nama Ayah Kandung" >
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control required" id="edit_namaIbuKandung" name='namaIbuKandung' placeholder="Nama Ibu Kandung" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Nama Wali</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="edit_namaWaliMurid" name='namaWaliMurid' placeholder="Nama Wali Murid" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Pekerjaan Wali</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="edit_pekerjaanWali" name='pekerjaanWali' placeholder="Pekerjaan Wali Murid" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">No. Telepon Wali</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" id="edit_no_telp" name='no_telp' placeholder="No. Telp Wali Murid" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent" class="col-sm-3 col-form-label">Tanggal Daftar / Masuk</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control required" id="edit_tanggalPendaftaran" name='tanggalPendaftaran' >
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control required" id="edit_tanggalMasuk" name='tanggalMasuk' >
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