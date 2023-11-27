<style>
    @media print {
        body * {
            visibility: hidden;
        }

        table {
            visibility: visible;
        }
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4"> <br><br>
            <script>
                function openModal1() {
                    $('#exampleModal1').modal('show');
                }
            </script>
            <script>
                function printTable() {
                    var printContents = document.querySelector("#transaksi").outerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;

                    window.addEventListener('afterprint', function() {
                        document.body.innerHTML = originalContents;
                        location.reload(true);
                    });

                    window.print();
                }
            </script>


            <script>
                var $j = jQuery.noConflict();
                $j(document).ready(function() {
                    $j('#transaksi').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [10, 25, 50, 75, 100],
                        "processing": true,
                        "searching": true,
                        "ordering": false,
                        "info": true,
                        "autoWidth": true,
                        "responsive": true,
                        "language": {
                            "search": "_INPUT_",
                            "searchPlaceholder": "Search level",
                        }
                    });
                });
            </script>
            <script>
                var $j = jQuery.noConflict();
                $j(document).ready(function() {
                    $j('#order').DataTable();
                });
            </script>


            <div class="card shadow mb-4" style="background-color: var(--bs-gray-200);">
                <div class="card-header py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-dark">Data Transaksi</h6>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-sm" onclick="printTable()">Print Table</button>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" onclick="openModal1()">
                                Tambah Transaksi
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="transaksi" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA ADMIN</th>
                                    <th>NAMA USER</th>
                                    <th>NO MEJA</th>
                                    <th>TANGGAL</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($transaksi as $brg) :
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $brg->name; ?></td>
                                        <td><?php echo $brg->nama; ?></td>
                                        <td><?php echo $brg->nomeja; ?></td>
                                        <td><?php echo $brg->tanggal; ?></td>
                                        <td><?php echo "Rp " . number_format($brg->total_bayar, 0, ",", "."); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('admin/transaksi/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input type="text" name="id_order" id="id_order" class="form-control form-control-lg pencarian" placeholder="Pilih Pelanggan" readonly>
                                        </div>
                                        <input type="hidden" class="form-control" name="name" id="name" value="<?php echo $this->session->userdata('username') ?>" required>
                                        <div class="form-group">
                                            <select name="keterangan" class="form-select form-select-lg">
                                                <option selected>Pilih Keterangan</option>
                                                <option>selesai</option>
                                                <option>dibatalkan</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark">Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered" id="order" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID ORDER</th>
                                            <th>NO MEJA</th>
                                            <th>NAMA USER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order as $brg) : ?>
                                            <tr class="pilih" data-no_meja="<?php echo $brg->id_order; ?>">
                                                <td><?php echo $brg->id_order; ?></td>
                                                <td><?php echo $brg->no_meja; ?></td>
                                                <td><?php echo $brg->nama_user; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            $(document).ready(function() {
                $(".pencarian").focusin(function() {
                    $("#exampleModal2").modal('show');
                });

            });

            $(document).on('click', '.pilih', function(e) {
                document.getElementById("id_order").value = $(this).attr('data-no_meja');
                $('#exampleModal2').modal('hide');
            });
        </script>