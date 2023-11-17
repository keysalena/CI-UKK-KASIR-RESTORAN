<head>
    <style>
        .card {
            --bs-card-border-radius: 1.2rem;
        }
    </style>
</head>
<br><br><br>
<div class="text-center">
    <div class="container-fluid">
        <div class="row" style="display: flex; justify-content: center;">
            <!-- Card dan Form Pertama -->
            <div class="col-md-4">
                
                <div class="card shadow mb-4">
                    <div class="btn btn-sm btn-primary col-md-0">
                        <?php
                        $grand_total = 0;
                        if ($keranjang = $this->cart->contents()) {
                            foreach ($keranjang as $item) {
                                $grand_total = $grand_total + $item['subtotal'];
                            }
                            echo "Total Pesanan Anda: Rp. " . number_format($grand_total, 0, ',', '.');
                        ?>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="m-0 font-weight-bold text-dark mb-3">Pilih No. Meja</h4>
                        <form action="<?php echo base_url() ?>dashboard/proses" method="post">
                            <div class="form-group"><br>
                                <input type="text" class="form-control mb-3" name="no_meja" id="no_meja" required>
                                <input type="hidden" class="form-control" name="nama_user" id="nama_user" value="<?php echo $this->session->userdata('username') ?>" required>
                                <input type="hidden" class="form-control" name="total" id="total" value="<?php echo $grand_total ?>" required>
                            </div><br>
                            <div align="right">
                                <button type="submit" class="btn btn-sm btn-primary">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card dan Form Kedua -->
            <div class="col-md-4 ">

                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <h4 class="m-0 font-weight-bold text-dark mb-3">No. Meja yang Tersedia</h4>
                        <?php
                        $no_meja_status = array();

                        // Mengambil data nomor meja dari tabel order
                        $queryOrder = $this->db->select('no_meja')->where('keterangan', 'belum pesan')->get('order');

                        foreach ($queryOrder->result_array() as $row) {
                            $no_meja_status[$row['no_meja']] = true;
                        }

                        echo '<table class="table align-items-center mb-0">';
                        $start_number = 1;

                        for ($i = 1; $i <= 4; $i++) {
                            echo '<tr>';
                            for ($j = 1; $j <= 10; $j++) {
                                if (isset($no_meja_status[$start_number])) {
                                    echo '<td>---</td>';
                                } else {
                                    echo '<td>' . $start_number . '</td>';
                                }
                                $start_number++;
                            }
                            echo '</tr>';
                        }

                        echo '</table>';
                        ?>

                    </div>
                </div>
            </div>
        </div>
    <?php
                    } else {
                        echo "Keranjang Belanja Anda Masih Kosong   <button class='btn btn-sm btn-primary' type='button' onclick=\"window.location.href='" . site_url('welcome') . "'\">
                                   <i class='fas fa-backward fa-sm'></i> Kembali</button>";
                    }
    ?>
    </div>
</div>