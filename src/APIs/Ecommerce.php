<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\EcommerceApi;

/**
 * SendInBlue EcommerceAPI wrapper.
 */
class Ecommerce extends BaseAPI
{
    protected EcommerceApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new EcommerceApi($this->getClient(), $this->config);
    }
}
