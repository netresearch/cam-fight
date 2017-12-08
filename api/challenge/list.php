<?php
/**
 * Created by PhpStorm.
 * User: Thomas Schöne
 * Date: 04.12.17
 * Time: 08:29
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/challenge.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


$challenge = new Challenge($db);

$stmt = $challenge->list();
$num = $stmt->rowCount();

if ($num > 0) {
    $arChallenges = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $challengeItem = array(
            'id' => (int) $id,
            'title' => $title,
            'description' => $description,
            'bgcolor' => $bgColor
        );
        array_push($arChallenges, $challengeItem);
    }
    echo json_encode($arChallenges);
} else {
    http_response_code(204);
    echo json_encode(
        array('message' => 'No challenge available')
    );
}