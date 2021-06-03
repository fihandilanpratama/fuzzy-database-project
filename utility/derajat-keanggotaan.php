<?php

// fungsi keanggotaan untuk variabel RAM
function ram_kecil($x)
{
  if ($x <= 2) $derajat_keanggotaan = 1;
  elseif ($x >= 2 && $x <= 4) $derajat_keanggotaan = (4 - $x) / (4 - 2);
  elseif ($x >= 4) $derajat_keanggotaan = 0;
  return round($derajat_keanggotaan, 3);
}

function ram_sedang($x)
{
  if ($x <= 3 || $x >= 6) $derajat_keanggotaan = 0;
  elseif ($x >= 3 && $x <= 4) $derajat_keanggotaan = ($x - 3) / (4 - 3);
  elseif ($x >= 4 && $x <= 6) $derajat_keanggotaan = (6 - $x) / (6 - 4);
  return round($derajat_keanggotaan, 3);
}

function ram_besar($x)
{
  if ($x <= 4) $derajat_keanggotaan = 0;
  elseif ($x >= 4 && $x <= 8) $derajat_keanggotaan = ($x - 4) / (8 - 4);
  elseif ($x >= 8) $derajat_keanggotaan = 1;
  return round($derajat_keanggotaan, 3);
}

// fungsi keanggotaan untuk variabel ROM
function rom_kecil($x)
{
  if ($x <= 16) $derajat_keanggotaan = 1;
  elseif ($x >= 16 && $x <= 32) $derajat_keanggotaan = (32 - $x) / (32 - 16);
  elseif ($x >= 32) $derajat_keanggotaan = 0;
  return round($derajat_keanggotaan, 3);
}

function rom_sedang($x)
{
  if ($x <= 16 || $x >= 128) $derajat_keanggotaan = 0;
  elseif ($x >= 16 && $x <= 64) $derajat_keanggotaan = ($x - 16) / (64 - 16);
  elseif ($x >= 64 && $x <= 128) $derajat_keanggotaan = (128 - $x) / (128 - 64);
  return round($derajat_keanggotaan, 3);
}

function rom_besar($x)
{
  if ($x <= 64) $derajat_keanggotaan = 0;
  elseif ($x >= 64 && $x <= 128) $derajat_keanggotaan = ($x - 64) / (128 - 64);
  elseif ($x >= 128) $derajat_keanggotaan = 1;
  return round($derajat_keanggotaan, 3);
}

// fungsi keanggotaan untuk variabel Battrey
function battrey_kecil($x)
{
  if ($x <= 3000) $derajat_keanggotaan = 1;
  elseif ($x >= 3000 && $x <= 4000) $derajat_keanggotaan = (4000 - $x) / (4000 - 3000);
  elseif ($x >= 32) $derajat_keanggotaan = 0;
  return round($derajat_keanggotaan, 3);
}

function battrey_sedang($x)
{
  if ($x <= 3500 || $x >= 6000) $derajat_keanggotaan = 0;
  elseif ($x >= 3500 && $x <= 5000) $derajat_keanggotaan = ($x - 3500) / (5000 - 3500);
  elseif ($x >= 5000 && $x <= 6000) $derajat_keanggotaan = (6000 - $x) / (6000 - 5000);
  return round($derajat_keanggotaan, 3);
}

function battrey_besar($x)
{
  if ($x <= 5000) $derajat_keanggotaan = 0;
  elseif ($x >= 5000 && $x <= 6000) $derajat_keanggotaan = ($x - 5000) / (6000 - 5000);
  elseif ($x >= 6000) $derajat_keanggotaan = 1;
  return round($derajat_keanggotaan, 3);
}


// fungsi untuk mencari himpunan crisp dari derajat keanggotaan
function crisp($kecil, $sedang, $besar)
{
  $result = max([$kecil, $sedang, $besar]);
  if ($result == $kecil) return 'kecil';
  elseif ($result == $sedang) return 'sedang';
  elseif ($result == $besar) return 'besar';
}
