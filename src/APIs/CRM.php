<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
use DateTime;
use SendinBlue\Client\Api\CRMApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\Body;
use SendinBlue\Client\Model\Body1;
use SendinBlue\Client\Model\InlineResponse201;
use SendinBlue\Client\Model\Note;
use SendinBlue\Client\Model\NoteData;
use SendinBlue\Client\Model\NoteId;
use SendinBlue\Client\Model\NoteList;
use SendinBlue\Client\Model\Task;
use SendinBlue\Client\Model\TaskList;
use SendinBlue\Client\Model\TaskReminder;
use SendinBlue\Client\Model\TaskTypes;

/**
 * SendInBlue CRM API wrapper.
 */
class CRM extends BaseAPI
{
    protected CRMApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new CRMApi($this->getClient(), $this->config);
    }

    /**
     * Get all notes
     *
     * @param string|null $entity
     * @param string|null $entity_ids
     * @param int|null $date_from
     * @param int|null $date_to
     * @param int|null $offset
     * @param int $limit
     * @param string|null $sort
     *
     * @return ErrorResponse|NoteList
     */
    public function allNotes(
        string|null $entity = null,
        string|null $entity_ids = null,
        int|null    $date_from = null,
        int|null    $date_to = null,
        int|null    $offset = null,
        int         $limit = 50,
        string|null $sort = null,
    ): ErrorResponse|NoteList
    {
        try {
            return $this->api->crmNotesGet($entity, $entity_ids, $date_from, $date_to, $offset, $limit, $sort);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a note
     *
     * @param string $id
     *
     * @return ErrorResponse|Note
     */
    public function getNote(string $id): ErrorResponse|Note
    {
        try {
            return $this->api->crmNotesIdGet($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create a note
     *
     * @param string $text
     * @param array|null $contact_ids
     * @param array|null $deal_ids
     * @param array|null $company_ids
     *
     * @return ErrorResponse|NoteId
     */
    public function createNote(
        string     $text,
        array|null $contact_ids = null,
        array|null $deal_ids = null,
        array|null $company_ids = null,
    ): ErrorResponse|NoteId
    {
        $body = new NoteData([
            'text' => $text,
            'contactIds' => $contact_ids,
            'dealIds' => $deal_ids,
            'companyIds' => $company_ids,
        ]);

        try {
            return $this->api->crmNotesPost($body);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a note
     *
     * @param string $id
     * @param string $text
     * @param array|null $contact_ids
     * @param array|null $deal_ids
     * @param array|null $company_ids
     *
     * @return ErrorResponse|null
     */
    public function updateNote(
        string     $id,
        string     $text,
        array|null $contact_ids = null,
        array|null $deal_ids = null,
        array|null $company_ids = null,
    ): ErrorResponse|null
    {
        $body = new NoteData([
            'text' => $text,
            'contactIds' => $contact_ids,
            'dealIds' => $deal_ids,
            'companyIds' => $company_ids,
        ]);

        try {
            $this->api->crmNotesIdPatch($id, $body);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a note
     *
     * @param string $id
     *
     * @return ErrorResponse|null
     */
    public function deleteNote(string $id): ErrorResponse|null
    {
        try {
            $this->api->crmNotesIdDelete($id);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get all tasks
     *
     * @param string|null $filter_type
     * @param string|null $filter_status
     * @param string|null $filter_date
     * @param string|null $filter_assign_to
     * @param string|null $filter_contacts
     * @param string|null $filter_deals
     * @param string|null $filter_companies
     * @param int|null $date_from
     * @param int|null $date_to
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $sort_order
     * @param string|null $sort_field
     *
     * @return ErrorResponse|TaskList
     */
    public function allTasks(
        string|null $filter_type = null,
        string|null $filter_status = null,
        string|null $filter_date = null,
        string|null $filter_assign_to = null,
        string|null $filter_contacts = null,
        string|null $filter_deals = null,
        string|null $filter_companies = null,
        int|null    $date_from = null,
        int|null    $date_to = null,
        int|null    $offset = null,
        int|null    $limit = 50,
        string|null $sort_order = null,
        string|null $sort_field = null,
    ): ErrorResponse|TaskList
    {
        try {
            return $this->api->crmTasksGet(
                $filter_type,
                $filter_status,
                $filter_date,
                $filter_assign_to,
                $filter_contacts,
                $filter_deals,
                $filter_companies,
                $date_from,
                $date_to,
                $offset,
                $limit,
                $sort_order,
                $sort_field,
            );
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a task
     *
     * @param string $id
     *
     * @return ErrorResponse|Task
     */
    public function getTask(string $id): ErrorResponse|Task
    {
        try {
            return $this->api->crmTasksIdGet($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create a task
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
     * @return ErrorResponse|InlineResponse201
     */
    public function createTask(
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
    ): ErrorResponse|InlineResponse201
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
            return $this->api->crmTasksPost($body);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a task
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
     * @return ErrorResponse|null
     */
    public function updateTask(
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
    ): ErrorResponse|null
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
            $this->api->crmTasksIdPatch($id, $body);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a task
     *
     * @param string $id
     *
     * @return ErrorResponse|null
     */
    public function deleteTask(string $id): ErrorResponse|null
    {
        try {
            $this->api->crmTasksIdDelete($id);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get all task types
     *
     * @return ErrorResponse|TaskTypes
     */
    public function allTaskTypes(): ErrorResponse|TaskTypes
    {
        try {
            return $this->api->crmTasktypesGet();
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }
}
