<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\EmailCampaignsApi;

/**
 * SendInBlue EmailCampaignsAPI wrapper.
 */
class EmailCampaigns extends BaseAPI
{
    protected EmailCampaignsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new EmailCampaignsApi($this->getClient(), $this->config);
    }
}
