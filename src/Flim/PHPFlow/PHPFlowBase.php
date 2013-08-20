<?php

namespace Fliiim\PHPFlow;

abstract class PHPFlowBase
{
    public abstract static function pushToChat($flowToken, $content, $externalUserName, $tags = array());

    public abstract static function pushToTeamInbox($flowToken, $source, $fromAddress, $subject, $content, $options = array());

    public abstract static function streamFlow($userAPIToken, $organisation, $flow, $callback);

    public abstract static function streamFlows($userAPIToken, $filter = array(), $callback, $active = "", $accept = "");

    public abstract static function getUsers($userAPIToken);

    public abstract static function getFlowUsers($userAPIToken, $organisation, $flow);

    public abstract static function getUser($userAPIToken, $userId);

    public abstract static function getAllFlows($userAPIToken, $users = 0);

    protected static function postRequest($uri, $data)
    {
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            )
        );
        $context = stream_context_create($options);
        $results = file_get_contents($uri, false, $context);
        return ($results === false);
    }
}