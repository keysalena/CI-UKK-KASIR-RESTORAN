<body style="background-color: var(--bs-gray-400);">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">
                Start Bootstrap
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu navbar-dark bg-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-light" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item text-light" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item text-light" href="#!">New Arrivals</a></li>
                        </ul>

                    </li>
                </ul>
                <div class="d-flex">
                    <?php $keranjangs = $this->cart->total_items() ?>
                    <button class="btn btn-outline-light" type="button" onclick="window.location.href='<?php echo site_url('dashboard/detail_keranjang'); ?>'">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-light text-dark ms-1 rounded-pill"> <?php echo $keranjangs > 9 ? '9+' : $keranjangs; ?>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </nav>