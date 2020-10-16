<?php

namespace Minstersoft\ActiveCampaign\Resources;

class Group extends Resource
{
    /**
     * object keys
     */
    const ITEM_KEY = 'group';
    const COLLECTION_KEY = 'groups';

    /**
     * The id of the contact.
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;


}
