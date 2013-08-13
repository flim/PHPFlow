<?php

abstract class PHPFlowBase
{

    public abstract static function pushToTeamInbox($flowApiToken, $source, $fromAddress, $subject, $content, $options = array());

    public abstract static function pushToChat($flowApiToken, $content, $externalUserName, $tags = null);

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