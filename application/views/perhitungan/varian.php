<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800 mr-4">Perhitungan Penjualan / Varian</h1>
  </div>

  <div class="card-shadow mb-4">
    <div class="card">
      <div class="card-header">Pilih Varian & Periode</div>
      <div class="card-body">
        <form action="<?php echo site_url('perhitungan/varian'); ?>" method="GET">
          <div class="form-group row">
            <div class="col-md-4">
              <label for="exampleFormControlSelect1">Varian</label>
              <select class="form-control" id="nama_varian" name="nama_varian">
                <option value="" selected hidden disabled>Pilih Varian</option>
                <option value='1' <?php echo ($selected_varian == 'pizza mini') ? 'selected' : ''; ?>>Pizza Mini</option>
                <option value='2' <?php echo ($selected_varian == 'kopi') ? 'selected' : ''; ?>>Kopi</option>
                <option value='3' <?php echo ($selected_varian == 'sosis') ? 'selected' : ''; ?>>Sosis</option>
              </select>
            </div>
            <div class="col-md-4">
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
              <td>Error</td>
              <td>Absolute Error</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($prediksi as $pre) : ?>
              <tr>
                <td><?php echo $pre['tahun']; ?></td>
                <td><?php echo $pre['bulan']; ?></td>
                <td><?php echo $pre['total_penjualan']; ?></td>
                <td><?php echo $pre['prediksi']; ?></td>
                <td><?php echo $pre['error']; ?></td>
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
      <h6 class="m-0 font-weight-bold text-primary">Diagram Varian</h6>
    </div>
    <div class="card-body">
      <div class="chart-bar">
        <canvas id="diagramVarian"></canvas>
      </div>
    </div>
  </div>

  <!-- Statement -->
  <div class="card mb-4">
    <div class="card-header">Prediksi</div>
    <div class="card-body">
      Prediksi bulan selanjutnya adalah: <?php echo $statement; ?>
    </div>
  </div>

  <!-- Statement -->
  <div class="card mb-4">
    <div class="card-header">MAPE</div>
    <div class="card-body">
      MAPE : <?php echo $mape; ?> %
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>

</script>