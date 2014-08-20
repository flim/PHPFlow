<?php

namespace Flim\PHPFlow;

use Flim\PHPFlow\PHPFlowBase;
use Flim\PHPFlow\PHPFlowEndpoint;

class PHPFlow extends PHPFlowBase
{
    /**
     * Post message to chat from an "external user"
     *
     * @param string $flowToken
     * @param string $content
     * @param string $externalUserName
     * @param array $tags
     * @return bool True on success, False on failure
     */
    public static function pushToChat($flowToken, $content, $externalUserName, $tags = array())
    {
        $data = array('content' => $content, 'external_user_name' => $externalUserName, 'tags' => $tags);
        return PHPFlow::postRequest(sprintf(PHPFlowEndPoint::CHAT, $flowToken), $data);
    }

    /**
     * Send mail-like messages to the Team inbox of a flow
     *
     * @param string $flowToken
     * @param string $source
     * @param string $fromAddress
     * @param string $subject
     * @param string $content
     * @param array $options
     * @return bool True on success, False on failure
     */
    public static function pushToTeamInbox($flowToken, $source, $fromAddress, $subject, $content, $options = array())
    {
        $data = array('source' => $source, 'from_address' => $fromAddress, 'subject' => $subject, 'content' => $content);
        $data = array_merge($data, $options);
        return PHPFlow::postRequest(sprintf(PHPFlowEndPoint::TEAM_INBOX, $flowToken), $data);
    }

    /**
     * Stream all messages from a single flow.
     *
     * @param string $userToken
     * @param string $organisation
     * @param string $flow
     * @param function $callback
     */
    public static function streamFlow($userAPIToken, $organisation, $flow, $callback)
    {
        $ch = curl_init() or die("Error: Curl can't initialize." . PHP_EOL);
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::STREAM_FLOW, $organisation, $flow));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Connection: Keep-Alive"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, $callback);
        curl_setopt($ch, CURLOPT_USERPWD, $userAPIToken . ':');
        curl_exec($ch);
        if (curl_errno($ch)) {
            echo "[ERROR] Curl: " . curl_errno($ch);
        } else {
            curl_close($ch);
        }
    }

    /**
     * Stream all messages from flows specified in filter query parameter.
     *
     * @param string $userToken
     * @param array $filter
     * @param function $callback
     * @param string $active
     * @param string $accept
     */
    public static function streamFlows($userAPIToken, $filter = array(), $callback, $active = "", $accept = "")
    {
        $ch = curl_init() or die("Error: Curl can't initialize." . PHP_EOL);
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::STREAM_FLOWS, implode(',', $filter), $accept, $active));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Connection: Keep-Alive"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, $callback);
        curl_setopt($ch, CURLOPT_USERPWD, $userAPIToken . ':');
        curl_exec($ch);
        if (curl_errno($ch)) {
            echo "[ERROR] Curl: " . curl_errno($ch);
        } else {
            curl_close($ch);
        }
    }

    /**
     * List all users visible to the authenticated user
     *
     * @param string $userToken
     * @return mixed the JSON string on success or False if failed
     */
    public static function getUsers($userAPIToken)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PHPFlowEndPoint::USERS);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userAPIToken . ':');
        return curl_exec($ch);
    }

    /**
     * List users of a flow.
     * Authenticated user must belong to the organization.
     *
     * @param string $userToken
     * @param string $organisation
     * @param string $flow
     * @return mixed the JSON string if success or False if failed
     */
    public static function getFlowUsers($userAPIToken, $organisation, $flow)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::FLOW_USERS, $organisation, $flow));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userAPIToken . ':');
        return curl_exec($ch);
    }

    /**
     * Get information of a single user.
     * Authenticated user must belong to same organization as the target user.
     * @param string $userToken
     * @param string $userId
     * @return mixed the JSON string if success or False if failed
     */
    public static function getUser($userAPIToken, $userId)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::USER, $userId));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userAPIToken . ':');
        return curl_exec($ch);
    }

    /**
     * Get all flows accessible by the user
     * @param string $userToken
     * @param int $users 1 to load user into result, 0 not
     * @return mixed return the JSON string if success or False if failed
     */
    public static function  getAllFlows($userAPIToken, $users = 0)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(PHPFlowEndPoint::FLOWS_ALL, $users));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $userAPIToken . ':');
        return curl_exec($ch);
    }
}
