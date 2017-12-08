<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 08.12.17
 * Time: 14:34
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/image.php';

$database = new Database();
$db = $database->getConnection();

$strQuery = 'SELECT * FROM  Images WHERE 1';

// prepare query statement
$stmt = $db->prepare($strQuery);

// execute query
$stmt->execute();

$num = $stmt->rowCount();

$image = new Image($db);

if ($num > 0) {
    $arImages = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $image->setId($id);
        $image->show();
        if (isset($arImages[$team])) {
            $arImages[$team] = $arImages[$team] + $image->getUpvotes();
        } else {
            $arImages[$team] = $image->getUpvotes();
        }
    }

    arsort($arImages);
    var_dump($arImages);
}
