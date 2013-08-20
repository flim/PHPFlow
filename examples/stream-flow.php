<?php

require __DIR__ . '/../vendor/autoload.php';

\Fliiim\PHPFlow\PHPFlow::streamFlow("user_api_token", "company", "flow", 'callback');

// Must return strlen($data)
function callback($ch, $data)
{
    print_r($data);
    return strlen($data);
}
