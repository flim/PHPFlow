<?php

require __DIR__ . '/../vendor/autoload.php';

$results = \Fliiim\PHPFlow\PHPFlow::getUser("user_api_token", "user_id");
if (false !== $results) {
    print_r(json_decode($results));
}