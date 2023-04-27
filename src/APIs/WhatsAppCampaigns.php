<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\WhatsappCampaignsApi;

/**
 * SendInBlue WhatsAppCampaignsAPI wrapper.
 */
class WhatsAppCampaigns extends BaseAPI
{
    protected WhatsappCampaignsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new WhatsappCampaignsApi($this->getClient(), $this->config);
    }
}
