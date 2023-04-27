<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\SMSCampaignsApi;

/**
 * SendInBlue SMSCampaignsAPI wrapper.
 */
class SMSCampaigns extends BaseAPI
{
    protected SMSCampaignsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new SMSCampaignsApi($this->getClient(), $this->config);
    }
}
