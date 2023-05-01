<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
use Carbon\Carbon;
use SendinBlue\Client\Api\ContactsApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\AddContactToList;
use SendinBlue\Client\Model\CreateAttribute;
use SendinBlue\Client\Model\CreateContact;
use SendinBlue\Client\Model\CreateDoiContact;
use SendinBlue\Client\Model\CreatedProcessId;
use SendinBlue\Client\Model\CreateList;
use SendinBlue\Client\Model\CreateModel;
use SendinBlue\Client\Model\CreateUpdateContactModel;
use SendinBlue\Client\Model\CreateUpdateFolder;
use SendinBlue\Client\Model\GetAttributes;
use SendinBlue\Client\Model\GetContactCampaignStats;
use SendinBlue\Client\Model\GetContacts;
use SendinBlue\Client\Model\GetExtendedContactDetails;
use SendinBlue\Client\Model\GetExtendedList;
use SendinBlue\Client\Model\GetFolder;
use SendinBlue\Client\Model\GetFolderLists;
use SendinBlue\Client\Model\GetFolders;
use SendinBlue\Client\Model\GetLists;
use SendinBlue\Client\Model\PostContactInfo;
use SendinBlue\Client\Model\RemoveContactFromList;
use SendinBlue\Client\Model\RequestContactExport;
use SendinBlue\Client\Model\RequestContactExportCustomContactFilter;
use SendinBlue\Client\Model\RequestContactImport;
use SendinBlue\Client\Model\RequestContactImportNewList;
use SendinBlue\Client\Model\UpdateAttribute;
use SendinBlue\Client\Model\UpdateBatchContacts;
use SendinBlue\Client\Model\UpdateContact;
use SendinBlue\Client\Model\UpdateList;

/**
 * SendInBlue ContactsAPI wrapper.
 */
