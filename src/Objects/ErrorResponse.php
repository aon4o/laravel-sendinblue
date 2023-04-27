<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\Objects;

/**
 * Class for formulating errors returned by the package.
 */
class ErrorResponse
{
    public int $code;
    public string $messageCode;
    public string $message;
    public string $reason;

    protected array $errorCodes = [
        'invalid_parameter' => 'The value of the parameter you have provided is not valid. Please check the format and the type',
        'missing_parameter' => 'One of the required parameter is missing to perform the request',
        'out_of_range' => 'The value of the parameter you have provided is not included in the authorized range',
        'unauthorized' => 'You are not authorized to do this call',
        'reseller_permission_denied' => 'You need a reseller plan to perform this API call',
        'document_not_found' => 'The parameter value in brackets {} is not found',
        'method_not_allowed' => 'The method you are requesting for this path is not allowed. (ex : you are doing put but only get method is allowed for the path',
        'not_enough_credits' => 'You don\'t have enough credit to perform the request. Example : you are trying to send a campaign but your plan has expired',
        'duplicate_parameter' => 'You have duplicated one of the parameter in the request',
        'duplicate_request' => 'The request rate of the very same request is too high',
        'account_under_validation' => 'Your account is under validation',
        'permission_denied' => 'You don\'t have the permission to perform this request',
    ];

    /**
     * @param int $code
     * @param string $json_response
     */
    public function __construct(int $code, string $json_response)
    {
        $this->code = $code;

        $array_response = json_decode($json_response);

        $this->messageCode = $array_response->code;
        $this->reason = $array_response->message;

        $this->message = $this->errorCodes[$this->messageCode] ?? '';
    }
}
