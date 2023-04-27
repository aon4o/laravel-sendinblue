<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
use GuzzleHttp\Client;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Configuration;

/**
 * SendInBlue Base API class with helper functions.
 */
class BaseAPI
{
    protected Configuration $config;

    public function __construct()
    {
        $this->config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', config('sendinblue.api.key'));
    }

    /**
     * Returns an HTTP Client to be used when making API requests to SendInBlue.
     *
     * @return Client
     */
    protected function getClient(): Client
    {
        return new Client();
    }

    /**
     * @param ApiException $exception
     * @return ErrorResponse
     */
    protected function returnError(ApiException $exception): ErrorResponse
    {
        return new ErrorResponse($exception->getCode(), $exception->getResponseBody());
    }
}
