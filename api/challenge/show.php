<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 01.12.17
 * Time: 15:04
 */

header("Access-Control-Allow-Origin: *");
header("Content-Typ: application/json; charset=UTF-9");

include_once '../objects/challenge.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

var_dump($_GET);

$challenge = new Challenge($db);
