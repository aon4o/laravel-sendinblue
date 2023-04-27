<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\ListsApi;

/**
 * SendInBlue ListsAPI wrapper.
 */
class Lists extends BaseAPI
{
    protected ListsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new ListsApi($this->getClient(), $this->config);
    }
}
