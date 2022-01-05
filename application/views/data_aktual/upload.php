<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Import Data Aktual</h1>
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

    <div class="card">
        <div class="card-body">
            File yang ingin diimport harus berekstensi <a class="text-danger">.xls, .xlsx</a>
            <form enctype="multipart/form-data" action="<?php echo base_url('Data_Aktual/import_file') ?>" method="POST">
                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                    <label for="upload-file">Pilih File</label>
                    <input type="file" class="form-control-file" name="upload-file" required accept=".xls, .xlsx">
                </div>
                <div class="d-flex mt-4">
                    <a href="<?php echo site_url(); ?>Data_Aktual" class="btn btn-secondary ml-auto">Kembali</a>
                    <button type="submit" class="btn btn-primary ml-3">Tambah</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->