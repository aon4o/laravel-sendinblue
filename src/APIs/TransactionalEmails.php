<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\TransactionalEmailsApi;

/**
 * SendInBlue TransactionalEmailsAPI wrapper.
 */
class TransactionalEmails extends BaseAPI
{
    protected TransactionalEmailsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new TransactionalEmailsApi($this->getClient(), $this->config);
    }
}
