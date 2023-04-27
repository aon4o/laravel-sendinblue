<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue;

use Aon2003\LaravelSendInBlue\APIs\Account;
use Aon2003\LaravelSendInBlue\APIs\Attributes;
use Aon2003\LaravelSendInBlue\APIs\Companies;
use Aon2003\LaravelSendInBlue\APIs\Contacts;
use Aon2003\LaravelSendInBlue\APIs\Conversations;
use Aon2003\LaravelSendInBlue\APIs\CRM;
use Aon2003\LaravelSendInBlue\APIs\Deals;
use Aon2003\LaravelSendInBlue\APIs\Ecommerce;
use Aon2003\LaravelSendInBlue\APIs\EmailCampaigns;
use Aon2003\LaravelSendInBlue\APIs\Files;
use Aon2003\LaravelSendInBlue\APIs\Folders;
use Aon2003\LaravelSendInBlue\APIs\InboundParsing;
use Aon2003\LaravelSendInBlue\APIs\Lists;
use Aon2003\LaravelSendInBlue\APIs\MasterAccount;
use Aon2003\LaravelSendInBlue\APIs\Notes;
use Aon2003\LaravelSendInBlue\APIs\Process;
use Aon2003\LaravelSendInBlue\APIs\Reseller;
use Aon2003\LaravelSendInBlue\APIs\Senders;
use Aon2003\LaravelSendInBlue\APIs\SMSCampaigns;
use Aon2003\LaravelSendInBlue\APIs\Tasks;
use Aon2003\LaravelSendInBlue\APIs\TransactionalEmails;
use Aon2003\LaravelSendInBlue\APIs\TransactionalSMS;
use Aon2003\LaravelSendInBlue\APIs\TransactionalWhatsApp;
use Aon2003\LaravelSendInBlue\APIs\Webhooks;
use Aon2003\LaravelSendInBlue\APIs\WhatsAppCampaigns;

class LaravelSendInBlue
{
    /**
     * @return Account
     */
    public static function account(): Account
    {
        return new Account();
    }

    /**
     * @return Attributes
     */
    public static function attributes(): Attributes
    {
        return new Attributes();
    }

    /**
     * @return Companies
     */
    public static function companies(): Companies
    {
        return new Companies();
    }

    /**
     * @return Contacts
     */
    public static function contacts(): Contacts
    {
        return new Contacts();
    }

    /**
     * @return Conversations
     */
    public static function conversations(): Conversations
    {
        return new Conversations();
    }

    /**
     * @return CRM
     */
    public static function crm(): CRM
    {
        return new CRM();
    }

    /**
     * @return Deals
     */
    public static function deals(): Deals
    {
        return new Deals();
    }

    /**
     * @return Ecommerce
     */
    public static function ecommerce(): Ecommerce
    {
        return new Ecommerce();
    }

    /**
     * @return EmailCampaigns
     */
    public static function emailCampaigns(): EmailCampaigns
    {
        return new EmailCampaigns();
    }

    /**
     * @return Files
     */
    public static function files(): Files
    {
        return new Files();
    }

    /**
     * @return Folders
     */
    public static function folders(): Folders
    {
        return new Folders();
    }

    /**
     * @return InboundParsing
     */
    public static function inboundParsing(): InboundParsing
    {
        return new InboundParsing();
    }

    /**
     * @return Lists
     */
    public static function lists(): Lists
    {
        return new Lists();
    }

    /**
     * @return MasterAccount
     */
    public static function masterAccount(): MasterAccount
    {
        return new MasterAccount();
    }

    /**
     * @return Notes
     */
    public static function notes(): Notes
    {
        return new Notes();
    }

    /**
     * @return Process
     */
    public static function processes(): Process
    {
        return new Process();
    }

    /**
     * @return Reseller
     */
    public static function reseller(): Reseller
    {
        return new Reseller();
    }

    /**
     * @return Senders
     */
    public static function senders(): Senders
    {
        return new Senders();
    }

    /**
     * @return SMSCampaigns
     */
    public static function smsCampaigns(): SMSCampaigns
    {
        return new SMSCampaigns();
    }

    /**
     * @return Tasks
     */
    public static function tasks(): Tasks
    {
        return new Tasks();
    }

    /**
     * @return TransactionalEmails
     */
    public static function transactionalEmails(): TransactionalEmails
    {
        return new TransactionalEmails();
    }

    /**
     * @return TransactionalSMS
     */
    public static function transactionalSMS(): TransactionalSMS
    {
        return new TransactionalSMS();
    }

    /**
     * @return TransactionalWhatsApp
     */
    public static function transactionalWhatsApp(): TransactionalWhatsApp
    {
        return new TransactionalWhatsApp();
    }

    /**
     * @return Webhooks
     */
    public static function webhooks(): Webhooks
    {
        return new Webhooks();
    }

    /**
     * @return WhatsAppCampaigns
     */
    public static function whatsAppCampaigns(): WhatsAppCampaigns
    {
        return new WhatsAppCampaigns();
    }
}
