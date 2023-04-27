<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\TransactionalSMSApi;

/**
 * SendInBlue TransactionalSMS API wrapper.
 */
class TransactionalSMS extends BaseAPI
{
    protected TransactionalSMSApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new TransactionalSMSApi($this->getClient(), $this->config);
    }
}
