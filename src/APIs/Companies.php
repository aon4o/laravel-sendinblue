<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\CompaniesApi;

/**
 * SendInBlue CompaniesAPI wrapper.
 */
class Companies extends BaseAPI
{
    protected CompaniesApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new CompaniesApi($this->getClient(), $this->config);
    }
}
