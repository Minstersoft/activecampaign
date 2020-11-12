<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Resources\DealCustomField;
use Minstersoft\ActiveCampaign\Resources\GroupDefinition;

trait ManagesDealCustomFields
{
    use ImplementsActions;

    /**
     * Get groups in deal custom fields
     *
     * @return array
     */
    public function getDealGroupDefinitions()
    {
        return $this->transformCollection(
            $this->get('groupDefinitions', ['query' => ['type_id' => GroupDefinition::DEAL_TYPE_ID]]),
            GroupDefinition::class,
            GroupDefinition::COLLECTION_KEY
        );
    }

    /**
     * Create a group in deal custom fields
     *
     * @param $label
     * @return GroupDefinition
     */
    public function createDealGroupDefinition($label)
    {
        return $this->transformItem(
            $this->post('groupDefinitions', [
                'json' => [
                    'groupDefinition' => [
                        'label'     => $label,
                        'groupType' => GroupDefinition::DEAL_TYPE_ID,
                    ],
                ],
            ]),
            GroupDefinition::class,
            GroupDefinition::ITEM_KEY
        );
    }

    /**
     * Create custom field
     *
     * @param string $title
     * @param string $type
     * @param array $options
     * @return mixed
     *
     * @see DealCustomField for type
     */
    public function createDealCustomField(string $title, string $type, array $options = [])
    {
        $data = [
            'fieldLabel' => $title,
            'fieldType'  => $type,
        ];

        if (!empty($options['fieldOptions'])) {
            $data['fieldOptions'] = $options['fieldOptions'];
        }

        if ($type === DealCustomField::TYPE_CURRENCY) {
            $data['fieldDefaultCurrency'] = $options['currency'] ?? 'gbp';
        }

        return $this->transformItem(
            $this->post(
                'dealCustomFieldMeta',
                [
                    'json' => [
                        'dealCustomFieldMetum' => $data,
                    ],
                ]
            ),
            DealCustomField::class,
            DealCustomField::ITEM_KEY
        );
    }

    /**
     * Get all custom fields.
     *
     * @return array
     */
    public function dealCustomFields()
    {
        return $this->transformCollection(
            $this->get('dealCustomFieldMeta'),
            DealCustomField::class,
            DealCustomField::COLLECTION_KEY
        );
    }

    /**
     * Find custom field by name.
     *
     * @param string $name
     *
     * @return DealCustomField|null
     */
    public function findDealCustomField(string $name)
    {
        return $this->transformItem(
            $this->get('dealCustomFieldMeta', ['query' => ['search' => $name]]),
            DealCustomField::class,
            DealCustomField::ITEM_KEY
        );
    }

}
