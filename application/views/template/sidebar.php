<body style="background-color: var(--bs-gray-400);">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">
                Start Bootstrap
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo base_url('welcome') ?>">Home</a></li>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori </a>
                        <ul class="dropdown-menu" style="background-color: var(--bs-gray-400);">
                            <li><a class="btn dropdown-item" href="<?php echo base_url('kategori/makanan') ?>">Makanan</a></li>
                            <li><a class="btn dropdown-item" href="<?php echo base_url('kategori/minuman') ?>">Minuman</a></li>
                        </ul>
                    </div>
                </ul>
                <div class="d-flex">
                    <?php $keranjangs = $this->cart->total_items() ?>
                    <button class="btn btn-outline" style="border-color: var(--bs-gray-400); color: var(--bs-gray-400);" onmouseenter="this.style.backgroundColor='var(--bs-gray-400)'; this.style.color='black';" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='var(--bs-gray-400)';" onclick="this.style.backgroundColor='darkgray'; this.style.borderColor='darkgray'; window.location.href='<?php echo site_url('dashboard/detail_keranjang'); ?>'">
                        <i class="bi-cart-fill me-1"></i> Cart
                        <span class="badge text-dark ms-1 rounded-pill" style="background-color: var(--bs-gray-400);">
                            <?php echo $keranjangs > 9 ? '9+' : $keranjangs; ?>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <script>
    $(document).ready(function() {
      $('#level').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [10, 25, 50, 75, 100],
        "processing": true,
        "searching": true,
        "ordering": true,
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
    function printTable() {
      var printContents = document.querySelector("#level").outerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>