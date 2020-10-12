<?php

namespace Minstersoft\ActiveCampaign\Resources;

/**
 * Class DealCustomField
 * @package Minstersoft\ActiveCampaign\Resources
 */
class DealCustomField extends Resource
{
    /**
     * Object keys
     */
    const ITEM_KEY = 'dealCustomFieldMetum';
    const COLLECTION_KEY = 'dealCustomFieldMeta';


    const TYPE_TEXT = 'text';

    /**
     * @var string
     */
    const TYPE_TEXTAREA = 'textarea';

    /**
     * @var string
     */
    const TYPE_DATE = 'date';

    /**
     * @var string
     */
    const TYPE_DROPDOWN = 'dropdown';

    /**
     * @var string
     */
    const TYPE_MULTISELECT = 'multiselect';

    /**
     * @var string
     */
    const TYPE_RADIO = 'radio';

    /**
     * @var string
     */
    const TYPE_CHECKBOX = 'checkbox';

    /**
     * @var string
     */
    const TYPE_HIDDEN = 'hidden';

    /**
     * @var string
     */
    const TYPE_DATETIME = 'datetime';

    /**
     * @var string
     */
    const TYPE_NUMBER = 'number';

    /**
     * @var string
     */
    const TYPE_CURRENCY = 'currency';


    /**
     * @var int ID of the field
     */
    public $id;

    /**
     * @var string Name of the field
     */
    public $fieldLabel;

    /**
     * @var string Type of field.
     * Possible values are: text, textarea, date, datetime, dropdown, multiselect, radio, checkbox, hidden, currency, or number.
     */
    public $fieldType;

    /**
     * @var array of strings Options for the field.
     * Only necessary if field_type is dropdown, multiselect, radio, or checkbox.
     */
    public $fieldOptions;

    /**
     * @var string Default value of the field
     */
    public $fieldDefault;

    /**
     * @var string The 3-letter currency code of the default currency for the field. Only necessary if field_type is currency.
     */
    public $fieldDefaultCurrency;

    /**
     * @var boolean Whether or not the field is visible on forms.
     */
    public $isFormVisible;

    /**
     * @var int Order for displaying the field on Manage Fields page and deal profiles.
     */
    public $displayOrder;

    /**
     * @var string
     */
    public $personalization;

}
