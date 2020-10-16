<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Resources\Webhook;


trait ManagesWebhooks
{
    use ImplementsActions;

    /**
     * Get all webhooks.
     *
     * @return array of Webhook
     */
    public function webhooks()
    {
        return $this->transformCollection(
            $this->get('webhooks'),
            Webhook::class,
            Webhook::COLLECTION_KEY
        );
    }

    /**
     * Create new webhook.
     *
     * @param string $name
     * @param string $url
     * @param array $sources
     * @param array $events
     * @return Webhook|null
     */
    public function createWebhook(
        string $name,
        string $url,
        array $sources,
        array $events
    ) {
        $data = [
            'name'    => $name,
            'url'     => $url,
            'sources' => $sources,
            'events'  => $events,
        ];

        return $this->transformItem(
            $this->post(
                'webhooks',
                [
                    'json' => [
                        'webhook' => $data,
                    ],
                ]
            ),
            Webhook::class,
            Webhook::ITEM_KEY
        );
    }


}
