<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Resources\DealGroup;
use Minstersoft\ActiveCampaign\Resources\DealStage;


trait ManagesDealGroups
{
    use ImplementsActions;

    /**
     * Get all deal groups.
     *
     * @return array of DealGroup
     */
    public function dealGroups()
    {
        $apiResponse = $this->get('dealGroups');

        $dealGroups = $this->transformCollection(
            $apiResponse,
            DealGroup::class,
            DealGroup::COLLECTION_KEY
        );

        $dealStagesGroupByDealGroup = [];
        if (!empty($apiResponse['dealStages'])) {
            foreach ($apiResponse['dealStages'] as $dealStage) {
                if (!isset($dealStagesGroupByDealGroup[$dealStage['group']])) {
                    $dealStagesGroupByDealGroup[$dealStage['group']] = [];
                }

                $dealStagesGroupByDealGroup[$dealStage['group']][] = $dealStage;
            }
        }

        foreach ($dealGroups as &$dealGroup) {
            if (isset($dealStagesGroupByDealGroup[$dealGroup->id])) {
                $dealGroup->dealStages = $this->transformCollection(
                    $dealStagesGroupByDealGroup[$dealGroup->id],
                    DealStage::class
                );
            }
        }

        return $dealGroups;
    }

    public function createDealGroup($title, $currency = 'gbp', $autoassign = 0, $allusers = 0, $allgroups = 1)
    {
        $apiResponse = $this->post(
            'dealGroups',
            [
                'json' => [
                    'dealGroup' => compact(
                        'title',
                        'currency',
                        'autoassign',
                        'allusers',
                        'allgroups'
                    ),
                ],
            ]
        );

        $dealGroup = $this->transformItem(
            $apiResponse,
            DealGroup::class,
            DealGroup::ITEM_KEY
        );

        $dealGroup->dealStages = $this->transformCollection(
            $apiResponse,
            DealStage::class,
            DealStage::COLLECTION_KEY
        );

        return $dealGroup;
    }

    public function searchDealGroup($title)
    {
        return $this->transformCollection(
            $this->get('dealGroups', ['query' => ['filters[title]' => $title]]),
            DealGroup::class,
            'dealGroups'
        );
    }

    /**
     * Get deal group
     *
     * @param $id
     * @return DealGroup|null
     */
    public function getDealGroup($id)
    {
        $apiResponse = $this->get('dealGroups/' . $id);

        $dealGroup = $this->transformItem(
            $apiResponse,
            DealGroup::class,
            DealGroup::ITEM_KEY
        );

        $dealGroup->dealStages = $this->transformCollection(
            $apiResponse,
            DealStage::class,
            DealStage::COLLECTION_KEY
        );

        return $dealGroup;
    }


    /**
     * Removes pipeline.
     *
     * @param string $id ID of the pipeline to delete
     */
    public function deleteDealGroup(string $id)
    {
        $this->delete('dealGroups/'.$id);
    }

}
