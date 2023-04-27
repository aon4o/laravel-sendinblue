<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\TransactionalWhatsAppApi;

/**
 * SendInBlue TransactionalWhatsAppAPI wrapper.
 */
class TransactionalWhatsApp extends BaseAPI
{
    protected TransactionalWhatsAppApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new TransactionalWhatsAppApi($this->getClient(), $this->config);
    }
}
