<?php

require __DIR__ . '/../vendor/autoload.php';

\Flim\PHPFlow\PHPFlow::streamFlows("user_api_token", array("company/flow1", "company/flow2"), 'callback');

// Must return strlen($data)
function callback($ch, $data)
{
    print_r($data);
    return strlen($data);
}
