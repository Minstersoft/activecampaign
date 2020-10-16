<?php

namespace Minstersoft\ActiveCampaign\Resources;

class CustomFieldOptions extends Resource
{

    /**
     * object keys
     */
    const ITEM_KEY = null;
    const COLLECTION_KEY = 'fieldOptions';

    /**
     * The id of the custom field.
     *
     * @var int
     */
    public $id;

    /**
     * @var string ID of the custom field to add options to
     */
    public $field;

    /**
     * @var string Name of the option
     */
    public $label;

    /**
     * @var string Value of the option
     */
    public $value;

    /**
     * @var int Order for displaying the custom field option
     */
    public $orderid;

    /**
     * @var bool Whether or not this option is the default value
     */
    public $isdefault;
}
