<?php

namespace Flim\PHPFlow;

/**
 * List of Flowdock API endpoints
 *
 */
class PHPFlowEndPoint
{
	const TEAM_INBOX = 'https://api.flowdock.com/v1/messages/team_inbox/%s';
	const CHAT = 'https://api.flowdock.com/v1/messages/chat/%s';
	const USER = 'https://api.flowdock.com/users/%s';
	const USERS = 'https://api.flowdock.com/users';
	const FLOW_USERS = 'https://api.flowdock.com/flows/%s/%s/users';
	const FLOWS_ALL = 'https://api.flowdock.com/flows/all?users=%s';
	const STREAM_FLOW = 'https://stream.flowdock.com/flows/%s/%s';
	const STREAM_FLOWS = 'https://stream.flowdock.com/flows?filter=%s&accept=%s&active=%s';
}

?>