<br><br><br>
<div class="container-fluid">
    <div class="card shadow mb-4" style="background-color: var(--bs-gray-200);">
        <div class="card-body">
            <h6 class="m-0 font-weight-bold text-dark mb-3">Detail Pesanan</h6>
            <div class="table-responsive">
                <table class="table table-bordered" cellspacing="0">
                    <tr>
                        <th>No</th>
                        <th>Nama Masakan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <td align="center">UPDATE</td>
                        <td align="center"></td>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($this->cart->contents() as $items) :
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $items['name'] ?></td>
                            <td>
                                <form action="<?php echo site_url('dashboard/tambah_pembelian/' . $items['id']) ?>" method="post">
                                    <input style="background-color: var(--bs-gray-200);" class="form-control quantity-input" type="number" name="pembelian" value="<?php echo $items['qty'] ?>" min="1" max="10" data-price="<?php echo $items['price']; ?>">
                            </td>
                            <td align="right"><?php echo "Rp " . number_format($items['price'], 0, ",", ".")  ?></td>
                            <td align="right" class="subtotal"><?php echo "Rp " . number_format($items['subtotal'], 0, ",", ".")  ?></td>
                            <td align="center"> <button class="btn btn-primary" type="submit"><i class="fas fa-pen-to-square fa-sm"></i></i></a>
                            <td align="center"><a href="<?php echo base_url('dashboard/hapus_id/') . $items['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash fa-sm"></i></a></td>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    <tr>
                        <td class="td-a" align="right" colspan="4">Total :</td>
                        <td align="right" id="total">
                            <?php echo "Rp " . number_format($this->cart->total(), 0, ",", ".") ?>
                        </td>
                        <td></td>
                    </tr>
                </table>
                <div align="right">
                    <button class="btn btn-sm btn-danger" type="button" onclick="window.location.href='<?php echo site_url('dashboard/hapus'); ?>'">
                        <i class="fas fa-trash fa-sm"></i> Hapus
                    </button>
                    <button class="btn btn-sm btn-success" type="button" onclick="window.location.href='<?php echo site_url('dashboard/bayar'); ?>'">
                        <i class="fas fa-money-bill fa-sm"></i> Bayar
                    </button>
                </div>

                <button class="btn btn-sm btn-dark" type="button" onclick="window.location.href='<?php echo site_url('welcome'); ?>'">
                    <i class="fas fa-backward fa-sm"></i> Kembali
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };

        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        var re = /(-?\d+)(\d{3})/;
        while (re.test(s[0])) {
            s[0] = s[0].replace(re, '$1' + sep + '$2');
        }

        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }

        return s.join(dec);
    }

    $('.quantity-input').on('input', function() {
        var quantity = $(this).val();
        var price = $(this).data('price');
        var subtotal = quantity * price;

        $(this).closest('tr').find('.subtotal').text("Rp " + number_format(subtotal, 0, ",", "."));

        updateTotal();
    });

    function updateTotal() {
        var total = 0;
        $('.subtotal').each(function() {
            var subtotalText = $(this).text().replace('Rp ', '').replace(/\./g, '');
            total += parseFloat(subtotalText);
        });

        $('#total').text("Rp " + number_format(total, 0, ",", "."));
    }
</script>