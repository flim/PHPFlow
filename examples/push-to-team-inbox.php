<?php

require __DIR__ . '/../vendor/autoload.php';

\Fliiim\PHPFlow\PHPFlow::pushToTeamInbox("flow_token", "the_source", "email@domain.com", "the_subject", "the_content", array("tags" => "#important, hardwork, @everyone"));
