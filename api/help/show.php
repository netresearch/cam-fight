<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 30.11.17
 * Time: 16:32
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/help.php';

$help = new Help();

echo json_encode($help->show());