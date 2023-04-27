<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
use DateTime;
use SendinBlue\Client\Api\CompaniesApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\Body;
use SendinBlue\Client\Model\Body1;
use SendinBlue\Client\Model\Body2;
use SendinBlue\Client\Model\CompaniesList;
use SendinBlue\Client\Model\Company;
use SendinBlue\Client\Model\CompanyAttributes;
use SendinBlue\Client\Model\InlineResponse200;
use SendinBlue\Client\Model\TaskReminder;

/**
 * SendInBlue CompaniesAPI wrapper.
 */
class Companies extends BaseAPI
{
    protected CompaniesApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new CompaniesApi($this->getClient(), $this->config);
    }

    /**
     * Get all companies
     *
     * @param string|null $filter
     * @param int|null $contact_id
     * @param string|null $detail_id
     * @param int|null $page
     * @param int $limit
     * @param string|null $sort_order
     * @param string|null $sort_field
     *
     * @return CompaniesList|ErrorResponse
     */
    public function all(
        string|null $filter = null,
        int|null    $contact_id = null,
        string|null $detail_id = null,
        int|null    $page = null,
        int         $limit = 50,
        string|null $sort_order = null,
        string|null $sort_field = null,
    ): CompaniesList|ErrorResponse
    {
        try {
            return $this->api->companiesGet(
                $filter,
                $contact_id,
                $detail_id,
                $page,
                $limit,
                $sort_order,
                $sort_field
            );
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a company
     *
     * @param string $id
     *
     * @return Company|ErrorResponse
     */
    public function get(string $id): Company|ErrorResponse
    {
        try {
            return $this->api->companiesIdGet($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create a company
     *
     * @param string $name
     * @param string $taskTypeId
     * @param DateTime $date
     * @param int|null $duration
     * @param string|null $notes
     * @param bool|null $done
     * @param string|null $assignTold
     * @param array|null $contacts_ids
     * @param array|null $deals_ids
     * @param array|null $companies_ids
     * @param TaskReminder|null $reminder
     *
     * @return InlineResponse200|ErrorResponse
     */
    public function create(
        string            $name,
        string            $taskTypeId,
        DateTime          $date,
        int|null          $duration = null,
        string|null       $notes = null,
        bool|null         $done = null,
        string|null       $assignTold = null,
        array|null        $contacts_ids = null,
        array|null        $deals_ids = null,
        array|null        $companies_ids = null,
        TaskReminder|null $reminder = null,
    ): InlineResponse200|ErrorResponse
    {
        $body = new Body([
            'name' => $name,
            'duration' => $duration,
            'taskTypeId' => $taskTypeId,
            'date' => $date,
            'notes' => $notes,
            'done' => $done,
            'assignToId' => $assignTold,
            'contactsIds' => $contacts_ids,
            'dealsIds' => $deals_ids,
            'companiesIds' => $companies_ids,
            'reminder' => $reminder,
        ]);

        try {
            return $this->api->companiesPost($body);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a company
     *
     * @param string $id
     * @param string $name
     * @param string $taskTypeId
     * @param DateTime $date
     * @param int|null $duration
     * @param string|null $notes
     * @param bool|null $done
     * @param string|null $assignTold
     * @param array|null $contacts_ids
     * @param array|null $deals_ids
     * @param array|null $companies_ids
     * @param TaskReminder|null $reminder
     *
     * @return Company|ErrorResponse
     */
    public function update(
        string            $id,
        string            $name,
        string            $taskTypeId,
        DateTime          $date,
        int|null          $duration = null,
        string|null       $notes = null,
        bool|null         $done = null,
        string|null       $assignTold = null,
        array|null        $contacts_ids = null,
        array|null        $deals_ids = null,
        array|null        $companies_ids = null,
        TaskReminder|null $reminder = null,
    ): Company|ErrorResponse
    {
        $body = new Body1([
            'name' => $name,
            'duration' => $duration,
            'taskTypeId' => $taskTypeId,
            'date' => $date,
            'notes' => $notes,
            'done' => $done,
            'assignToId' => $assignTold,
            'contactsIds' => $contacts_ids,
            'dealsIds' => $deals_ids,
            'companiesIds' => $companies_ids,
            'reminder' => $reminder,
        ]);

        try {
            return $this->api->companiesIdPatch($id, $body);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Link and Unlink company with contacts and deals
     *
     * @param string $id
     * @param array|null $link_contact_ids
     * @param array|null $unlink_contact_ids
     * @param array|null $link_deal_ids
     * @param array|null $unlink_deal_ids
     *
     * @return ErrorResponse|null
     */
    public function linkOrUnlink(
        string     $id,
        array|null $link_contact_ids = null,
        array|null $unlink_contact_ids = null,
        array|null $link_deal_ids = null,
        array|null $unlink_deal_ids = null,
    ): ErrorResponse|null
    {
        $body = new Body2([
            'linkContactIds' => $link_contact_ids,
            'unlinkContactIds' => $unlink_contact_ids,
            'linkDealsIds' => $link_deal_ids,
            'unlinkDealsIds' => $unlink_deal_ids,
        ]);

        try {
            $this->api->companiesLinkUnlinkIdPatch($id, $body);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get company attributes
     *
     * @return ErrorResponse|CompanyAttributes
     */
    public function attributes(): ErrorResponse|CompanyAttributes
    {
        try {
            return $this->api->companiesAttributesGet();
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a company
     *
     * @param string $id
     * @return ErrorResponse|null
     */
    public function delete(string $id): ErrorResponse|null
    {
        try {
            $this->api->companiesIdDelete($id);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }
}
