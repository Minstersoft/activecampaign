<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Exceptions\ValidationException;
use Minstersoft\ActiveCampaign\Resources\Deal;


trait ManagesDeals
{
    use ImplementsActions;

    /**
     * Get all deals.
     *
     * @return array
     */
    public function deals()
    {
        return $this->transformCollection(
            $this->get('deals'),
            Deal::class,
            Deal::COLLECTION_KEY
        );
    }

    /**
     * Create new deal.
     *
     * @param string $title
     * @param int $contact
     * @param int $value
     * @param string $currency
     * @param string $group
     * @param string $stage
     * @param string $owner
     * @param array $optional
     * *** Optional ***
     * - string description
     * - string account
     * - int status
     * - array fields
     *
     * @return Deal|null
     * @throws ValidationException
     */
    public function createDeal(
        string $title,
        int $contact,
        int $value,
        string $currency,
        string $group,
        string $stage,
        string $owner,
        array $optional = []
    ) {
        $dealData = compact(
            'title',
            'contact',
            'value',
            'currency',
            'group',
            'stage',
            'owner'
        );

        // Append optional
        foreach ($optional as $key => $val) {
            if (!isset($dealData[$key])) {
                $dealData[$key] = $val;
            }
        }

        return $this->transformItem(
            $this->post(
                'deals',
                [
                    'json' => [
                        'deal' => $dealData,
                    ],
                ]
            ),
            Deal::class,
            Deal::ITEM_KEY
        );
    }


    /**
     * Update deal.
     *
     * @param int $id
     * @param array $data
     *
     * @return Deal|null
     * @throws ValidationException
     */
    public function updateDeal(
        int $id,
        array $data = []
    ) {
        return $this->transformItem(
            $this->put(
                'deals/' . $id,
                [
                    'json' => [
                        'deal' => $data,
                    ],
                ]
            ),
            Deal::class,
            Deal::ITEM_KEY
        );
    }

    /**
     * Get deal
     *
     * @param $id
     * @return Deal|null
     */
    public function getDeal($id)
    {
        return $this->transformItem(
            $this->get('deals/' . $id),
            Deal::class,
            Deal::ITEM_KEY
        );
    }

    /**
     * Bulk add deal custom field values to deal
     *
     * @param int $dealId
     * @param array $data
     *
     * @return mixed api response
     * @throws ValidationException
     */
    public function bulkCreateDealCustomFieldValue(int $dealId, array $data)
    {
        foreach ($data as &$customField) {
            $customField['dealId'] = $dealId;
        }

        return $this->post('dealCustomFieldData/bulkCreate',
            [
                'json' => $data,
            ]
        );
    }

    /**
     * Bulk update deal custom field values
     *
     * @param array $data in each item must contain id of custom field
     *
     * @return mixed api response
     * @throws ValidationException
     */
    public function bulkUpdateDealCustomFieldValue(array $data)
    {
        return $this->patch('dealCustomFieldData/bulkUpdate',
            [
                'json' => $data,
            ]
        );
    }

}
