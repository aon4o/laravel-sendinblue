<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\InboundParsingApi;

/**
 * SendInBlue InboundParsingAPI wrapper.
 */
class InboundParsing extends BaseAPI
{
    protected InboundParsingApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new InboundParsingApi($this->getClient(), $this->config);
    }
}
