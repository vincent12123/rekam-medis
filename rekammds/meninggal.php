<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Foto Rotgen";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_pasien'];
    $keterangan = $_POST['keterangan'];
    $biaya = $_POST['biaya'];

    $up2 = mysqli_query($conn, "UPDATE meninggal SET nama_pasien='$nama', keterangan='$keterangan', biaya='$biaya' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Pasien meninggal berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
  }

  if (isset($_POST['submit2'])) {
    $nama = $_POST['nama_pasien'];
    $keterangan = $_POST['keterangan'];
    $biaya = $_POST['biaya'];

    $add = mysqli_query($conn, "INSERT INTO meninggal (nama_pasien, keterangan, biaya) VALUES ('$nama', '$keterangan', '$biaya')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Pasien baru meninggal telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
  }
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
            <h1><?php echo $page; ?></h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <h4><?php echo $page; ?></h4>
                    <div class="card-header-action">
                      <a href="#" class="btn btn-primary" data-target="#addObat" data-toggle="modal">Tambahkan Pasien Baru</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                          <th class="text-center">No</th>
                            <th>Nama Pasien</th>
                            <th>Keterangan</th>
                            <th>Biaya</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $sql = mysqli_query($conn, "SELECT * FROM meninggal");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo ucwords($row['nama_pasien']) ?></td>
                              <td><?php echo ucwords($row['keterangan']) ?></td>
                              <td>Rp. <?php echo number_format($row['biaya'], 0, ".", "."); ?></td>
                              <td align="center">
                                <span data-target="#editObat" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-harga="<?php echo $row['biaya']; ?>" data-stok="<?php echo $row['keterangan']; ?>">
                                  <a class="btn btn-primary btn-action mr-1" title="Edit Data Pasien" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                </span>
                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=meninggal&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


      <div class="modal fade" tabindex="-1" role="dialog" id="addObat">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Pasien</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pasien</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama_pasien" required="" id="getNama">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="keterangan" required="" id="getNama">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Biaya</label>
                  <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Rp
                      </div>
                    </div>
                    <input type="number" class="form-control" name="biaya" required="" value="0">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="editObat">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pasien</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="text" class="form-control" name="nama_pasien" required="" id="getNama">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="keterangan" required="" id="getStok">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Biaya</label>
                  <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Rp
                      </div>
                    </div>
                    <input type="number" class="form-control" name="biaya" required="" id="getHarga">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>

  <script>
    $('#editObat').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var nama = button.data('nama_pasien')
      var id = button.data('id')
      var keterangan = button.data('keterangan')
      var biaya = button.data('biaya')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getNama').val(nama)
      modal.find('#getStok').val(keterangan)
      modal.find('#getHarga').val(biaya)
    })
  </script>

</body>

</html>