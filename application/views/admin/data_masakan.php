<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4"> <br><br>
            <div class="card shadow mb-4" style="background-color: var(--bs-gray-200);">
                <div class="card-header py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-dark">Data Masakan</h6>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Masakan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>NO</th>
                                <th>NAMA MASAKAN</th>
                                <th>KATEGORI</th>
                                <th>HARGA</th>
                                <th colspan="3">AKSI</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($masakan as $brg) :
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $brg->nama_masakan; ?></td>
                                    <td><?php echo $brg->kategori; ?></td>
                                    <td><?php echo "Rp " . number_format($brg->harga, 0, ",", "."); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $brg->id_masakan; ?>"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $brg->id_masakan; ?>"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Masakan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('admin/data_masakan/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama">Nama Masakan</label>
                                            <input type="text" class="form-control" name="nama_masakan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Kategori</label>
                                            <select name="kategori" class="form-control">
                                                <option>Makanan</option>
                                                <option>Minuman</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Harga</label>
                                            <input type="number" class="form-control" name="harga" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Gambar</label>
                                            <input type="file" class="form-control" name="gambar" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <?php foreach ($masakan as $brg) : ?>
                <div class="modal fade" id="editModal<?php echo $brg->id_masakan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Masakan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('admin/data_masakan/edit_aksi/' . $brg->id_masakan); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nama">Nama Masakan</label>
                                        <input type="hidden" class="form-control" name="id_masakan" value="<?php echo $brg->id_masakan; ?>">
                                        <input type="text" class="form-control" name="nama_masakan" value="<?php echo $brg->nama_masakan; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" class="form-control">
                                            <option value="<?php echo $brg->harga; ?>"><?php echo $brg->kategori; ?></option>
                                            <option>Masakan</option>
                                            <option>Minuman</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control" name="harga" value="<?php echo $brg->harga; ?>">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hapus Modal -->
                <div class="modal fade" id="hapusModal<?php echo $brg->id_masakan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Masakan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda yakin ingin menghapus <?php echo $brg->nama_masakan ?>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <a href="<?php echo base_url('admin/data_masakan/hapus_aksi/' . $brg->id_masakan); ?>" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
</div>
</main>
</div>