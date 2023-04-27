<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\ProcessApi;

/**
 * SendInBlue ProcessAPI wrapper.
 */
class Process extends BaseAPI
{
    protected ProcessApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new ProcessApi($this->getClient(), $this->config);
    }
}
