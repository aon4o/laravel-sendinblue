<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\ContactsApi;

/**
 * SendInBlue ContactsAPI wrapper.
 */
class Contacts extends BaseAPI
{
    protected ContactsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new ContactsApi($this->getClient(), $this->config);
    }
}
