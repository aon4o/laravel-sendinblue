<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
use SendinBlue\Client\Api\ConversationsApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\Body10;
use SendinBlue\Client\Model\Body11;
use SendinBlue\Client\Model\Body12;
use SendinBlue\Client\Model\Body8;
use SendinBlue\Client\Model\Body9;
use SendinBlue\Client\Model\ConversationsMessage;

/**
 * SendInBlue ConversationsAPI wrapper.
 */
class Conversations extends BaseAPI
{
    protected ConversationsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new ConversationsApi($this->getClient(), $this->config);
    }

    /**
     * Sets agent’s status to online for 2-3 minutes
     * We recommend pinging this endpoint every minute for as long as the agent has to be considered online.
     *
     * @param string|null $agent_id
     * @param string|null $received_from
     * @param string|null $agent_email
     * @param string|null $agent_name
     *
     * @return ErrorResponse|null
     */
    public function agentOnlinePingPost(
        string|null $agent_id = null,
        string|null $received_from = null,
        string|null $agent_email = null,
        string|null $agent_name = null,
    ): ErrorResponse|null
    {
        $request_data = new Body12([
            'agentId' => $agent_id,
            'receivedFrom' => $received_from,
            'agentEmail' => $agent_email,
            'agentName' => $agent_name,
        ]);

        try {
            $this->api->conversationsAgentOnlinePingPost($request_data);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a message sent by an agent
     * Only agents’ messages can be deleted.
     *
     * @param string $id
     *
     * @return ErrorResponse|null
     */
    public function messagesDelete(string $id): ErrorResponse|null
    {
        try {
            $this->api->conversationsMessagesIdDelete($id);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a message
     *
     * @param string $id
     *
     * @return ErrorResponse|ConversationsMessage
     */
    public function messagesGet(string $id): ErrorResponse|ConversationsMessage
    {
        try {
            return $this->api->conversationsMessagesIdGet($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a message sent by an agent
     * Only agents’ messages can be edited.
     *
     * @param string $id
     * @param string $text
     *
     * @return ErrorResponse|ConversationsMessage
     */
    public function messagesUpdate(string $id, string $text): ErrorResponse|ConversationsMessage
    {
        $request_data = new Body9(compact('text'));

        try {
            return $this->api->conversationsMessagesIdPut($id, $request_data);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Send a message as an agent
     *
     * @param string $visitor_id
     * @param string $text
     * @param string|null $agent_id
     * @param string|null $received_from
     * @param string|null $agent_email
     * @param string|null $agent_name
     *
     * @return ErrorResponse|ConversationsMessage
     */
    public function messagesCreate(
        string      $visitor_id,
        string      $text,
        string|null $agent_id = null,
        string|null $received_from = null,
        string|null $agent_email = null,
        string|null $agent_name = null,
    ): ErrorResponse|ConversationsMessage
    {
        $request_data = new Body8([
            'visitorId' => $visitor_id,
            'text' => $text,
            'agentId' => $agent_id,
            'receivedFrom' => $received_from,
            'agentEmail' => $agent_email,
            'agentName' => $agent_name,
        ]);

        try {
            return $this->api->conversationsMessagesPost($request_data);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete an automated message
     *
     * @param string $id
     *
     * @return ErrorResponse|null
     */
    public function pushedMessagesDelete(string $id): ErrorResponse|null
    {
        try {
            $this->api->conversationsPushedMessagesIdDelete($id);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get an automated message
     *
     * @param string $id
     *
     * @return ErrorResponse|ConversationsMessage
     */
    public function pushedMessagesGet(string $id): ErrorResponse|ConversationsMessage
    {
        try {
            return $this->api->conversationsPushedMessagesIdGet($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update an automated message
     *
     * @param string $id
     * @param string $text
     *
     * @return ErrorResponse|ConversationsMessage
     */
    public function pushedMessagesUpdate(string $id, string $text): ErrorResponse|ConversationsMessage
    {
        $request_data = new Body11(compact('text'));

        try {
            return $this->api->conversationsPushedMessagesIdPut($id, $request_data);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Send an automated message to a visitor
     * Example of automated messages: order status, announce new features in your web app, etc.
     *
     * @param string $visitor_id
     * @param string $text
     * @param string|null $agent_id
     * @param string|null $group_id
     *
     * @return ErrorResponse|ConversationsMessage
     */
    public function pushedMessagesCreate(
        string      $visitor_id,
        string      $text,
        string|null $agent_id = null,
        string|null $group_id = null,
    ): ErrorResponse|ConversationsMessage
    {
        $request_data = new Body10([
            'visitorId' => $visitor_id,
            'text' => $text,
            'agentId' => $agent_id,
            'groupId' => $group_id,
        ]);

        try {
            return $this->api->conversationsPushedMessagesPost($request_data);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }
}
