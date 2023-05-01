<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
use SendinBlue\Client\Api\DealsApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\Body3;
use SendinBlue\Client\Model\Body4;
use SendinBlue\Client\Model\Body5;
use SendinBlue\Client\Model\Deal;
use SendinBlue\Client\Model\DealAttributes;
use SendinBlue\Client\Model\DealsList;
use SendinBlue\Client\Model\InlineResponse201;
use SendinBlue\Client\Model\Pipeline;

/**
 * SendInBlue DealsAPI wrapper.
 */
class Deals extends BaseAPI
{
    protected DealsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new DealsApi($this->getClient(), $this->config);
    }

    /**
     * Get all deals
     *
     * @param string|null $filters_attributes
     * @param string|null $filters_linked_companies_ids
     * @param string|null $filters_linked_contacts_ids
     * @param int|null $offset
     * @param int $limit
     * @param string|null $sort_order
     * @param string|null $sort_field
     *
     * @return ErrorResponse|DealsList
     */
    public function all(
        string|null $filters_attributes = null,
        string|null $filters_linked_companies_ids = null,
        string|null $filters_linked_contacts_ids = null,
        int|null    $offset = null,
        int         $limit = 50,
        string|null $sort_order = null,
        string|null $sort_field = null,
    ): ErrorResponse|DealsList
    {
        try {
            return $this->api->crmDealsGet(
                $filters_attributes,
                $filters_linked_companies_ids,
                $filters_linked_contacts_ids,
                $offset,
                $limit,
                $sort_order,
                $sort_field
            );
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a deal
     *
     * @param string $id
     *
     * @return Deal|ErrorResponse
     */
    public function get(string $id): Deal|ErrorResponse
    {
        try {
            return $this->api->crmDealsIdGet($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create a deal
     *
     * @param string $name
     * @param array $attributes
     *
     * @return ErrorResponse|InlineResponse201
     */
    public function create(
        string $name,
        array $attributes = [],
    ): ErrorResponse|InlineResponse201
    {
        $requests_data = new Body3(compact('name', 'attributes'));

        try {
            return $this->api->crmDealsPost($requests_data);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a deal
     *
     * @param string $id
     * @param string|null $name
     * @param array $attributes
     *
     * @return ErrorResponse|null
     */
    public function update(
        string      $id,
        string|null $name = null,
        array       $attributes = [],
    ): ErrorResponse|null
    {
        $request_data = new Body4(compact('name', 'attributes'));

        try {
            $this->api->crmDealsIdPatch($id, $request_data);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a deal
     *
     * @param string $id
     *
     * @return ErrorResponse|null
     */
    public function delete(string $id): ErrorResponse|null
    {
        try {
            $this->api->crmDealsIdDelete($id);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get deal attributes
     *
     * @return ErrorResponse|DealAttributes
     */
    public function attributesGet(): ErrorResponse|DealAttributes
    {
        try {
            return $this->api->crmAttributesDealsGet();
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Link and Unlink a deal with contacts and companies
     *
     * @param string $id
     * @param array $link_contact_ids
     * @param array $unlink_contact_ids
     * @param array $link_company_ids
     * @param array $unlink_company_ids
     *
     * @return ErrorResponse|null
     */
    public function linkUnlink(
        string $id,
        array  $link_contact_ids = [],
        array  $unlink_contact_ids = [],
        array  $link_company_ids = [],
        array  $unlink_company_ids = [],
    ): ErrorResponse|null
    {
        $request_data = new Body5([
            'linkContactIds' => $link_contact_ids,
            'unlinkContactIds' => $unlink_contact_ids,
            'linkCompanyIds' => $link_company_ids,
            'unlinkCompanyIds' => $unlink_company_ids,
        ]);

        try {
            $this->api->crmDealsLinkUnlinkIdPatch($id, $request_data);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get pipeline stages
     *
     * @return Pipeline|ErrorResponse
     */
    public function pipelineDetails(): Pipeline|ErrorResponse
    {
        try {
            return $this->api->crmPipelineDetailsGet();
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }
}
