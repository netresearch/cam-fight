<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 01.12.17
 * Time: 15:04
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/image.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


$image = new Image($db);

$image->setId(htmlspecialchars($_GET['id']));

$image->show();

$arImage = array(
    'id' => (int) $image->nId,
    'team' => (int) $image->nTeam,
    'votes' => (int) $image->getUpvotes(),
    'path' => $image->strPath,
    'challenge' => (int) $image->nChallenge
);
if (is_null($image->nId)) {
    http_response_code(204);
    echo '{"message": "No image ID given."}';
} else {
    print_r(json_encode($arImage));
}