class Contacts extends BaseAPI
{
    protected ContactsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new ContactsApi($this->getClient(), $this->config);
    }

    /**
     * Add existing contacts to a list
     *
     * @param int $list_id
     * @param array $contacts
     * @return ErrorResponse|PostContactInfo|null
     */
    public function addContactToList(int $list_id, array $contacts): ErrorResponse|PostContactInfo|null
    {
        if (gettype($contacts[0]) == 'integer') {
            $contactEmails = new AddContactToList(['ids' => $contacts]);
        } else if (gettype($contacts[0]) == 'string') {
            $contactEmails = new AddContactToList(['emails' => $contacts]);
        } else {
            // TODO return an error
            return null;
        }

        try {
            return $this->api->addContactToList($list_id, $contactEmails);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create contact attribute
     *
     * @param string $name
     * @param string $category
     * @param string|null $value
     * @param bool|null $is_recurring
     * @param array|null $enumeration
     * @param string|null $type
     *
     * @return ErrorResponse|null
     */
    public function createAttribute(
        string $name,
        string $category,
        string|null $value = null,
        bool|null $is_recurring = null,
        array|null $enumeration = null,
        string|null $type = null
    ): ErrorResponse|null
    {
        $create_attribute = new CreateAttribute([
            'value' => $value,
            'isRecurring' => $is_recurring,
            'enumeration' => $enumeration,
            'type' => $type,
        ]);

        try {
            $this->api->createAttribute($category, $name, $create_attribute);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create a contact
     *
     * @param string|null $email
     * @param array|null $attributes
     * @param bool $email_blacklisted
     * @param bool $sms_blacklisted
     * @param array|null $list_ids
     * @param bool $update
     * @param array|null $smtp_blacklist_sender
     *
     * @return CreateUpdateContactModel|ErrorResponse
     */
    public function createContact(
        string|null $email = null,
        array|null  $attributes = null,
        bool|null   $email_blacklisted = null,
        bool|null   $sms_blacklisted = null,
        array|null  $list_ids = null,
        bool        $update = false,
        array|null  $smtp_blacklist_sender = null,
    ): CreateUpdateContactModel|ErrorResponse
    {
        $create_contact = new CreateContact([
            'email' => $email,
            'attributes' => $attributes,
            'emailBlacklisted' => $email_blacklisted,
            'smsBlacklisted' => $sms_blacklisted,
            'listIds' => $list_ids,
            'updateEnabled' => $update,
            'smtpBlacklistSender' => $smtp_blacklist_sender,
        ]);

        try {
            return $this->api->createContact($create_contact);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create Contact via DOI (Double-Opt-In) Flow
     *
     * @param string $email
     * @param array $attributes
     * @param array $include_list_ids
     * @param array $exclude_list_ids
     * @param int|null $template_id
     * @param string|null $redirection_url
     *
     * @return ErrorResponse|null
     */
    public function createDoiContact(
        string $email,
        array $attributes = [],
        array $include_list_ids = [],
        array $exclude_list_ids = [],
        int|null $template_id = null,
        string|null $redirection_url = null,
    ): ErrorResponse|null
    {
        $doi_contact = new CreateDoiContact([
            'email' => $email,
            'attributes' => $attributes,
            'includeListIds' => $include_list_ids,
            'excludeListIds' => $exclude_list_ids,
            'templateId' => $template_id,
            'redirectionUrl' => $redirection_url,
        ]);

        try {
            $this->api->createDoiContact($doi_contact);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create a folder
     *
     * @param string|null $name
     *
     * @return ErrorResponse|CreateModel
     */
    public function createFolder(string|null $name = null): ErrorResponse|CreateModel
    {
        $create_folder = new CreateUpdateFolder(compact('name'));

        try {
            return $this->api->createFolder($create_folder);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create a list
     *
     * @param string $name
     * @param int $folder_id
     *
     * @return ErrorResponse|CreateModel
     */
    public function createList(string $name, int $folder_id): ErrorResponse|CreateModel
    {
        $create_list = new CreateList([
            'name' => $name,
            'folderId' => $folder_id,
        ]);

        try {
            return $this->api->createList($create_list);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete an attribute
     *
     * @param string $attribute_category
     * @param string $attribute_name
     *
     * @return ErrorResponse|null
     */
    public function deleteAttribute(string $attribute_category, string $attribute_name)
    {
        try {
            $this->api->deleteAttribute($attribute_category, $attribute_name);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a contact
     *
     * @param string $identifier
     *
     * @return ErrorResponse|null
     */
    public function deleteContact(string $identifier): ErrorResponse|null
    {
        try {
            $this->api->deleteContact($identifier);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a folder (and all its lists)
     *
     * @param int $folderId
     *
     * @return ErrorResponse|null
     */
    public function deleteFolder(int $folderId): ErrorResponse|null
    {
        try {
            $this->api->deleteFolder($folderId);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a list
     *
     * @param int $list_id
     *
     * @return ErrorResponse|null
     */
    public function deleteList(int $list_id): ErrorResponse|null
    {
        try {
            $this->api->deleteList($list_id);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * List all attributes
     *
     * @return ErrorResponse|GetAttributes
     */
    public function getAttributes(): ErrorResponse|GetAttributes
    {
        try {
            return $this->api->getAttributes();
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a contact's details
     *
     * @param string $identifier
     * @param Carbon $start_date
     * @param Carbon $end_date
     *
     * @return GetExtendedContactDetails|ErrorResponse
     */
    public function getContactInfo(
        string      $identifier,
        Carbon|null $start_date = null,
        Carbon|null $end_date = null,
    ): GetExtendedContactDetails|ErrorResponse
    {
        $start_date = $start_date?->format('Y-m-d');
        $end_date = $end_date?->format('Y-m-d');

        try {
            return $this->api->getContactInfo($identifier, $start_date, $end_date);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get email campaigns' statistics for a contact
     *
     * @param string $identifier
     * @param Carbon|null $start_date
     * @param Carbon|null $end_date
     *
     * @return ErrorResponse|GetContactCampaignStats
     */
    public function getContactStats(
        string      $identifier,
        Carbon|null $start_date = null,
        Carbon|null $end_date = null,
    ): ErrorResponse|GetContactCampaignStats
    {
        $start_date = $start_date?->format('Y-m-d');
        $end_date = $end_date?->format('Y-m-d');

        try {
            return $this->api->getContactStats($identifier, $start_date, $end_date);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get all the contacts
     *
     * @param int $limit
     * @param int $offset
     * @param string|null $modifiedSince
     * @param string $sort
     *
     * @return ErrorResponse|GetContacts
     */
    public function getContacts(
        int         $limit = 50,
        int         $offset = 0,
        string|null $modifiedSince = null,
        string      $sort = 'desc',
    ): ErrorResponse|GetContacts
    {
        try {
            return $this->api->getContacts($limit, $offset, $modifiedSince, $sort);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get contacts in a list
     *
     * @param int $listId
     * @param Carbon|null $modified_since
     * @param int $limit
     * @param int $offset
     * @param string $sort
     *
     * @return ErrorResponse|GetContacts
     */
    public function getContactsFromList(
        int         $listId,
        Carbon|null $modified_since = null,
        int         $limit = 50,
        int         $offset = 0,
        string      $sort = 'desc',
    ): ErrorResponse|GetContacts
    {
        $modified_since = $modified_since->format('Y-m-d\TH:i:s.u\Z');

        try {
            return $this->api->getContactsFromList($listId, $modified_since, $limit, $offset, $sort);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Returns a folder's details
     *
     * @param int $folder_id
     *
     * @return GetFolder|ErrorResponse
     */
    public function getFolder(int $folder_id): GetFolder|ErrorResponse
    {
        try {
            return $this->api->getFolder($folder_id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get lists in a folder
     *
     * @param int $folder_id
     * @param int $limit
     * @param int $offset
     * @param string $sort
     *
     * @return ErrorResponse|GetFolderLists
     */
    public function getFolderLists(
        int    $folder_id,
        int    $limit = 10,
        int    $offset = 0,
        string $sort = 'desc',
    ): ErrorResponse|GetFolderLists
    {
        try {
            return $this->api->getFolderLists($folder_id, $limit, $offset, $sort);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get all folders
     *
     * @param int $limit
     * @param int $offset
     * @param string $sort
     *
     * @return ErrorResponse|GetFolders
     */
    public function getFolders(
        int $limit = 10,
        int $offset = 0,
        string $sort = 'desc',
    ): ErrorResponse|GetFolders
    {
        try {
            return $this->api->getFolders($limit, $offset, $sort);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a list's details
     *
     * @param int $list_id
     *
     * @return ErrorResponse|GetExtendedList
     */
    public function getList(int $list_id): ErrorResponse|GetExtendedList
    {
        try {
            return $this->api->getList($list_id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get all the lists
     *
     * @param int $limit
     * @param int $offset
     * @param string $sort
     *
     * @return ErrorResponse|GetLists
     */
    public function getLists(
        int $limit = 10,
        int $offset = 0,
        string $sort = 'desc',
    ): ErrorResponse|GetLists
    {
        try {
            return $this->api->getLists($limit, $offset, $sort);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Import contacts
     *
     * @param string|null $file_url
     * @param string|null $file_body
     * @param string|null $json_body
     * @param array|null $list_ids
     * @param string|null $notify_url
     * @param RequestContactImportNewList|null $new_list
     * @param bool $email_blacklist
     * @param bool $sms_blacklist
     * @param bool $update_existing_contacts
     * @param bool $empty_contacts_attributes
     *
     * @return ErrorResponse|CreatedProcessId
     */
    public function importContacts(
        string|null                      $file_url = null,
        string|null                      $file_body = null,
        string|null                      $json_body = null,
        array|null                       $list_ids = null,
        string|null                      $notify_url = null,
        RequestContactImportNewList|null $new_list = null,
        bool                             $email_blacklist = false,
        bool                             $sms_blacklist = false,
        bool                             $update_existing_contacts = true,
        bool                             $empty_contacts_attributes = false,
    ): ErrorResponse|CreatedProcessId
    {
        $import_contacts = new RequestContactImport([
            'fileUrl' => $file_url,
            'fileBody' => $file_body,
            'jsonBody' => $json_body,
            'listIds' => $list_ids,
            'notifyUrl' => $notify_url,
            'newList' => $new_list,
            'emailBlacklist' => $email_blacklist,
            'smsBlacklist' => $sms_blacklist,
            'updateExistingContacts' => $update_existing_contacts,
            'emptyContactsAttributes' => $empty_contacts_attributes,
        ]);

        try {
            return $this->api->importContacts($import_contacts);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Delete a contact from a list
     *
     * @param int $list_id
     * @param array|null $emails
     * @param array|null $ids
     * @param bool|null $all
     *
     * @return ErrorResponse|PostContactInfo
     */
    public function removeContactFromList(
        int        $list_id,
        array|null $emails = null,
        array|null $ids = null,
        bool|null  $all = null,
    ): ErrorResponse|PostContactInfo
    {
        $contact_emails = new RemoveContactFromList(compact('emails', 'ids', 'all'));

        try {
            return $this->api->removeContactFromList($list_id, $contact_emails);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Export contacts
     *
     * @param array $attributes
     * @param RequestContactExportCustomContactFilter $filter
     * @param string $notify_url
     *
     * @return ErrorResponse|CreatedProcessId
     */
    public function requestContactExport(
        array $attributes,
        RequestContactExportCustomContactFilter $filter,
        string $notify_url,
    ): ErrorResponse|CreatedProcessId
    {
        $contact_export = new RequestContactExport([
            'exportAttributes' => $attributes,
            'customContactFilter' => $filter,
            'notifyUrl' => $notify_url,
        ]);

        try {
            return $this->api->requestContactExport($contact_export);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update contact attribute
     *
     * @param string $attribute_name
     * @param string $attribute_category
     * @param string|null $value
     * @param array|null $enumeration
     *
     * @return ErrorResponse|null
     */
    public function updateAttribute(
        string      $attribute_name,
        string      $attribute_category,
        string|null $value = null,
        array|null  $enumeration = null,
    ): ErrorResponse|null
    {
        $update_data = new UpdateAttribute(compact('value', 'enumeration'));

        try {
            $this->api->updateAttribute($attribute_category, $attribute_name, $update_data);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update multiple contacts
     *
     * @param UpdateBatchContacts $update_data
     *
     * @return ErrorResponse|null
     */
    public function updateBatchContacts(UpdateBatchContacts $update_data): ErrorResponse|null
    {
        try {
            $this->api->updateBatchContacts($update_data);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a contact
     *
     * @param string $identifier
     * @param array|null $attributes
     * @param bool|null $email_blacklisted
     * @param bool|null $sms_blacklisted
     * @param array $list_ids
     * @param array $unlink_list_ids
     * @param array $smtp_blacklist_sender
     *
     * @return ErrorResponse|null
     */
    public function updateContact(
        string     $identifier,
        array|null $attributes = null,
        bool|null  $email_blacklisted = null,
        bool|null  $sms_blacklisted = null,
        array      $list_ids = [],
        array      $unlink_list_ids = [],
        array      $smtp_blacklist_sender = [],
    ): ErrorResponse|null
    {
        $update_contact = new UpdateContact([
            'attributes' => $attributes,
            'emailBlacklisted' => $email_blacklisted,
            'smsBlacklisted' => $sms_blacklisted,
            'listIds' => $list_ids,
            'unlinkListIds' => $unlink_list_ids,
            'smtpBlacklistSender' => $smtp_blacklist_sender,
        ]);

        try {
            $this->api->updateContact($identifier, $update_contact);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a folder
     *
     * @param int $folder_id
     * @param string|null $name
     *
     * @return ErrorResponse|null
     */
    public function updateFolder(int $folder_id, string|null $name = null): ErrorResponse|null
    {
        $update_folder = new CreateUpdateFolder(compact('name'));

        try {
            $this->api->updateFolder($folder_id, $update_folder);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Update a list
     *
     * @param int $list_id
     * @param string|null $name
     * @param int|null $folder_id
     *
     * @return ErrorResponse|null
     */
    public function updateList(
        int         $list_id,
        string|null $name = null,
        int|null    $folder_id = null,
    ): ErrorResponse|null
    {
        $update_list = new UpdateList([
            'name' => $name,
            'folderId' => $folder_id,
        ]);

        try {
            $this->api->updateList($list_id, $update_list);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }
}
