<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">List Data Aktual</h1>
        <a class="btn btn-primary" href="<?php echo site_url(); ?>Data_Aktual/import_file">Import</a>
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
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_penjualan as $penjualan) : ?>
                            <tr>
                                <?php
                                $seperate_date = $penjualan['tanggal'];
                                $seperate_date = explode('-', $seperate_date);
                                $tahun = $seperate_date[0];
                                $bulan = $seperate_date[1];
                                $tanggal = $seperate_date[2];
                                ?>
                                <td><?php echo $tahun ?></td>
                                <td><?php echo date('F', $bulan) ?></td>
                                <td><?php echo $tanggal ?></td>
                                <td><?php echo $penjualan['penjualan'] ?></td>
                                <td>
                                    <a href="<?php echo site_url(); ?>data_aktual/hapus_penjualan/<?php echo $penjualan['id']; ?>"><span class="badge badge-danger">Hapus</span></a>
                                    <a href="<?php echo site_url(); ?>data_aktual/edit_penjualan/<?php echo $penjualan['id']; ?>"><span class="badge badge-secondary">Edit</span></a>
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