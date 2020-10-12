<?php

namespace Minstersoft\ActiveCampaign\Resources;

/**
 * Class GroupDefinitions
 * @package Minstersoft\ActiveCampaign\Resources
 */
class GroupDefinition extends Resource
{
    /**
     * Object keys
     */
    const ITEM_KEY = 'groupDefinition';
    const COLLECTION_KEY = 'groupDefinitions';

    const CONTACT_TYPE_ID = 1;
    const DEAL_TYPE_ID = 2;

    /**
     * @var int ID of the field
     */
    public $id;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var string
     */
    public $label;


}
