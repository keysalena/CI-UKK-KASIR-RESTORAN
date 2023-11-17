<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4"> <br><br>
            <button type="button" class="btn btn-dark btn-sm mb-3" data-bs-toggle="modal" onclick="openModal1()">
                Tambah Transaksi
            </button>
            <script>
                function openModal1() {
                    $('#exampleModal1').modal('show');
                }
            </script>
            <div class="card shadow mb-4" style="background-color: var(--bs-gray-200);">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Data masakan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>NAMA USER</th>
                                <th>NO MEJA</th>
                                <th>TANGGAL</th>
                                <th>TOTAL</th>
                            </tr>
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
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-lg"> <!-- Use "modal-lg" for large size -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('admin/transaksi/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input type="text" name="id_order" id="id_order" class="form-control pencarian" placeholder="Pilih Pelanggan" readonly>
                                        </div>
                                        <input type="hidden" class="form-control" name="name" id="name" value="<?php echo $this->session->userdata('username') ?>" required>
                                        <!-- <input type="hidden" name="id_user" id="id_user" class="form-control pencarian" readonly required> -->
                                        <!-- <input type="hidden" name="id_detail_order" id="id_detail_order" class="form-control pencarian"> -->
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
                                <table class="table table-bordered" id="dataTableModal" width="100%" cellspacing="0">
                                    <tr>
                                        <th>NO MEJA</th>
                                        <th>NAMA USER</th>
                                    </tr>
                                    <?php foreach ($order as $brg) : ?>
                                        <tr class="pilih" data-no_meja="<?php echo $brg->id_order; ?>">
                                            <td><?php echo $brg->no_meja; ?></td>
                                            <td><?php echo $brg->nama_user; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
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
                // document.getElementById("id_order").value = $(this).attr('data-nama_user');
                // document.getElementById("id_detail_order").value = $(this).attr('data-id_detail_order');
                $('#exampleModal2').modal('hide');
            });
        </script>