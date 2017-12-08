<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 04.12.17
 * Time: 08:29
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/image.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


$image = new Image($db);

$nChallengeId = htmlspecialchars($_GET['challengeId']);
$strTeamId = htmlspecialchars($_GET['teamId']);
$excludeTeamId = htmlspecialchars($_GET['excludeTeamId']);

$stmt = $image->list($excludeTeamId, $strTeamId, $nChallengeId);
$num = $stmt->rowCount();


if ($num > 0) {
    $arImages = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $image->setId($id);
        $imageItem = [
            'id' => (int) $id,
            'team' => $team,
            'votes' => (int) $image->getUpvotes(),
            'path' => $path,
            'challenge' => (int) $challenge
        ];
        array_push($arImages, $imageItem);
    }


    echo json_encode($arImages);
} else {
    http_response_code(204);
    echo json_encode(
        array('message' => 'No image available.')
    );
}