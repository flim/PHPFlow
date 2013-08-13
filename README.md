# PHPFlow
PHP Library for Flowdock API use

# Installation
You just have to include 'PHPFlow.class.php' in your project

# Usage
## Push message
### Write message to CHAT
```PHP
PHPFlow::pushToChat("flow_token", "message", "external_user_name");
```
### Write message to TEAM INBOX
```PHP
PHPFlow::pushToTeamInbox("flow_token", "the_source", "the_email", "the_subject", "the_content");
```
## Streaming
### Stream message from a flow
```PHP
// Callback function have to return strlen($data);
function callback($ch, $data)
{
    echo "$data";
    return strlen($data);
}

PHPFlow::streamFlow("user_token", "company_name", "flow_name", 'callback');
```
### Stream message from flows
```PHP
// Callback function have to return strlen($data);
function callback($ch, $data)
{
    echo "$data";
    return strlen($data);
}

PHPFlow::streamFlows("user_token", array("company_name/flow_name", "company_name/another_flow_name"), 'callback');
```
## Users
### Get all users
```PHP
$users = PHPFlow::getUsers("user_token");
```
### Get flow users
```PHP
$users = PHPFlow::getFlowUsers("user_token", "company_name", "flow_name");
```
### Get a user
```PHP
$user = PHPFlow::getUser("user_token", "user_id");
```
# Flows
### Get all flows
```PHP
$flows = PHPFlow::getAllFlows("user_token");
```