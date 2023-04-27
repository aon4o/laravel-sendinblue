<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use GuzzleHttp\Client;
use SendinBlue\Client\Configuration;

/**
 * SendInBlue Base API.
 */
class BaseAPI
{
    protected Configuration $config;

    public function __construct()
    {
        $this->config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', config('sendinblue.api.key'));
    }

    protected function getClient(): Client
    {
        return new Client();
    }
}
