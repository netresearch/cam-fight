<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 05.12.17
 * Time: 10:35
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

echo '{"records":[{"id":"1","title":"foobar","description":"loremipsum","bgcolor":"0F0F0F"},{"id":"2","title":"TestTest","description":"blabla","bgcolor":"F0F0F0"},{"id":"3","title":"dritter Test","description":"Test","bgcolor":"ABCDEF"}]}';