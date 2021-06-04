<?php

function db()
{
  return mysqli_connect('localhost', 'root', '', 'fuzzy_database');
}

function query($query)
{
  $result = mysqli_query(db(), $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function get_derajat_keanggotaan($films)
{
  include 'derajat-keanggotaan.php';
  $container = [];

  foreach ($films as $film) {
    $id = $film['id_film'];
    $name = $film['name'];
    $writer = $film['writer'];
    $genre = $film['genre'];
    $rating = $film['rating'];
    $rilis = $film['rilis'];
    $duration = $film['duration'];

    // get derajat keanggotaan fuzzy untuk variabel Rating
    $r_jelek = r_jelek($rating);
    $r_cukup_bagus = r_cukup_bagus($rating);
    $r_bagus = r_bagus($rating);
    $r_sangat_bagus = r_sangat_bagus($rating);


    // get derajat keanggotaan fuzzy untuk variabel Rilis
    $rl_baru = rl_baru($film['telah rilis']);
    $rl_cukup_lama = rl_cukup_lama($film['telah rilis']);
    $rl_lama = rl_lama($film['telah rilis']);

    // get derajat keanggotaan fuzzy untuk variabel Battrey
    $d_pendek = d_pendek($duration);
    $d_normal = d_normal($duration);
    $d_panjang = d_panjang($duration);

    $data = [
      'id' => $id,
      'name' => $name,
      'writer' => $writer,
      'genre' => $genre,
      'rating' => $rating,
      'rilis' => $rilis,
      'duration' => $duration,
      'r_jelek' => $r_jelek,
      'r_cukup_bagus' => $r_cukup_bagus,
      'r_bagus' => $r_bagus,
      'r_sangat_bagus' => $r_sangat_bagus,
      'rl_baru' => $rl_baru,
      'rl_cukup_lama' => $rl_cukup_lama,
      'rl_lama' => $rl_lama,
      'd_pendek' => $d_pendek,
      'd_normal' => $d_normal,
      'd_panjang' => $d_panjang
    ];
    $container[] = $data;
  }
  return $container;
}

function get_data_crisp($films)
{
  include 'himpunan-crisp.php';
  $container = [];

  foreach ($films as $film) {
    $id = $film['id'];
    $name = $film['name'];
    $writer = $film['writer'];
    $genre = $film['genre'];
    $rating = $film['rating'];
    $rilis = $film['rilis'];
    $duration = $film['duration'];

    // get nilai crisp untuk variabel Rating, Rilis, dan Durasi
    $c_rating = c_rating($film['r_jelek'], $film['r_cukup_bagus'], $film['r_bagus'], $film['r_sangat_bagus']);
    $c_rilis = c_rilis($film['rl_baru'], $film['rl_cukup_lama'], $film['rl_lama']);
    $c_duration = c_duration($film['d_pendek'], $film['d_normal'], $film['d_panjang']);

    $data = [
      'id' => $id,
      'name' => $name,
      'writer' => $writer,
      'genre' => $genre,
      'rating' => $rating,
      'rilis' => $rilis,
      'duration' => $duration,
      'c_rating' => $c_rating,
      'c_rilis' => $c_rilis,
      'c_duration' => $c_duration
    ];
    $container[] = $data;
  }
  return $container;
}

function filter_data_crisp($data, $params_query)
{
  $rating = $params_query[0];
  $rilis = $params_query[1];
  $duration = $params_query[2];

  // var_dump($data);
  // die;

  $filtered = array_filter($data, function ($var) use ($rating, $rilis, $duration) {
    if ($rating && $rilis && $duration) {
      // echo "$rating <br>";
      // echo $var['rating'] . "<br>";
      return ($var['c_rating'] == $rating && $var['c_rilis'] == $rilis && $var['c_duration'] == $duration);
    } elseif ($rating && $rilis) {
      return ($var['c_rating'] == $rating && $var['c_rilis'] == $rilis);
    } elseif ($rating && $duration) {
      return ($var['c_rating'] == $rating && $var['c_duration'] == $duration);
    } elseif ($rilis && $duration) {
      return ($var['c_rilis'] == $rilis && $var['c_duration'] == $duration);
    } elseif ($rating) {
      return ($var['c_rating'] == $rating);
    } elseif ($rilis) {
      return ($var['c_rilis'] == $rilis);
    } elseif ($duration) {
      return ($var['c_duration'] == $duration);
    }
  });

  return $filtered;
}
