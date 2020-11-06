<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Resources\Contact;
use Minstersoft\ActiveCampaign\Resources\CustomField;
use Minstersoft\ActiveCampaign\Resources\CustomFieldOptions;
use Minstersoft\ActiveCampaign\Resources\GroupDefinition;

trait ManagesCustomFields
{
    use ImplementsActions;

    /**
     * Get groups in contact custom fields
     *
     * @return array of GroupDefinition
     */
    public function getContactGroupDefinitions()
    {
        return $this->transformCollection(
            $this->get('groupDefinitions', ['query' => ['type_id' => GroupDefinition::CONTACT_TYPE_ID]]),
            GroupDefinition::class,
            GroupDefinition::COLLECTION_KEY
        );
    }

    /**
     * Create a group in contact custom fields
     *
     * @param $label
     * @return GroupDefinition
     */
    public function createContactGroupDefinition($label)
    {
        return $this->transformItem(
            $this->post('groupDefinitions', [
                'json' => [
                    'groupDefinition' => [
                        'label'     => $label,
                        'groupType' => GroupDefinition::CONTACT_TYPE_ID,
                    ],
                ],
            ]),
            GroupDefinition::class,
            GroupDefinition::ITEM_KEY
        );
    }


    /**
     * Create or update custom field
     *
     * @param string $title
     * @param string $type
     * @param array $options
     * @return mixed
     */
    public function createCustomField(string $title, string $type, array $options = [])
    {
        $customField = $this->transformItem(
            $this->post(
                'fields',
                [
                    'json' => [
                        'field' => [
                            'title' => $title,
                            'type'  => $type,
                        ],
                    ],
                ]
            ),
            CustomField::class,
            CustomField::ITEM_KEY
        );
        if (!empty($customField->id)) {
            if (!empty($options)) {
                $optionData = [];
                foreach ($options as $key => $label) {
                    if (is_int($key)) {
                        $value = $label;
                    } else {
                        $value = $key;
                    }

                    $optionData[] = [
                        "field" => $customField->id,
                        "label" => $label,
                        "value" => $value,
                    ];
                }
                $customFieldOptions = $this->transformItem(
                    $this->post(
                        'fieldOption/bulk',
                        [
                            'json' => [
                                'fieldOptions' => $optionData,
                            ],
                        ]
                    ),
                    CustomFieldOptions::class,
                    'field'
                );

                $customField->fieldOptions = $customFieldOptions;
            }

            // Assign to all list
            $this->post(
                'fieldRels',
                [
                    'json' => [
                        'fieldRel' => [
                            "field" => $customField->id,
                            "relid" => 0,
                        ],
                    ],
                ]
            );
        }

        return $customField;
    }

    /**
     * Get all custom fields.
     *
     * @return array
     */
    public function customFields()
    {
        $apiResponse = $this->get('fields');

        return $this->convertResponseToCustomField($apiResponse);
    }

    /**
     * Find custom field by name.
     *
     * @param string $name
     *
     * @return CustomField|null
     */
    public function findCustomField(string $name)
    {
        $apiResponse = $this->get('fields', ['query' => ['search' => $name]]);

        $customFields = $this->convertResponseToCustomField($apiResponse);

        return array_shift($customFields);
    }

    /**
     * Add custom field value to contact.
     *
     * @param \Minstersoft\ActiveCampaign\Resources\Contact $contact
     * @param \Minstersoft\ActiveCampaign\Resources\CustomField $customField
     * @param $value
     *
     * @return Contact
     */
    public function addCustomFieldToContact(Contact $contact, CustomField $customField, $value)
    {
        $data = [
            'contact' => $contact->id,
            'field'   => $customField->id,
            'value'   => $value,
        ];

        $contacts = $this->transformCollection(
            $this->post('fieldValues', ['json' => ['fieldValue' => $data]]),
            Contact::class,
            'contacts'
        );

        return array_shift($contacts);
    }

    /**
     *
     *
     * @param $apiResponse
     * @return mixed
     */
    private function convertResponseToCustomField($apiResponse)
    {
        $customFields = $this->transformCollection(
            $apiResponse,
            CustomField::class,
            CustomField::COLLECTION_KEY
        );

        if (!empty($apiResponse['fieldOptions'])) {
            $fieldOptions = [];
            foreach ($apiResponse['fieldOptions'] as $fieldOption) {
                if (!isset($fieldOptions[$fieldOption['field']])) {
                    $fieldOptions[$fieldOption['field']] = [];
                }

                $fieldOptions[$fieldOption['field']][] = $fieldOption;
            }

            foreach ($customFields as $customField) {
                if (empty($fieldOptions[$customField->id])) {
                    continue;
                }

                $customFieldOptions = $this->transformCollection(
                    $fieldOptions[$customField->id],
                    CustomFieldOptions::class,
                    CustomFieldOptions::COLLECTION_KEY
                );

                $customField->fieldOptions = $customFieldOptions;
            }
        }

        return $customFields;
    }
}
