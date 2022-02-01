<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Drug List</h6>
        </div>
        <?= $this->session->flashdata('message') ?>
        <div class="card-body">
            <div class="table-responsive">
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#MenuModal">Add New Drug </a>
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- <th>Foto</th> -->
                            <th>Nama Obat</th>
                            <th>Produsen</th>
                            <th>Harga</th>
                            <th>Jumlah Stock</th>
                            <th>Kode Obat</th>
                            <th>Supplier</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($obat as $o) : ?>
                            <tr>
                                <!-- <th><img src="<?= base_url('assets/img/obat/') . $o['FOTO']; ?>" class="img-thumbnail" width="100" height="100"></th> -->
                                <th><?= $o['NAMA_OBAT']; ?></th>
                                <th><?= $o['PRODUSEN']; ?></th>
                                <th><?= $o['HARGA']; ?></th>
                                <th><?= $o['JML_STOK']; ?></th>
                                <th><?= $o['KODE_OBAT']; ?></th>
                                <th><?= $o['KODE_SUPPLIER']; ?></th>
                                <th>
                                    <a href="" class="badge badge-sm badge-info" data-toggle="modal" data-target="#modal<?php echo $o['KODE_OBAT']; ?>">Edit</a>
                                    <a href="<?= base_url('drug/delete/') . $o['KODE_OBAT'] ?>" class="badge badge-danger" onclick="return confirm('yakin');">Hapus</a>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- modal Edit Menu -->
<?php foreach ($obat as $o) : ?>
    <div class="modal fade" id="modal<?php echo $o['KODE_OBAT']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit name drug</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('drug/editdrug') . $o['KODE_OBAT']; ?>" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Drug name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $o['NAMA_OBAT']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="produsen">Produsen</label>
                            <input type="text" class="form-control" id="produsen" name="produsen" value="<?php echo $o['PRODUSEN']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $o['HARGA']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $o['JML_STOK']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Kobat">Kode Obat</label>
                            <input type="text" class="form-control" id="Kobat" name="Kobat" value="<?php echo $o['KODE_OBAT']; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Supplier</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected></option>
                                <?php foreach ($supplier as $s) : ?>
                                    <option value="<?= $s['KODE_SUPPLIER']; ?>"><?= $s['NAMA_SUPPLIER'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- end modal Edit Menu -->

<!-- Modal Insert Menu-->

<div class="modal fade" id="MenuModal" tabindex="-1" aria-labelledby="MenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MenuModalLabel">Add New Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('drug/add') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Drug Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="produsen" name="produsen" placeholder="Produsen Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kobat" name="kobat" placeholder="Kode Obat">
                    </div>
                    <div class="form-group">
                        <select class="custom-select" id="supplier" name="supplier">
                            <option selected>Choose...</option>
                            <?php foreach ($supplier as $s) : ?>
                                <option value="<?= $s['KODE_SUPPLIER']; ?>"><?= $s['NAMA_SUPPLIER'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- end Modal Insert Menu-->