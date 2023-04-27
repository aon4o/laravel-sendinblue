<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\Enums;

/**
 * Enum for converting SendInBlue error codes to messages.
 */
enum ErrorCodes: string
{
    case invalid_parameter = 'The value of the parameter you have provided is not valid. Please check the format and the type';
    case missing_parameter = 'One of the required parameter is missing to perform the request';
    case out_of_range = 'The value of the parameter you have provided is not included in the authorized range';
    case unauthorized = 'You are not authorized to do this call';
    case reseller_permission_denied = 'You need a reseller plan to perform this API call';
    case document_not_found = 'The parameter value in brackets {} is not found';
    case method_not_allowed = 'The method you are requesting for this path is not allowed. (ex : you are doing put but only get method is allowed for the path';
    case not_enough_credits = 'You don\'t have enough credit to perform the request. Example : you are trying to send a campaign but your plan has expired';
    case duplicate_parameter = 'You have duplicated one of the parameter in the request';
    case duplicate_request = 'The request rate of the very same request is too high';
    case account_under_validation = 'Your account is under validation';
    case permission_denied = 'You don\'t have the permission to perform this request';
}
