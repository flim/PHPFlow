<?php

require __DIR__ . '/../vendor/autoload.php';

$results = \Flim\PHPFlow\PHPFlow::getFlowUsers('user_api_token', 'company_name', 'flow_name');
if (false !== $results) {
    print_r(json_decode($results));
}