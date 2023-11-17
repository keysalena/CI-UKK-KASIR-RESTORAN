<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid"><br><br>
            <div class="card shadow mb-4" style="background-color: var(--bs-gray-200);">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Invoice Pemesanan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>#</th>
                                <th>Nama Pemesan</th>
                                <th>No Meja</th>
                                <th>Tanggal Pemesanan</th>
                                <th colspan="3">AKSI</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($order as $item) :
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $item->nama_user; ?></td>
                                    <td><?php echo $item->no_meja; ?></td>
                                    <td><?php echo $item->tanggal; ?></td>

                                    <td>
                                        <a href="<?php echo site_url('admin/invoice/detail/' . $item->id_order) ?>" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
