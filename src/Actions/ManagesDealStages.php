<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Resources\DealStage;


trait ManagesDealStages
{
    use ImplementsActions;

    /**
     * Get all deal stages.
     *
     * @param int|null $dealGroupId
     * @return array of DealStage
     */
    public function dealStages($dealGroupId = null)
    {
        if ($dealGroupId === null) {
            return $this->transformCollection(
                $this->get('dealStages'),
                DealStage::class,
                DealStage::COLLECTION_KEY
            );
        }

        return $this->transformCollection(
            $this->get('dealStages', ['query' => ['filters[d_groupid]' => $dealGroupId]]),
            DealStage::class,
            DealStage::COLLECTION_KEY
        );
    }

    /**
     * Get deal group
     *
     * @param $id
     * @return DealStage|null
     */
    public function getDealStage($id)
    {
        return $this->transformItem(
            $this->get('dealStages/' . $id),
            DealStage::class,
            DealStage::ITEM_KEY
        );
    }

    /**
     * @param string $title
     * @param string $group
     * @param string|null $color
     * @param int|null $order
     * @return mixed
     */
    public function createDealStage(string $title, string $group, $color = null, $order = null)
    {
        return $this->transformItem(
            $this->post(
                'dealStages',
                [
                    'json' => [
                        'dealStage' => compact(
                            'title',
                            'group',
                            'color',
                            'order'
                        ),
                    ],
                ]
            ),
            DealStage::class,
            DealStage::ITEM_KEY
        );
    }

    /**
     * Removes pipeline.
     *
     * @param string $id ID of the pipeline to delete
     */
    public function deleteDealStage(string $id)
    {
        $this->delete('dealStages/'.$id);
    }

}
