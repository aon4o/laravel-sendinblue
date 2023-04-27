<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
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
     * Get your account information, plan and credits details.
     *
     * @return ErrorResponse|GetAccount
     */
    public function get(): ErrorResponse|GetAccount
    {
        try {
            return $this->api->getAccount();
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }
}
