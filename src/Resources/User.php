<?php

namespace Minstersoft\ActiveCampaign\Resources;

class User extends Resource
{
    /**
     * object keys
     */
    const ITEM_KEY = 'user';
    const COLLECTION_KEY = 'users';

    /**
     * The id of the contact.
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var int Group ID
     */
    public $group;

    /**
     * @var string Plain text password
     */
    public $password;
}
