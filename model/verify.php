<?php

namespace App\verif;

function verifyUsername($str)
{
  return (preg_match("/[\w]{2,35}/", $str));
}

function verifyPassword($str) {
  return (preg_match("/[\w]{6,35}/", $str));
}
