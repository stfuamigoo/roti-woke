<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800 mr-4">List Varian</h1>
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
      <div class="card-header">Pilih Varian</div>
      <div class="card-body">
        <form action="<?php echo site_url('perhitungan/varian'); ?>" method="GET">
          <div class="form-group row">
            <div class="col-md-9">
              <label for="exampleFormControlSelect1">Varian</label>
              <select class="form-control" id="nama_varian" name="nama_varian">
                <option value="" selected hidden disabled>Pilih Varian</option>
                <option value="coklat" <?php echo ($selected_varian == 'coklat') ? 'selected' : ''; ?>>Coklat</option>
                <option value="chocomaltine" <?php echo ($selected_varian == 'chocomaltine') ? 'selected' : ''; ?>>Chocomaltine</option>
                <option value="kopi coklat" <?php echo ($selected_varian == 'kopi coklat') ? 'selected' : ''; ?>>Kopi Coklat</option>
                <option value="kopi keju" <?php echo ($selected_varian == 'kopi keju') ? 'selected' : ''; ?>>Kopi Keju</option>
                <option value="sosis" <?php echo ($selected_varian == 'sosis') ? 'selected' : ''; ?>>Sosis</option>
              </select>
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
    <div class="card-header">Penjualan / Varian</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
          <thead>
            <tr>
              <td>Tahun</td>
              <td>Bulan</td>
              <td>Data Aktual</td>
              <td>Prediksi</td>
              <td>MAPE</td>
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

  <!-- Bar Chart -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
    </div>
    <div class="card-body">
      <div class="chart-bar">
        <canvas id="myBarChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Statement -->
  <div class="card">
    <div class="card-header">Statement</div>
    <div class="card-body">
      Prediksi bulan selanjutnya adalah: <?php echo $statement; ?>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>

</script>