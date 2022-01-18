<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Varian</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url(); ?>produk/tambah_produk" method="post">
                        <div class="form-group row">
                            <label for="nama" class="col-lg-3 col-form-label">Nama Varian *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama" name="nama" autofocus><?php echo set_value('nama'); ?></input>
                                <?php echo form_error('nama', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-lg-3 col-form-label">Harga *</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" id="harga" name="harga"><?php echo set_value('harga'); ?></input>
                                <?php echo form_error('harga', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-lg-3 col-form-label">Keterangan *</label>
                            <div class="col-lg-9">
                                <input type="keterangan" class="form-control" id="keterangan" name="keterangan"><?php echo set_value('keterangan'); ?></input>
                                <?php echo form_error('keterangan', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <small style="color: red;">*harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url(); ?>produk" class="btn btn-secondary ml-auto">Kembali</a>
                            <button type="submit" class="btn btn-primary ml-3">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->