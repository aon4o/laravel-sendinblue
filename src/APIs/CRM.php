<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\CRMApi;

/**
 * SendInBlue CRM API wrapper.
 */
class CRM extends BaseAPI
{
    protected CRMApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new CRMApi($this->getClient(), $this->config);
    }
}
