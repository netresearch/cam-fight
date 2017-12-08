<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 05.12.17
 * Time: 10:35
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

echo '{"records":[{"id":"1","team":"2","votes":"5","path":"\/foo\/bar.img"},{"id":"2","team":"8","votes":"8","path":"\/test\/test.img"},{"id":"3","team":"1","votes":"0","path":"\/bar\/foo.img"}]}';