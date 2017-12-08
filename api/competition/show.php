<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 05.12.17
 * Time: 13:28
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/competition.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


$competition = new Competition($db);

$competition->setId(htmlspecialchars($_GET['id']));

$competition->show();

$arCompetition = array(
    'id' => (int) $competition->nId,
    'startChallenges' => (int) $competition->nStartChallenges,
    'stopChallenges' => (int) $competition->nStopChallenges,
    'startVotes' => (int) $competition->nStartVotes,
    'stopVotes' => (int) $competition->nStopVotes,
);
if (is_null($competition->nId)) {
    http_response_code(204);
    echo '{"message": "No competition ID given."}';
} else {
    print_r(json_encode($arCompetition));
}
