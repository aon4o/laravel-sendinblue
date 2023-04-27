<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\ConversationsApi;

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
}
