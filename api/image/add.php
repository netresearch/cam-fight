<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 05.12.17
 * Time: 16:54
 */


header("Access-Control-Allow-Origin: *");
header("Content-Type: image/png");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 18000");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';

include_once '../objects/image.php';

$database = new Database();

$db = $database->getConnection();

$image = new Image($db);


$strTeamId = htmlspecialchars($_POST['teamId']);
$challengeId = htmlspecialchars($_POST['challengeId']);

error_log(serialize($_FILES));

$arFile = array(
    'name' => $challengeId . '/' . time() . '_' . htmlspecialchars($_FILES['image']['name']),
    'type' => htmlspecialchars($_FILES['image']['type']),
    'tmpName' => htmlspecialchars($_FILES['image']['tmp_name']),
    'size' => htmlspecialchars($_FILES['image']['size'])
);

$image->nTeam = $strTeamId;
$image->nChallenge = $challengeId;
$image->strName = $arFile['name'];
$image->strTmpPath = $arFile['tmpName'];
$image->add();

