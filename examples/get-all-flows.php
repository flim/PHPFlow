<?php

require __DIR__ . '/../vendor/autoload.php';

$results = \Fliiim\PHPFlow\PHPFlow::getAllFlows("user_api_token");
if (false !== $results) {
    print_r(json_decode($results));
}