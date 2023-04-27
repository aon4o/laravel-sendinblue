<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\WebhooksApi;

/**
 * SendInBlue WebhooksAPI wrapper.
 */
class Webhooks extends BaseAPI
{
    protected WebhooksApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new WebhooksApi($this->getClient(), $this->config);
    }
}
