<?php

namespace Minstersoft\ActiveCampaign\Actions;


use Minstersoft\ActiveCampaign\Resources\Group;


trait ManagesGroups
{
    use ImplementsActions;

    /**
     * Get groups.
     *
     * @param string|null $title
     * @return array of Group
     */
    public function groups(string $title = null)
    {
        if ($title === null) {
            $response = $this->get('groups');
        } else {
            $response = $this->get('groups', ['query' => ['filters[title]' => $title]]);
        }

        return $this->transformCollection(
            $response,
            Group::class,
            Group::COLLECTION_KEY
        );
    }


}
