<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\FilesApi;

/**
 * SendInBlue FilesAPI wrapper.
 */
class Files extends BaseAPI
{
    protected FilesApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new FilesApi($this->getClient(), $this->config);
    }
}
