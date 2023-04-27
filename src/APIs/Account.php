<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\AccountApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\GetAccount;

/**
 * SendInBlue AccountAPI wrapper.
 */
class Account extends BaseAPI
{
    protected AccountApi $api;
    public function __construct()
    {
        parent::__construct();

        $this->api = new AccountApi(
            $this->getClient(),
            $this->config
        );
    }

    /**
     * @return GetAccount|void
     */
    public function get()
    {
        try {
            return $this->api->getAccount();
        } catch (ApiException $exception) {
            dd(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getResponseBody(),
            );
        }
    }
}
