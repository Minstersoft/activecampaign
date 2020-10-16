<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Resources\Automation;
use Minstersoft\ActiveCampaign\Resources\Contact;
use Minstersoft\ActiveCampaign\Resources\ContactAutomation;
use Minstersoft\ActiveCampaign\Resources\ContactList;
use Minstersoft\ActiveCampaign\Resources\ContactTag;
use Minstersoft\ActiveCampaign\Resources\Tag;

trait ManagesContacts
{
    use ImplementsActions;

    /**
     * Get all contacts.
     *
     * @return array
     */
    public function contacts()
    {
        return $this->transformCollection(
            $this->get('contacts'),
            Contact::class,
            'contacts'
        );
    }

    /**
     * Find contact by email.
     *
     * @param string $email
     *
     * @return Contact|null
     */
    public function findContact($email)
    {
        $contacts = $this->transformCollection(
            $this->get('contacts', ['query' => ['email' => $email]]),
            Contact::class,
            'contacts'
        );

        return array_shift($contacts);
    }

    /**
     * Create new contact.
     *
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string|null $phone
     * @param array|null $fieldValues
     * @return Contact|null
     */
    public function createContact($email, $firstName, $lastName, $phone = null, $fieldValues = null)
    {
        return $this->transformItem(
            $this->post(
                'contacts',
                [
                    'json' => [
                        'contact' => compact(
                            'email',
                            'firstName',
                            'lastName',
                            'phone',
                            'fieldValues'
                        ),
                    ],
                ]
            ),
            Contact::class,
            Contact::ITEM_KEY
        );
    }

    /**
     * Create or update contact.
     *
     * @param $email
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $phone
     * @param array $fieldValues
     * @return Contact|null
     */
    public function createOrUpdateContact(
        $email,
        $firstName = null,
        $lastName = null,
        $phone = null,
        $fieldValues = null
    ) {
        $contact = [
            'email' => $email,
        ];

        foreach (
            [
                'firstName',
                'lastName',
                'phone',
                'fieldValues',
            ] as $optionalField
        ) {
            if (isset(${$optionalField})) {
                $contact[$optionalField] = ${$optionalField};
            }
        }

        return $this->transformItem(
            $this->post(
                'contact/sync',
                [
                    'json' => [
                        'contact' => $contact,
                    ],
                ]
            ),
            Contact::class,
            Contact::ITEM_KEY
        );
    }

    /**
     * Update contact.
     *
     * @param int $id
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string|null $phone
     * @param array|null $fieldValues
     * @return Contact|null
     */
    public function updateContact(
        int $id,
        string $email,
        $firstName = null,
        $lastName = null,
        $phone = null,
        $fieldValues = null
    ) {
        $contact = [
            'id'    => $id,
            'email' => $email,
        ];

        foreach (
            [
                'firstName',
                'lastName',
                'phone',
                'fieldValues',
            ] as $optionalField
        ) {
            if (isset(${$optionalField})) {
                $contact[$optionalField] = ${$optionalField};
            }
        }

        return $this->transformItem(
            $this->put(
                'contact/' . $id,
                [
                    'json' => [
                        'contact' => $contact,
                    ],
                ]
            ),
            Contact::class,
            Contact::ITEM_KEY
        );
    }

    /**
     * Get contact
     *
     * @param $id
     * @return Contact|null
     */
    public function getContact($id)
    {
        return $this->transformItem(
            $this->get('contacts/' . $id),
            Contact::class,
            Contact::ITEM_KEY
        );
    }

    /**
     * Find or create a contact.
     *
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string|null $phone
     * @return Contact
     */
    public function findOrCreateContact($email, $firstName, $lastName, $phone = null, $fieldValues = null)
    {
        $contact = $this->findContact($email);

        if ($contact instanceof Contact) {
            return $contact;
        }

        return $this->createContact($email, $firstName, $lastName, $phone, $fieldValues);
    }

    /**
     * Return contact list of a contact
     *
     * @param string $contact id
     * @return array of ContactList
     */
    public function getContactListsOfContact(string $contact)
    {
        return $this->transformCollection(
            $this->get('contactLists', ['query' => ['contact' => $contact]]),
            ContactList::class,
            ContactList::COLLECTION_KEY
        );
    }

    /**
     * Get all automations of a contact.
     *
     * @param \Minstersoft\ActiveCampaign\Resources\Contact $contact
     *
     * @return array
     */
    public function contactAutomations(Contact $contact)
    {
        return $this->transformCollection(
            $this->get("contacts/{$contact->id}/contactAutomations"),
            ContactAutomation::class,
            'contactAutomations'
        );
    }

    /**
     * Get all tags of a contact.
     *
     * @param \Minstersoft\ActiveCampaign\Resources\Contact $contact
     *
     * @return array
     */
    public function contactTags(Contact $contact)
    {
        return $this->transformCollection(
            $this->get("contacts/{$contact->id}/contactTags"),
            ContactTag::class,
            'contactTags'
        );
    }

    /**
     * Removing a automation from a contact.
     *
     * @param \Minstersoft\ActiveCampaign\Resources\Contact $contact
     * @param \Minstersoft\ActiveCampaign\Resources\Automation $automation
     */
    public function removeAutomationFromContact(Contact $contact, Automation $automation)
    {
        $contactAutomations = $this->contactAutomations($contact);

        $contactAutomation = current(array_filter($contactAutomations, function ($contactAutomation) use ($automation) {
            return $contactAutomation->automation == $automation->id;
        }));

        if (empty($contactAutomation)) {
            return;
        }

        $this->delete("contactAutomations/{$contactAutomation->id}");
    }

    /**
     * Removing all automations from a contact.
     *
     * @param \Minstersoft\ActiveCampaign\Resources\Contact $contact
     */
    public function removeAllAutomationsFromContact(Contact $contact)
    {
        $contactAutomations = $this->contactAutomations($contact);

        foreach ($contactAutomations as $contactAutomation) {
            $this->delete("contactAutomations/{$contactAutomation->id}");
        }
    }

    /**
     * Removing a tag from a contact.
     *
     * @param \Minstersoft\ActiveCampaign\Resources\Contact $contact
     * @param \Minstersoft\ActiveCampaign\Resources\Tag $tag
     */
    public function removeTagFromContact(Contact $contact, Tag $tag)
    {
        $contactTags = $this->contactTags($contact);

        $contactTag = current(array_filter($contactTags, function ($contactTag) use ($tag) {
            return $contactTag->tag == $tag->id;
        }));

        if (empty($contactTag)) {
            return;
        }

        $this->delete("contactTags/{$contactTag->id}");
    }

}
