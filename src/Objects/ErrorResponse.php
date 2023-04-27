<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\Objects;

use Aon2003\LaravelSendInBlue\Enums\ErrorCodes;
use ReflectionEnum;
use ReflectionException;

/**
 * Class for formulating errors returned by the package.
 */
class ErrorResponse
{
    public int $code;
    public string $messageCode;
    public string $message;
    public string $reason;

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

        $this->message = $this->getMessageText($this->messageCode);
    }

    /**
     * @param string $message_code
     * @return string
     */
    protected function getMessageText(string $message_code): string
    {
        try {
            return (new ReflectionEnum(ErrorCodes::class))->getCase($message_code)->getValue()->value;
        } catch (ReflectionException) {
            return '';
        }
    }
}
