<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 30.11.17
 * Time: 16:32
 */

header("Access-Control-Allow-Origin: *");
header("Content-Typ: application/json; charset=UTF-9");

include_once '../objects/help.php';

$help = new Help();

echo json_encode($help->show());