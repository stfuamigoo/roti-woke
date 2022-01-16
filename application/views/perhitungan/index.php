<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">List Data Perhitungan Penjualan</h1>
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

    <div class="card-shadow mb-4">
        <div class="card">
            <div class="card-header">Periode</div>
            <div class="card-body">
                <form action="<?php echo site_url('perhitungan/perhitungan'); ?>" method="GET">
                    <div class="form-group row">
                        <div class="col-md-9">
                            <label for="exampleFormControlSelect1">Input Periode</label>
                            <input type="number" class="form-control" id="periode" name="periode">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Tampil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">Penjualan</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Tahun</td>
                            <td>Bulan</td>
                            <td>Data Aktual</td>
                            <td>Prediksi</td>
                            <td>Error</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prediksi as $pre) : ?>
                            <tr>
                                <td><?php echo $pre['tahun']; ?></td>
                                <td><?php echo $pre['bulan']; ?></td>
                                <td><?php echo $pre['total_penjualan']; ?></td>
                                <td><?php echo $pre['prediksi']; ?></td>
                                <td><?php echo $pre['mape']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Statement -->
    <div class="card">
        <div class="card-header">MAPE</div>
        <div class="card-body">
        MAPE: <?php echo $mape; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->