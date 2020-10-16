<?php

namespace Minstersoft\ActiveCampaign\Resources;

class Contact extends Resource
{
    /**
     * object keys
     */
    const ITEM_KEY = 'contact';
    const COLLECTION_KEY = 'contacts';

    /**
     * The id of the contact.
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int
     */
    public $orgid;

    public function subscribe($list)
    {
        $this->activeCampaign->updateListStatus($list, $this->id, true);
    }

    public function unsubscribe($list)
    {
        $this->activeCampaign->updateListStatus($list, $this->id, false);
    }
}
