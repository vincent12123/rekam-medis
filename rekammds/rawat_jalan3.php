<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Pengambilan Obat oleh Pasien";
  $page1 = "raw3";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $mbuh; ?></h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $page; ?></h4>
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" autocomplete="off" action="rawat_jalan_print.php">
                      <div class="form-group row">
                        <label class="col-md-3">Kode Pengambilan Obat & Pembayaran</label>
                        <div class="col-lg-6 col-md-6">
                          <input type="hidden" required="" name="page" value="raw3">
                          <input type="number" class="form-control" required="" name="kode" placeholder="Masukkan Kode Obat">
                          <div class="invalid-feedback">
                            Mohon data diisi!
                          </div><br>
                        <button class="btn btn-primary" name="submit">Selesai</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    </section>
  </div>
  <?php include 'part/footer.php'; ?>
  </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>