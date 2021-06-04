<?php
include 'utility/config.php';

// $films = query("SELECT * FROM films");
$films = query("SELECT *, YEAR(CURDATE()) - rilis AS 'telah rilis' FROM films");
$tampil_data_default = true;
$tampil_data_crisp = false;

// jika tombol "derajat keanggotaan" di-klik
if (isset($_POST['dk'])) {
  $derajat_keanggotaan_films = get_derajat_keanggotaan($films);
  $tampil_data_default = false;
  // var_dump($derajat_keanggotaan_films);
}

// jika tombol "himpunan crisp" di-klik
if (isset($_POST['dc']) || isset($_POST['cari'])) {
  $tampil_data_default = false;
  $tampil_data_crisp = true;

  $derajat_keanggotaan_films = get_derajat_keanggotaan($films);
  $data_crisp_films = get_data_crisp($derajat_keanggotaan_films);

  if (isset($_POST['cari'])) {
    $rating = $_POST['rating'] !== 'none' ? $_POST['rating'] : false;
    $rilis = $_POST['rilis'] !== 'none' ? $_POST['rilis'] : false;
    $duration = $_POST['duration'] !== 'none' ? $_POST['duration'] : false;
    // var_dump($rating, $rilis, $duration);

    if (!$rating && !$rilis && !$duration) {
      echo "<script>alert('isikan minimal salah satu parameter!')</script>";
    } else {
      // echo "proses filter data";
      $data_crisp_films = filter_data_crisp($data_crisp_films, [$rating, $rilis, $duration]);
      // var_dump($data_crisp_films);
      // die;
    }
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="public/css/bootstrap.css">

  <title>my project</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">Fuzzy Database</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid mt-4">
    <h3 class="text-center mb-3">Data Films</h3>

    <!-- tampilkan data default/mentah -->
    <?php if ($tampil_data_default) : ?>
      <form action="" method="POST">
        <a href="film.php" class="btn btn-secondary btn-sm">Data mentah</a>
        <button class="btn btn-success btn-sm" name="dk">derajat keanggotaan</button>
        <button class="btn btn-success btn-sm" name="dc">himpunan crisp</button>
      </form>
      <table class="table table-striped table-bordered mt-2">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Penulis</th>
            <th scope="col">Genre</th>
            <th scope="col">Rating</th>
            <th scope="col">Rilis</th>
            <th scope="col">Durasi(menit)</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($films as $film) : ?>
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?= $film['name'] ?></td>
              <td><?= $film['writer'] ?></td>
              <td><?= $film['genre'] ?></td>
              <td><?= $film['rating'] ?></td>
              <td><?= $film['rilis'] ?></td>
              <td><?= $film['duration'] ?></td>
            </tr>
          <?php $i++;
          endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- tampilkan data derajat keanggotaan -->
    <?php if (isset($_POST['dk'])) : ?>
      <form action="" method="POST">
        <a href="film.php" class="btn btn-success btn-sm">Data mentah</a>
        <button class="btn btn-secondary btn-sm" name="dk">derajat keanggotaan</button>
        <button class="btn btn-success btn-sm" name="dc">himpunan crisp</button>
      </form>
      <table class="table table-striped table-bordered mt-2">
        <thead>
          <tr>
            <th scope="col" rowspan="2" class="align-middle">No</th>
            <th scope="col" rowspan="2" class="align-middle">Nama</th>
            <th scope="col" rowspan="2" class="align-middle">Penulis</th>
            <th scope="col" rowspan="2" class="align-middle">Genre</th>
            <th scope="col" rowspan="2" class="align-middle">Rating</th>
            <th scope="col" rowspan="2" class="align-middle">Rilis</th>
            <th scope="col" rowspan="2" class="align-middle">Durasi(menit)</th>
            <th scope="col" colspan="4" class="text-center">Rating</th>
            <th scope="col" colspan="3" class="text-center">Rilis</th>
            <th scope="col" colspan="3" class="text-center">Durasi</th>
          </tr>
          <tr>
            <th scope="col">jelek</th>
            <th scope="col">cukup bagus</th>
            <th scope="col">bagus</th>
            <th scope="col">sangat bagus</th>
            <th scope="col">baru</th>
            <th scope="col">cukup lama</th>
            <th scope="col">lama</th>
            <th scope="col">pendek</th>
            <th scope="col">normal</th>
            <th scope="col">panjang</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($derajat_keanggotaan_films as $film) : ?>
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?= $film['name'] ?></td>
              <td><?= $film['writer'] ?> inch</td>
              <td><?= $film['genre'] ?></td>
              <td><?= $film['rating'] ?></td>
              <td><?= $film['rilis'] ?></td>
              <td><?= $film['duration'] ?></td>
              <td><?= $film['r_jelek'] ?></td>
              <td><?= $film['r_cukup_bagus'] ?></td>
              <td><?= $film['r_bagus'] ?></td>
              <td><?= $film['r_sangat_bagus'] ?></td>
              <td><?= $film['rl_baru'] ?></td>
              <td><?= $film['rl_cukup_lama'] ?></td>
              <td><?= $film['rl_lama'] ?></td>
              <td><?= $film['d_pendek'] ?></td>
              <td><?= $film['d_normal'] ?></td>
              <td><?= $film['d_panjang'] ?></td>
            </tr>
          <?php $i++;
          endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>


    <!-- tampilkan data crisp -->
    <?php if ($tampil_data_crisp) : ?>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-5">
            <div class="card">
              <div class="card-body">
                <form method="POST">
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-4 text-center">
                        <label for="ram" class="form-label">Rating</label>
                        <select id="ram" class="form-select" name="rating">
                          <option value="none">Pilih</option>
                          <option value="jelek">jelek</option>
                          <option value="cukup bagus">cukup bagus</option>
                          <option value="bagus">bagus</option>
                          <option value="sangat bagus">sangat bagus</option>
                        </select>
                      </div>
                      <div class="col-4 text-center">
                        <label for="rom" class="form-label">Rilis</label>
                        <select id="rom" class="form-select" name="rilis">
                          <option value="none">Pilih</option>
                          <option value="baru">baru</option>
                          <option value="cukup lama">cukup lama</option>
                          <option value="lama">lama</option>
                        </select>
                      </div>
                      <div class="col-4 text-center">
                        <label for="battrey" class="form-label">Durasi</label>
                        <select id="battrey" class="form-select" name="duration">
                          <option value="none">Pilih</option>
                          <option value="pendek">pendek</option>
                          <option value="normal">normal</option>
                          <option value="panjang">panjang</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary" name="cari">Cari</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <form action="" method="POST">
        <a href="film.php" class="btn btn-success btn-sm">Data mentah</a>
        <button class="btn btn-success btn-sm" name="dk">derajat keanggotaan</button>
        <button class="btn btn-secondary btn-sm" name="dc">himpunan crisp</button>
      </form>
      <table class="table table-striped table-bordered mt-2">
        <thead>
          <tr>
            <th scope="col" rowspan="2" class="align-middle">No</th>
            <th scope="col" rowspan="2" class="align-middle">Nama</th>
            <th scope="col" rowspan="2" class="align-middle">Penulis</th>
            <th scope="col" rowspan="2" class="align-middle">Genre</th>
            <th scope="col" rowspan="2" class="align-middle">Rating</th>
            <th scope="col" rowspan="2" class="align-middle">Rilis</th>
            <th scope="col" rowspan="2" class="align-middle">Durasi</th>
            <th scope="col" colspan="3" class="text-center">Data Crisp</th>
          </tr>
          <tr>
            <th scope="col">Rating</th>
            <th scope="col">Rilis</th>
            <th scope="col">Durasi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($data_crisp_films as $film) : ?>
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?= $film['name'] ?></td>
              <td><?= $film['writer'] ?> inch</td>
              <td><?= $film['genre'] ?></td>
              <td><?= $film['rating'] ?></td>
              <td><?= $film['rilis'] ?></td>
              <td><?= $film['duration'] ?></td>
              <td><?= $film['c_rating'] ?></td>
              <td><?= $film['c_rilis'] ?></td>
              <td><?= $film['c_duration'] ?></td>
            </tr>
          <?php $i++;
          endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

  </div>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
  <script src="public/js/bootstrap.js"></script>
</body>

</html>