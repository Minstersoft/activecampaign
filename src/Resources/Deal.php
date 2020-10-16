<?php

namespace Minstersoft\ActiveCampaign\Resources;

class Deal extends Resource
{

    /**
     * object keys
     */
    const ITEM_KEY = 'deal';
    const COLLECTION_KEY = 'deals';


    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string value in cents (i.e. £456.78 => 45678)
     */
    public $value;

    /**
     * @var string Deal's currency in 3-digit ISO format, lowercased.
     */
    public $currency;

    /**
     * @var string Deal's pipeline id. Required if deal.stage is not provided. If deal.group is not provided, the stage's pipeline will be assigned to the deal automatically.
     */
    public $group;

    /**
     * @var string Deal's stage id. Required if deal.group is not provided. If deal.stage is not provided, the deal will be assigned with the first stage in the pipeline provided in deal.group.
     */
    public $stage;

    /**
     * @var string Deal's owner id. Required if pipeline's auto-assign option is disabled.
     */
    public $owner;

    /**
     * @var int Deal's percentage.
     */
    public $percent;

    /**
     * @var int
     */
    public $status;

    /**
     * @var array Deal's custom field values [{customFieldId, fieldValue}]
     */
    public $fields;


    // public function subscribe($list)
    // {
    //     $this->activeCampaign->updateListStatus($list, $this->id, true);
    // }
    //
    // public function unsubscribe($list)
    // {
    //     $this->activeCampaign->updateListStatus($list, $this->id, false);
    // }
}
