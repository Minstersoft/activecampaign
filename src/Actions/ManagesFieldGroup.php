<?php

namespace Minstersoft\ActiveCampaign\Actions;


use Minstersoft\ActiveCampaign\Resources\GroupMember;


trait ManagesFieldGroup
{
    use ImplementsActions;

    public function placeInGroup($groupId, $fieldId)
    {
        return $this->transformItem(
            $this->post('groupMembers', [
                'json' => [
                    'groupMember' => [
                        'rel_id'   => $fieldId,
                        // 'ordernum' => 1,
                        'group_id' => $groupId,
                    ],
                ],
            ]),
            GroupMember::class,
            GroupMember::ITEM_KEY
        );
    }

}
