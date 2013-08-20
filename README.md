# PHPFlow
PHP Library for Flowdock API use
# Installation
Install composer in the project
```BASH
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```
Then insert composer autoload requirement line in your project
```PHP
require_once __DIR__ . '/vendor/autoload.php';
```
# Usage
## Push message
### Write message to CHAT
```PHP
PHPFlow::pushToChat("flow_token", "Hello world!", "PHPFlow");
```
### Write message to TEAM INBOX
```PHP
PHPFlow::pushToTeamInbox("flow_token", "the_source", "email", "the_subject", "the_content", array("tags" => "#important, hardwork, @everyone"));
```
## Users
### Get all users
```PHP
$results = PHPFlow::getUsers("user_api_token");
if (false !== $results) {
    print_r(json_decode($results));
}
```
### Get flow users
```PHP
$results = PHPFlow::getFlowUsers("user_api_token", "company", "flow");
if (false !== $results) {
    print_r(json_decode($results));
}
```
### Get a user
```PHP
$results = PHPFlow::getUser("user_api_token", "user_id");
if (false !== $results) {
    print_r(json_decode($results));
}
```
# Flows
### Get all flows
```PHP
$results = PHPFlow::getAllFlows("user_api_token");
if (false !== $results) {
    print_r(json_decode($results));
}
```
## Streaming
### Stream message from a flow
```PHP
PHPFlow::streamFlow("user_api_token", "company", "flow", 'callback');

// Must return strlen($data)
function callback($ch, $data)
{
    print_r($data);
    return strlen($data);
}
```
### Stream message from flows
```PHP
PHPFlow::streamFlows("user_api_token", array("company/flow", "company/flow2"), 'callback');

// Must return strlen($data)
function callback($ch, $data)
{
    print_r($data);
    return strlen($data);
}
```