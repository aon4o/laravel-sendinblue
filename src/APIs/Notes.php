<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\NotesApi;

/**
 * SendInBlue NotesAPI wrapper.
 */
class Notes extends BaseAPI
{
    protected NotesApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new NotesApi($this->getClient(), $this->config);
    }
}
