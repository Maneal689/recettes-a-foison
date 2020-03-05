<?php

header("content-type:application/json");

include_once("model/alimFunctions.php");

$res = ["ok" => true, "err" => ""];

if (!array_key_exists("q", $_GET)) {
  $res["ok"] = false;
  $res["err"] = "No query";
} else {
  $res["res"] = findAlim($_GET["q"]);
}

echo json_encode($res);
