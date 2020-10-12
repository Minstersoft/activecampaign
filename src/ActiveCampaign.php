<?php

namespace Minstersoft\ActiveCampaign;

use GuzzleHttp\Client as HttpClient;
use Minstersoft\ActiveCampaign\Actions\ManagesAutomations;
use Minstersoft\ActiveCampaign\Actions\ManagesContactAutomations;
use Minstersoft\ActiveCampaign\Actions\ManagesContacts;
use Minstersoft\ActiveCampaign\Actions\ManagesContactTags;
use Minstersoft\ActiveCampaign\Actions\ManagesCustomFields;
use Minstersoft\ActiveCampaign\Actions\ManagesDealCustomFields;
use Minstersoft\ActiveCampaign\Actions\ManagesDealGroups;
use Minstersoft\ActiveCampaign\Actions\ManagesDeals;
use Minstersoft\ActiveCampaign\Actions\ManagesDealStages;
use Minstersoft\ActiveCampaign\Actions\ManagesEvents;
use Minstersoft\ActiveCampaign\Actions\ManagesFieldGroup;
use Minstersoft\ActiveCampaign\Actions\ManagesLists;
use Minstersoft\ActiveCampaign\Actions\ManagesOrganizations;
use Minstersoft\ActiveCampaign\Actions\ManagesTags;
use Minstersoft\ActiveCampaign\Actions\ManagesGroups;
use Minstersoft\ActiveCampaign\Actions\ManagesUsers;
use Minstersoft\ActiveCampaign\Actions\ManagesWebhooks;

class ActiveCampaign
{
    use MakesHttpRequests,
        ManagesAutomations,
        ManagesContacts,
        ManagesFieldGroup,
        ManagesTags,
        ManagesContactTags,
        ManagesContactAutomations,
        ManagesCustomFields,
        ManagesOrganizations,
        ManagesEvents,
        ManagesLists,
        ManagesDealCustomFields,
        ManagesDealGroups,
        ManagesDealStages,
        ManagesDeals,
        ManagesGroups,
        ManagesUsers,
        ManagesWebhooks;

    /**
     * The ActiveCampaign base url.
     *
     * @var string
     */
    public $apiUrl;

    /**
     * The ActiveCampaign API token.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $guzzle;

    /**
     * Create a new ActiveCampaign instance.
     *
     * @param string $apiUrl
     * @param string $apiKey
     * @param \GuzzleHttp\Client $guzzle
     */
    public function __construct($apiUrl, $apiKey, HttpClient $guzzle = null)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;

        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri'    => "{$this->apiUrl}/api/3/",
            'http_errors' => false,
            'headers'     => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
                'Api-Token'    => $this->apiKey,
            ],
        ]);
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param array $collection
     * @param string $class
     * @param string $key
     * @param array $extraData
     *
     * @return array
     */
    protected function transformCollection($collection, $class, $key = '', $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection[$key] ?? $collection);
    }

    /**
     * Transform the item to the given class.
     *
     * @param $data
     * @param $class
     * @param string $key
     * @param array $extraData
     * @return mixed
     */
    protected function transformItem($data, $class, $key = '', $extraData = [])
    {
        return new $class(($data[$key] ?? $data) + $extraData, $this);
    }
}
