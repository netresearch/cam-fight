<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 05.12.17
 * Time: 16:54
 */


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers");


include_once '../config/database.php';

include_once '../objects/image.php';

$database = new Database();

$db = $database->getConnection();

$image = new Image($db);


$nUserId = htmlspecialchars($_REQUEST['userId']);
$challengeId = htmlspecialchars($_REQUEST['challengeId']);
$imageId = htmlspecialchars($_REQUEST['imageId']);

error_log(serialize($_REQUEST));
$image->nId = $imageId;
$image->nChallenge = $challengeId;
$image->upvote($nUserId);
