<?php

namespace Minstersoft\ActiveCampaign\Resources;

/**
 * Class GroupMember
 * @package Minstersoft\ActiveCampaign\Resources
 */
class GroupMember extends Resource
{
    /**
     * Object keys
     */
    const ITEM_KEY = 'groupMember';
    const COLLECTION_KEY = 'groupMembers';


    /**
     * @var int ID of the field
     */
    public $id;

    /**
     * @var string id of field
     */
    public $relId;

    /**
     * @var int
     */
    public $ordernum;

    /**
     * @var string
     */
    public $groupId;


}
