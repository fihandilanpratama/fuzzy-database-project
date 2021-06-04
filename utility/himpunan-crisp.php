<?php

// fungsi untuk mencari himpunan crisp dari derajat keanggotaan

function c_rating($jelek, $cukup_bagus, $bagus, $sangat_bagus)
{
  $result = max([$jelek, $cukup_bagus, $bagus, $sangat_bagus]);
  if ($result == $jelek) return 'jelek';
  elseif ($result == $cukup_bagus) return 'cukup bagus';
  elseif ($result == $bagus) return 'bagus';
  elseif ($result == $sangat_bagus) return 'sangat bagus';
}

function c_rilis($baru, $cukup_lama, $lama)
{
  $result = max([$baru, $cukup_lama, $lama]);
  if ($result == $baru) return 'baru';
  elseif ($result == $cukup_lama) return 'cukup lama';
  elseif ($result == $lama) return 'lama';
}

function c_duration($pendek, $normal, $panjang)
{
  $result = max([$pendek, $normal, $panjang]);
  if ($result == $pendek) return 'pendek';
  elseif ($result == $normal) return 'normal';
  elseif ($result == $panjang) return 'panjang';
}
