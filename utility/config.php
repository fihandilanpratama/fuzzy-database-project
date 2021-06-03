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

include 'derajat-keanggotaan.php';

function get_derajat_keanggotaan($smartphones)
{
  $container = [];

  foreach ($smartphones as $smartphone) {
    $id = $smartphone["id_smartphone"];
    $name = $smartphone['name'];
    $screen_size = $smartphone['screen_size'];
    $os = $smartphone['os'];
    $ram = $smartphone['ram'];
    $rom = $smartphone['rom'];
    $battrey = $smartphone['battrey_capacity'];

    // get nilai keanggotaan fuzzy untuk variabel RAM
    $ram_kecil = ram_kecil($ram);
    $ram_sedang = ram_sedang($ram);
    $ram_besar = ram_besar($ram);

    // get nilai keanggotaan fuzzy untuk variabel ROM
    $rom_kecil = rom_kecil($rom);
    $rom_sedang = rom_sedang($rom);
    $rom_besar = rom_besar($rom);

    // get nilai keanggotaan fuzzy untuk variabel Battrey
    $battrey_kecil = battrey_kecil($battrey);
    $battrey_sedang = battrey_sedang($battrey);
    $battrey_besar = battrey_besar($battrey);

    $data = [
      'id' => $id,
      'name' => $name,
      'screen_size' => $screen_size,
      'os' => $os,
      'ram' => $ram,
      'rom' => $rom,
      'battrey' => $battrey,
      'ram_kecil' => $ram_kecil,
      'ram_sedang' => $ram_sedang,
      'ram_besar' => $ram_besar,
      'rom_kecil' => $rom_kecil,
      'rom_sedang' => $rom_sedang,
      'rom_besar' => $rom_besar,
      'battrey_kecil' => $battrey_kecil,
      'battrey_sedang' => $battrey_sedang,
      'battrey_besar' => $battrey_besar
    ];
    $container[] = $data;
  }
  return $container;
}

function get_data_crisp($smartphones)
{
  $container = [];

  foreach ($smartphones as $smartphone) {
    $id = $smartphone['id'];
    $name = $smartphone['name'];
    $screen_size = $smartphone['screen_size'];
    $os = $smartphone['os'];
    $ram = $smartphone['ram'];
    $rom = $smartphone['rom'];
    $battrey = $smartphone['battrey'];

    // get nilai crisp untuk variabel RAM, ROM, dan battrey
    $c_ram = crisp($smartphone['ram_kecil'], $smartphone['ram_sedang'], $smartphone['ram_besar']);
    $c_rom = crisp($smartphone['rom_kecil'], $smartphone['rom_sedang'], $smartphone['rom_besar']);
    $c_battrey = crisp($smartphone['battrey_kecil'], $smartphone['battrey_sedang'], $smartphone['battrey_besar']);

    $data = [
      'id' => $id,
      'name' => $name,
      'screen_size' => $screen_size,
      'os' => $os,
      'ram' => $ram,
      'rom' => $rom,
      'battrey' => $battrey,
      'c_ram' => $c_ram,
      'c_rom' => $c_rom,
      'c_battrey' => $c_battrey
    ];
    $container[] = $data;
  }
  return $container;
}

function filter_data_crisp($data, $params_query)
{
  $ram = $params_query[0];
  $rom = $params_query[1];
  $battrey = $params_query[2];

  // var_dump($data);
  // die;

  $filtered = array_filter($data, function ($var) use ($ram, $rom, $battrey) {
    if ($ram && $rom && $battrey) {
      // echo "$ram <br>";
      // echo $var['ram'] . "<br>";
      return ($var['c_ram'] == $ram && $var['c_rom'] == $rom && $var['c_battrey'] == $battrey);
    } elseif ($ram && $rom) {
      return ($var['c_ram'] == $ram && $var['c_rom'] == $rom);
    } elseif ($ram && $battrey) {
      return ($var['c_ram'] == $ram && $var['c_battrey'] == $battrey);
    } elseif ($rom && $battrey) {
      return ($var['c_rom'] == $rom && $var['c_battrey'] == $battrey);
    } elseif ($ram) {
      return ($var['c_ram'] == $ram);
    } elseif ($rom) {
      return ($var['c_rom'] == $rom);
    } elseif ($battrey) {
      return ($var['c_battrey'] == $battrey);
    }
  });

  return $filtered;
}
