<?php

header('content-type:application/json');

require_once("model/alimFunctions.php");

$output = ["res" => false];
if (isset($_GET["alimName"])) $output["res"] = alimExists($_GET["alimName"]);

echo json_encode($output);