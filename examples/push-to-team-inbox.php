<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * Options is an associative array.
 * List of key (options - optional):
 * - from_name
 * - reply_to
 * - project
 * - format
 * - tags
 * - link
 */
\Flim\PHPFlow\PHPFlow::pushToTeamInbox('flow_token', 'the_source', 'email@domain.com', 'the_subject', 'the_content', array('tags' => '#important,hardwork,@everyone'));
