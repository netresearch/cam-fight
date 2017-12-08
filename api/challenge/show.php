<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 01.12.17
 * Time: 15:04
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/challenge.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


$challenge = new Challenge($db);

$challenge->setId(htmlspecialchars($_GET['id']));

$challenge->show();

$arChallenge = array(
    'id' => (int) $challenge->nId,
    'title' => $challenge->strTitle,
    'description' => $challenge->strDescription,
    'bgColor' => $challenge->strBgColor
);
if (is_null($challenge->nId)) {
    http_response_code(204);
    echo '{"message": "No Challenge ID given."}';
} else {
    print_r(json_encode($arChallenge));
}
