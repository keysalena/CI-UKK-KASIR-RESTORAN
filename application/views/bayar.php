<head>
    <style>
        .card {
            --bs-card-border-radius: 1.2rem;
        }

        .btna {
            --bs-btn-border-radius: 0rem;
        }

        .rounded-top {
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
        }

        .mt-3-i {
            margin-top: 0.74rem !important;
        }
    </style>
</head>
<?php echo $this->session->flashdata('lebih') ?>
<?php echo $this->session->flashdata('penuh') ?>
<br><br><br>
<div class="container-fluid">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-4">

            <?php
            $grand_total = 0;
            if ($keranjang = $this->cart->contents()) { ?>
                <div class="card shadow mb-4">
                    <div class="btn btna btn-sm btn-primary rounded-top col-md-0">
                        <?php foreach ($keranjang as $item) {
                            $grand_total = $grand_total + $item['subtotal'];
                        }
                        echo "Total Pesanan Anda: Rp. " . number_format($grand_total, 0, ',', '.');
                        ?>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="m-0 font-weight-bold text-dark mb-3 mt-3">Pilih No. Meja</h4>
                        <form action="<?php echo base_url() ?>dashboard/proses" method="post">
                            <div class="form-group"><br>
                                <input type="text" class="form-control mb-3" name="no_meja" id="no_meja" placeholder="atau klik no meja di samping" required>
                                <input type="hidden" class="form-control" name="nama_user" id="nama_user" value="<?php echo $this->session->userdata('username') ?>" required>
                                <input type="hidden" class="form-control" name="total" id="total" value="<?php echo $grand_total ?>" required>
                            </div><br>
                            <div align="right" class="mt-3-i">
                                <button type="submit" class="btn btn-sm btn-primary">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

        <!-- Card dan Form Kedua -->
        <div class="col-md-5">

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

                    echo '<table class="table align-items-center mb-0" id="mejaTable">';
                    $start_number = 1;

                    for ($i = 1; $i <= 4; $i++) {
                        echo '<tr>';
                        for ($j = 1; $j <= 10; $j++) {
                            if (isset($no_meja_status[$start_number])) {
                                echo '<td>---</td>';
                            } else {
                                echo '<td><button class="meja-btn btn-sm btn" data-no="' . $start_number . '">' . $start_number . '</button></td>';
                            }
                            $start_number++;
                        }
                        echo '</tr>';
                    }

                    echo '</table>';
                    ?>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var mejaButtons = document.querySelectorAll('.meja-btn');
                    var no_mejaInput = document.getElementById('no_meja');

                    mejaButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var no_meja = button.getAttribute('data-no');
                            no_mejaInput.value = no_meja;
                        });
                    });
                });
            </script>

        </div>
    </div>
</div>
</div>
<?php
            } else {
                echo '<script>window.location.href="' . base_url() . 'dashboard"</script>';
            }
?>