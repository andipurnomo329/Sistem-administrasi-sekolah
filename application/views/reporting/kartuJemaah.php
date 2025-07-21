    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
            <form method="post" action="<?php echo base_url() ?>reporting/print_card">
                <input type="hidden" name="data" id="kirimData">
                <button  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="cetakKartuBtn"><i
                        class="fas fa-download fa-sm text-white-50"></i> <?php echo $pageTitle; ?></button >
            </form>
        </div>
        
        <div class="row"></div>

        <div class="row">            
            <!-- Approach -->
            <div class="col-xl-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" id='title'>Pilih kartu yang akan dicetak </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class = "text-center" >No.</th>
                                        <th>Nama</th>
                                        <th>Nik</th>
                                        <th>ID Jemaah</th>
                                        <th>Jenis Kelamin (P/W)</th>
                                        <th>Status</th>
                                        <th>action</th>
                                        <th class = "text-center" ><input type="checkbox" id="select-all"></th>
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
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
$(document).ready(function() {
    var selectedIds = [];
    var table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('people/getData') ?>",
            "type": "POST",
            "data": function(d) {
                d.types = 3 // Menambahkan parameter tambahan,
            }
        },
        "searchDelay": 500,
        "columns": [
            {
                "orderable": false,
                "data": null,
                "className": 'text-center',
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "nama" },
            { "data": "nik" },
            { "data": "peopleCode" },
            // { "data": "jenis_kelamin" },
            {
                "data": null,
                "render": function (data, type, row) {
                    if(row.jenis_kelamin == 'P'){
                        kelamin = 'Laki-Laki';
                    }else{
                        kelamin = 'Perempuan';
                    }
                    return kelamin;
                }
            },
            {
                "data": null,
                "render": function (data, type, row) {
                    if(row.type == '2'){
                        types = "Jema'ah";
                    }else{
                        types = 'Pengurus';
                    }
                    return types;
                }
            },
            {
                "data": null,
                "className": 'text-center',
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary btn-edit btn-sm" data-id="'+row.id+'"><i class="fas fa-wrench"></i></button> ' +
                           '<button class="btn btn-danger btn-delete btn-sm" data-id="'+row.id+'"><i class="fas fa-trash"></i></button>';
                }
            },
            {
                "className": 'text-center',
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row) {
                    var checked = selectedIds.some(item => item.id == row.id)  ? 'checked' : ''; // Cek apakah ID sudah dipilih
                    return '<input type="checkbox" class="row-select" value="' + row.id + '" ' + checked + '>';
                }
            }
        ]
    });
    $('#myTable_filter input').unbind().bind('input', function(e) {
        var value = $(this).val();
        if (value.length >= 3) {
            table.search(value).draw();
        } else {
            table.search('').draw();
        }
    });

    
    $('#select-all').on('click', function () {
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

        // Tambahkan atau hapus semua ID tergantung dari status checkbox "select-all"
        if (this.checked) {
            // Tambah semua ID dari halaman saat ini ke selectedIds jika tidak ada di dalamnya
            table.rows({ 'search': 'applied' }).data().each(function (data) {
                // console.log(data);
                if (!selectedIds.includes( {id: data.id,nama: data.nama} )) {
                    selectedIds.push({id: data.id,nama: data.nama});
                }
            });
        } else {
            // Hapus semua ID dari halaman saat ini dari selectedIds
            table.rows({ 'search': 'applied' }).data().each(function (data) {
                var index = selectedIds.indexOf(data.id);
                if (index !== -1) {
                    selectedIds.splice(index, 1);
                }
            });
        }
        $('#kirimData').val(JSON.stringify(selectedIds));
        console.log(selectedIds);
    });
    // Event handler untuk perubahan checkbox individual
    $('#myTable tbody').on('change', '.row-select', function () {
        var id = $(this).val();
        var nama = $(this).closest('tr').find('td:eq(2)').text(); 
        // console.log(this.checked);
        if (this.checked) {
            if (!selectedIds.includes(id)) {
                selectedIds.push({id: id,nama: nama }); // Tambahkan ID ke array jika tidak ada
            }
        } else {
            var index = selectedIds.indexOf(id);
            // console.log(index);
            if (index == -1) {
                selectedIds.splice(index, 1); // Hapus ID dari array jika ada
            }
        }
        $('#title').html('cetak '+selectedIds.length+' Orang');
        console.log('Selected IDs: ', selectedIds); // Cetak semua ID yang dipilih
        $('#kirimData').val(JSON.stringify(selectedIds));
    });
    













    $('#myTable tbody').on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('people/getDataById') ?>',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                var data = JSON.parse(response);
                // console.log(data);
                $('#idEdit').val(data.id);
                $('#namaEdit').val(data.nama);
                $('#alamatEdit').val(data.alamat);
                $('#nikEdit').val(data.nik);
                $('#tanggal_lahirEdit').val(data.tanggal_lahir);
                $('#tempat_lahirEdit').val(data.tempat_lahir);
                $('#no_telpEdit').val(data.no_telp);
                $('#jenis_kelaminEdit').find(':radio[name=jenis_kelamin][value="'+data.jenis_kelamin+'"]')
                .prop('checked', true);
            }
        });

        $("#editData").modal('show');
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('people/updateData') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data.status);
                // console.log(response.status);
                if(data.status){
                    $('#editData').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                }
            }
        });
    });

    $('#myTable tbody').on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        if (confirm("Are you sure !") == true) {
            $.ajax({
                url: '<?php echo base_url('people/deleteData') ?>',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data.status);
                    // console.log(response.status);
                    if(data.status){
                        $('#myTable').DataTable().ajax.reload();
                    }
                }
            });
        } else {
            alert('cancel Delete ID: ' + id);
            
        }
        // Tambahkan logika untuk menghapus data
    });
    
    $('#tombolTambah').on('click',function () {
        $('#type').val(1);
    });
});
</script>