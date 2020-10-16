<?php

namespace Minstersoft\ActiveCampaign\Resources;

class ContactList extends Resource
{
    /**
     * object keys
     */
    const ITEM_KEY = 'contactList';
    const COLLECTION_KEY = 'contactLists';

    const STATUS_SUBSCRIBE = '1';
    const STATUS_UNSUBSCRIBE = '2';


    /**
     * The id of the contact.
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $contact;

    /**
     * @var string
     */
    public $list;

    /**
     * @var string
     */
    public $status;


}
