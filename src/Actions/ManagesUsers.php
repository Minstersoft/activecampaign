<?php

namespace Minstersoft\ActiveCampaign\Actions;


use Minstersoft\ActiveCampaign\Resources\User;


trait ManagesUsers
{
    use ImplementsActions;

    /**
     * Get all users.
     *
     * @return array
     */
    public function users()
    {
        return $this->transformCollection(
            $this->get('users'),
            User::class,
            User::COLLECTION_KEY
        );
    }

    /**
     * Get user by email.
     *
     * @param string $email
     *
     * @return User|null
     */
    public function getUserByEmail(string $email)
    {
        return $this->transformItem(
            $this->get('users/email/' . $email),
            User::class,
            User::ITEM_KEY
        );
    }

    /**
     * Create new contact.
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param int $group
     * @return User|null
     */
    public function createUser(
        string $email,
        string $username,
        string $password,
        string $firstName,
        string $lastName,
        int $group
    ) {
        return $this->transformItem(
            $this->post(
                'users',
                [
                    'json' => [
                        'user' => compact(
                            'email',
                            'username',
                            'password',
                            'firstName',
                            'lastName',
                            'group'
                        ),
                    ],
                ]
            ),
            User::class,
            User::ITEM_KEY
        );
    }


}
