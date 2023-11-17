
<!-- Header-->
<header style="background-color: var(--bs-gray-400); padding: 5rem;">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-dark">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-dark-50 mb-0">With this shop homepage template</p>
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-5 bg-dark">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($masakan as $brg) : ?>
                <div class="col mb-5">
                    <div class="card h-100 bg-secondary">
                        <img src="<?php echo base_url() . '/uploads/' . $brg->gambar ?>" class="card-img-top" alt="...">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder text-white"><?php echo $brg->nama_masakan ?></h5>
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <span class="text-white"><?php echo "Rp " . number_format($brg->harga, 0, ",", "."); ?></span>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-light mt-auto" href="<?php echo site_url('dashboard/tambah_keranjang/' . $brg->id_masakan) ?>">Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>