<?php

namespace Minstersoft\ActiveCampaign\Resources;

/**
 * Pipeline
 *
 * Class DealGroup
 * @package Minstersoft\ActiveCampaign\Resources
 */
class DealGroup extends Resource
{
    /**
     * object keys
     */
    const ITEM_KEY = 'dealGroup';
    const COLLECTION_KEY = 'dealGroups';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string Pipeline's title.
     */
    public $title;

    /**
     * @var string Default currency to assign to new deals that belong to this deal group in 3-digit ISO format, lowercased.
     */
    public $currency;

    /**
     * @var int Whether all user groups have permission to manage this pipeline. Can be either 1 or 0.
     * If 1, all user groups can manage this pipeline.
     * If 0, only user groups in dealGroup.groups parameter can manage this pipeline.
     */
    public $allgroups;

    /**
     * @var int Whether new deals get auto-assigned to all users.
     * Can be either 1 or 0. If 1, new deals are auto-assigned to all users unless auto-assign is disabled.
     * If 0, new deals are auto-assigned to only the users in dealGroup.users parameter.
     */
    public $allusers;

    /**
     * @var int Deal auto-assign option. Can be one of 0, 1, and 2.
     * If 0, auto-assign is disabled.
     * If 1, Round Robin method is used to auto-assign new deals.
     * If 2, deals are distributed based on deal values.
     */
    public $autoassign;

    /**
     * @var array of strings List of user ids to auto-assign new deals to unless auto-assign option is disabled.
     */
    public $users;

    /**
     * @var array of strings List of user group ids to allow managing this pipeline.
     */
    public $groups;

    /**
     * @var array of DealStage
     */
    public $dealStages;

    /**
     * @var array of DealStage ID
     */
    public $stages;


}
