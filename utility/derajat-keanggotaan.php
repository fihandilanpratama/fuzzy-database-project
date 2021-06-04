<?php

// fungsi keanggotaan untuk variabel Rating
function r_jelek($x)
{
  if ($x <= 5) $derajat_keanggotaan = 1;
  elseif ($x >= 5 && $x <= 6) $derajat_keanggotaan = (6 - $x) / (6 - 5);
  elseif ($x >= 6) $derajat_keanggotaan = 0;
  return round($derajat_keanggotaan, 2);
}

function r_cukup_bagus($x)
{
  if ($x <= 5.5 || $x >= 7) $derajat_keanggotaan = 0;
  elseif ($x >= 5.5 && $x <= 6) $derajat_keanggotaan = ($x - 5.5) / (6 - 5.5);
  elseif ($x >= 6 && $x <= 6.5) $derajat_keanggotaan = 1;
  elseif ($x >= 6.5 && $x <= 7) $derajat_keanggotaan = (7 - $x) / (7 - 6.5);
  return round($derajat_keanggotaan, 2);
}

function r_bagus($x)
{
  if ($x <= 6.5 || $x >= 8) $derajat_keanggotaan = 0;
  elseif ($x >= 6.5 && $x <= 7) $derajat_keanggotaan = ($x - 6.5) / (7 - 6.5);
  elseif ($x >= 7 && $x <= 7.5) $derajat_keanggotaan = 1;
  elseif ($x >= 6.5 && $x <= 7) $derajat_keanggotaan = (7 - $x) / (7 - 6.5);
  return round($derajat_keanggotaan, 2);
}

function r_sangat_bagus($x)
{
  if ($x >= 8) $derajat_keanggotaan = 1;
  elseif ($x >= 7.5 && $x <= 8) $derajat_keanggotaan = ($x - 7.5) / (8 - 7.5);
  elseif ($x <= 7.5) $derajat_keanggotaan = 0;
  return round($derajat_keanggotaan, 2);
}

// fungsi keanggotaan untuk variabel Rilis
function rl_baru($x)
{
  if ($x <= 1) $derajat_keanggotaan = 1;
  elseif ($x >= 1 && $x <= 5) $derajat_keanggotaan = (5 - $x) / (5 - 1);
  elseif ($x >= 5) $derajat_keanggotaan = 0;
  return round($derajat_keanggotaan, 2);
}

function rl_cukup_lama($x)
{
  if ($x <= 2 || $x >= 10) $derajat_keanggotaan = 0;
  elseif ($x >= 2 && $x <= 7) $derajat_keanggotaan = ($x - 2) / (7 - 2);
  elseif ($x >= 7 && $x <= 10) $derajat_keanggotaan = (10 - $x) / (10 - 7);
  return round($derajat_keanggotaan, 2);
}

function rl_lama($x)
{
  if ($x <= 6) $derajat_keanggotaan = 0;
  elseif ($x >= 6 && $x <= 10) $derajat_keanggotaan = ($x - 6) / (10 - 6);
  elseif ($x >= 10) $derajat_keanggotaan = 1;
  return round($derajat_keanggotaan, 2);
}

// fungsi keanggotaan untuk variabel Durasi
function d_pendek($x)
{
  if ($x <= 20) $derajat_keanggotaan = 1;
  elseif ($x >= 20 && $x <= 70) $derajat_keanggotaan = (70 - $x) / (70 - 20);
  elseif ($x >= 70) $derajat_keanggotaan = 0;
  return round($derajat_keanggotaan, 2);
}

function d_normal($x)
{
  if ($x <= 20 || $x >= 190) $derajat_keanggotaan = 0;
  elseif ($x >= 20 && $x <= 105) $derajat_keanggotaan = ($x - 20) / (105 - 20);
  elseif ($x >= 105 && $x <= 190) $derajat_keanggotaan = (190 - $x) / (190 - 105);
  return round($derajat_keanggotaan, 2);
}

function d_panjang($x)
{
  if ($x <= 105) $derajat_keanggotaan = 0;
  elseif ($x >= 105 && $x <= 190) $derajat_keanggotaan = ($x - 105) / (190 - 105);
  elseif ($x >= 190) $derajat_keanggotaan = 1;
  return round($derajat_keanggotaan, 2);
}
