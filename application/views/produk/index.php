<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">List Varian</h1>
        <a class="btn btn-primary" href="<?php echo site_url(); ?>Produk/tambah_produk">Tambah</a>
    </div>

    <?php if ($this->session->flashdata('danger_alert')) : ?>
        <div class="alert alert-dismissible alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('danger_alert'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success_alert')) : ?>
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('success_alert'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $prod) : ?>
                            <tr>
                                <td><?php echo $prod['nama'] ?></td>
                                <td><?php echo $prod['harga'] ?></td>
                                <td><?php echo $prod['keterangan'] ?></td>
                                <td>
                                    <a href="<?php echo site_url(); ?>produk/hapus_produk/<?php echo $prod['id']; ?>"><span class="badge badge-danger">Hapus</span></a>
                                    <a href="<?php echo site_url(); ?>produk/edit_produk/<?php echo $prod['id']; ?>"><span class="badge badge-secondary">Edit</span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->