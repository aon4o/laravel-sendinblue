<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\MasterAccountApi;

/**
 * SendInBlue MasterAccountAPI wrapper.
 */
class MasterAccount extends BaseAPI
{
    protected MasterAccountApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new MasterAccountApi($this->getClient(), $this->config);
    }
}
