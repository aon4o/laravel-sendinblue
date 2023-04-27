<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\FoldersApi;

/**
 * SendInBlue FoldersAPI wrapper.
 */
class Folders extends BaseAPI
{
    protected FoldersApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new FoldersApi($this->getClient(), $this->config);
    }
}
