<?php
include 'utility/config.php';

$smartphones = query("SELECT * FROM smartphones");
$tampil_data_default = true;
$tampil_data_crisp = false;

// jika tombol "derajat keanggotaan" di-klik
if (isset($_POST['dk'])) {
  $derajat_keanggotaan_smartphones = get_derajat_keanggotaan($smartphones);
  $tampil_data_default = false;
  // var_dump($derajat_keanggotaan_smartphones);
}

// jika tombol "himpunan crisp" di-klik
if (isset($_POST['dc']) || isset($_POST['cari'])) {
  $tampil_data_default = false;
  $tampil_data_crisp = true;

  $derajat_keanggotaan_smartphones = get_derajat_keanggotaan($smartphones);
  $data_crisp_smartphones = get_data_crisp($derajat_keanggotaan_smartphones);

  if (isset($_POST['cari'])) {
    $ram = $_POST['ram'] !== 'none' ? $_POST['ram'] : false;
    $rom = $_POST['rom'] !== 'none' ? $_POST['rom'] : false;
    $battrey = $_POST['battrey'] !== 'none' ? $_POST['battrey'] : false;
    // var_dump($ram, $rom, $battrey);

    if (!$ram && !$rom && !$battrey) {
      echo "<script>alert('isikan minimal salah satu parameter!')</script>";
    } else {
      // echo "proses filter data";
      $data_crisp_smartphones = filter_data_crisp($data_crisp_smartphones, [$ram, $rom, $battrey]);
      // var_dump($data_crisp_smartphones);
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
      <a class="navbar-brand" href="index.php">Fuzzy Database</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid mt-4">
    <h3 class="text-center mb-3">Data Smartphones</h3>
    <form action="" method="POST">
      <a href="smartphone.php" class="btn btn-success btn-sm">Data mentah</a>
      <button class="btn btn-success btn-sm" name="dk">derajat keanggotaan</button>
      <button class="btn btn-success btn-sm" name="dc">himpunan crisp</button>
    </form>

    <!-- tampilkan data default/mentah -->
    <?php if ($tampil_data_default) : ?>
      <table class="table table-striped table-bordered mt-2">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Ukuran Layar</th>
            <th scope="col">OS</th>
            <th scope="col">RAM</th>
            <th scope="col">ROM</th>
            <th scope="col">Kapasitas Batrei</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($smartphones as $smartphone) : ?>
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?= $smartphone['name'] ?></td>
              <td><?= $smartphone['screen_size'] ?> inch</td>
              <td><?= $smartphone['os'] ?></td>
              <td><?= $smartphone['ram'] ?> GB</td>
              <td><?= $smartphone['rom'] ?> GB</td>
              <td><?= $smartphone['battrey_capacity'] ?> mAh</td>
            </tr>
          <?php $i++;
          endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- tampilkan data derajat keanggotaan -->
    <?php if (isset($_POST['dk'])) : ?>
      <table class="table table-striped table-bordered mt-2">
        <thead>
          <tr>
            <th scope="col" rowspan="2" class="align-middle">No</th>
            <th scope="col" rowspan="2" class="align-middle">Nama</th>
            <th scope="col" rowspan="2" class="align-middle">Ukuran Layar</th>
            <th scope="col" rowspan="2" class="align-middle">OS</th>
            <th scope="col" rowspan="2" class="align-middle">RAM</th>
            <th scope="col" rowspan="2" class="align-middle">ROM</th>
            <th scope="col" rowspan="2" class="align-middle">Kapasitas Battrey</th>
            <th scope="col" colspan="3" class="text-center">RAM</th>
            <th scope="col" colspan="3" class="text-center">ROM</th>
            <th scope="col" colspan="3" class="text-center">Kapasitas Battrey</th>
          </tr>
          <tr>
            <th scope="col">kecil</th>
            <th scope="col">sedang</th>
            <th scope="col">besar</th>
            <th scope="col">kecil</th>
            <th scope="col">sedang</th>
            <th scope="col">besar</th>
            <th scope="col">kecil</th>
            <th scope="col">sedang</th>
            <th scope="col">besar</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($derajat_keanggotaan_smartphones as $smartphone) : ?>
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?= $smartphone['name'] ?></td>
              <td><?= $smartphone['screen_size'] ?> inch</td>
              <td><?= $smartphone['os'] ?></td>
              <td><?= $smartphone['ram'] ?> GB</td>
              <td><?= $smartphone['rom'] ?> GB</td>
              <td><?= $smartphone['battrey'] ?> mAh</td>
              <td><?= $smartphone['ram_kecil'] ?></td>
              <td><?= $smartphone['ram_sedang'] ?></td>
              <td><?= $smartphone['ram_besar'] ?></td>
              <td><?= $smartphone['rom_kecil'] ?></td>
              <td><?= $smartphone['rom_sedang'] ?></td>
              <td><?= $smartphone['rom_besar'] ?></td>
              <td><?= $smartphone['battrey_kecil'] ?></td>
              <td><?= $smartphone['battrey_sedang'] ?></td>
              <td><?= $smartphone['battrey_besar'] ?></td>
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
                        <label for="ram" class="form-label">RAM</label>
                        <select id="ram" class="form-select" name="ram">
                          <option value="none">Pilih</option>
                          <option value="kecil">kecil</option>
                          <option value="sedang">sedang</option>
                          <option value="besar">besar</option>
                        </select>
                      </div>
                      <div class="col-4 text-center">
                        <label for="rom" class="form-label">ROM</label>
                        <select id="rom" class="form-select" name="rom">
                          <option value="none">Pilih</option>
                          <option value="kecil">kecil</option>
                          <option value="sedang">sedang</option>
                          <option value="besar">besar</option>
                        </select>
                      </div>
                      <div class="col-4 text-center">
                        <label for="battrey" class="form-label">Battrey</label>
                        <select id="battrey" class="form-select" name="battrey">
                          <option value="none">Pilih</option>
                          <option value="kecil">kecil</option>
                          <option value="sedang">sedang</option>
                          <option value="besar">besar</option>
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
      <table class="table table-striped table-bordered mt-2">
        <thead>
          <tr>
            <th scope="col" rowspan="2" class="align-middle">No</th>
            <th scope="col" rowspan="2" class="align-middle">Nama</th>
            <th scope="col" rowspan="2" class="align-middle">Ukuran Layar</th>
            <th scope="col" rowspan="2" class="align-middle">OS</th>
            <th scope="col" rowspan="2" class="align-middle">RAM</th>
            <th scope="col" rowspan="2" class="align-middle">ROM</th>
            <th scope="col" rowspan="2" class="align-middle">Kapasitas Batrei</th>
            <th scope="col" colspan="3" class="text-center">Data Crisp</th>
          </tr>
          <tr>
            <th scope="col">RAM</th>
            <th scope="col">ROM</th>
            <th scope="col">Kapasitas Battrey</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($data_crisp_smartphones as $smartphone) : ?>
            <tr>
              <th scope="row"><?= $i ?></th>
              <td><?= $smartphone['name'] ?></td>
              <td><?= $smartphone['screen_size'] ?> inch</td>
              <td><?= $smartphone['os'] ?></td>
              <td><?= $smartphone['ram'] ?> GB</td>
              <td><?= $smartphone['rom'] ?> GB</td>
              <td><?= $smartphone['battrey'] ?> mAh</td>
              <td><?= $smartphone['c_ram'] ?></td>
              <td><?= $smartphone['c_rom'] ?></td>
              <td><?= $smartphone['c_battrey'] ?></td>
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