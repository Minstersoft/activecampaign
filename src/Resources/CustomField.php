<?php

namespace Minstersoft\ActiveCampaign\Resources;

class CustomField extends Resource
{
    /**
     * object keys
     */
    const ITEM_KEY = 'field';
    const COLLECTION_KEY = 'fields';

    /**
     * The id of the custom field.
     *
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
    public $type;

    /**
     * @var array of field option ids
     */
    public $options = [];

    /**
     * @var array
     */
    public $fieldOptions = [];

    /**
     * @var string
     */
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
    const TYPE_LISTBOX = 'listbox';

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


}
