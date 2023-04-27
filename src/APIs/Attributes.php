<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\AttributesApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\CreateAttribute;
use SendinBlue\Client\Model\UpdateAttribute;

/**
 * SendInBlue AttributesAPI wrapper.
 */
class Attributes extends BaseAPI
{
    protected AttributesApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new AttributesApi($this->getClient(), $this->config);
    }

    /**
     * List all attributes
     *
     * @return void
     */
    public function get(): void
    {
        try {
            $this->api->getAttributes();
        } catch (ApiException $exception) {
            $this->returnError($exception);
        }
    }

    /**
     * Create contact attribute.
     *
     * @param string $category
     * @param string $name
     * @param string|null $value
     * @param bool|null $recurring
     * @param array|null $enumeration
     * @param string|null $type
     *
     * @return void
     */
    public function create(
        string      $category,
        string      $name,
        string|null $value = null,
        bool|null   $recurring = null,
        array|null  $enumeration = null,
        string|null $type = null,
    ): void
    {
        $attributes = new CreateAttribute([
            'value' => $value,
            'isRecurring' => $recurring,
            'enumeration' => $enumeration,
            'type' => $type,
        ]);

        try {
            $this->api->createAttribute($category, $name, $attributes);
        } catch (ApiException $exception) {
            $this->returnError($exception);
        }
    }

    /**
     * Update contact attribute
     *
     * @param string $category
     * @param string $name
     * @param string|null $value
     * @param array|null $enumeration
     *
     * @return void
     */
    public function update(string $category, string $name, string|null $value = null, array|null $enumeration = null): void
    {
        $attributes = new UpdateAttribute(compact('value', 'enumeration'));

        try {
            $this->api->updateAttribute($category, $name, $attributes);
        } catch (ApiException $exception) {
            $this->returnError($exception);
        }
    }

    /**
     * Delete an attribute
     *
     * @param string $category
     * @param string $name
     *
     * @return void
     */
    public function delete(string $category, string $name): void
    {
        try {
            $this->api->deleteAttribute($category, $name);
        } catch (ApiException $exception) {
            $this->returnError($exception);
        }
    }
}
