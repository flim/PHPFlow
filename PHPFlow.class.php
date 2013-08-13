<?php

require_once __DIR__ . '/PHPFlowEndpoint.class.php';
require_once __DIR__ . '/PHPFlowBase.class.php';

class PHPFlow extends PHPFlowBase
{

    /**
     * Post message to chat from an "external user".
     * @param $flowApiToken
     * @param $content
     * @param $externalUserName
     * @param array $tags
     * @return bool
     */
    public static function pushToChat($flowApiToken, $content, $externalUserName, $tags = array())
    {
        $data = array('content' => $content, 'external_user_name' => $externalUserName, 'tags' => $tags);
        return PHPFlow::postRequest(sprintf(PHPFlowEndPoint::CHAT, $flowApiToken), $data);
    }

    /**
     * Send mail-like messages to the Team inbox of a flow.
     * @param $flowApiToken
     * @param $source
     * @param $fromAddress
     * @param $subject
     * @param $content
     * @param array $options
     * @return bool
     */
    public static function pushToTeamInbox($flowApiToken, $source, $fromAddress, $subject, $content, $options = array())
    {
        $data = array('source' => $source, 'from_address' => $fromAddress, 'subject' => $subject, 'content' => $content);
        $data = array_merge($data, $options);
        return PHPFlow::postRequest(sprintf(PHPFlowEndPoint::TEAM_INBOX, $flowApiToken), $data);
    }

    /**
     * Stream all messages from a single flow.
     * @param $userToken
     * @param $organisation
     * @param $flow
     * @param $callback
     */
    public static function streamFlow($userToken, $organisation, $flow, $callback)
    {
        $ch = curl_init() or die("Error: Curl can't initialize." . PHP_EOL);
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::STREAM_FLOW, $organisation, $flow));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Connection: Keep-Alive"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, $callback);
        curl_setopt($ch, CURLOPT_USERPWD, $userToken . ':');
        curl_exec($ch);
        if (curl_errno($ch)) {
            echo "[ERROR] Curl: " . curl_errno($ch);
        } else {
            curl_close($ch);
        }
    }

    /**
     * Stream all messages from flows specified in filter query parameter.
     * @param $userToken
     * @param array $filter
     * @param $callback
     * @param string $active
     * @param string $accept
     */
    public static function streamFlows($userToken, $filter = array(), $callback, $active = "", $accept = "")
    {
        $ch = curl_init() or die("Error: Curl can't initialize." . PHP_EOL);
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::STREAM_FLOWS, implode(',', $filter), $accept, $active));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Connection: Keep-Alive"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, $callback);
        curl_setopt($ch, CURLOPT_USERPWD, $userToken . ':');
        curl_exec($ch);
        if (curl_errno($ch)) {
            echo "[ERROR] Curl: " . curl_errno($ch);
        } else {
            curl_close($ch);
        }
    }

    /**
     * List all users visible to the authenticated user
     * @param $userToken
     * @return mixed
     */
    public static function getUsers($userToken)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PHPFlowEndPoint::USERS);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userToken . ':');
        return curl_exec($ch);
    }

    /**
     * List users of a flow.
     * Authenticated user must belong to the organization.
     * @param $userToken
     * @param $organisation
     * @param $flow
     * @return mixed return the JSON string if success or False if failed
     */
    public static function getFlowUsers($userToken, $organisation, $flow)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::FLOW_USERS, $organisation, $flow));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userToken . ':');
        return curl_exec($ch);
    }

    /**
     * Get information of a single user.
     * Authenticated user must belong to same organization as the target user.
     * @param $userToken
     * @param $userId
     * @return mixed return the JSON string if success or False if failed
     */
    public static function getUser($userToken, $userId)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::USER, $userId));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userToken . ':');
        return curl_exec($ch);
    }

    /**
     * Get all flows accessible by the user
     * @param $userToken
     * @param int $users
     * @return mixed return the JSON string if success or False if failed
     */
    public static function  getAllFlows($userToken, $users = 0)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::FLOWS_ALL, $users));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userToken . ':');
        return curl_exec($ch);
    }
}