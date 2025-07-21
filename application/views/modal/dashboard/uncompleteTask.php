
<!-- modal pengeluaran -->
<div class="modal fade bd-example-modal-xl" id='uncompleteTaskModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLongTitle">Detail Data Transaksi</h4>
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
                                        <th>Title</th>
                                        <th>Tgl Transaksi</th>
                                        <th>Keterangan</th>
                                        <th>Amount</th>
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