<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\TasksApi;

/**
 * SendInBlue TasksAPI wrapper.
 */
class Tasks extends BaseAPI
{
    protected TasksApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new TasksApi($this->getClient(), $this->config);
    }
}
