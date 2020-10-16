<?php

namespace Minstersoft\ActiveCampaign\Resources;

/**
 * Stages
 *
 * Class DealStage
 * @package Minstersoft\ActiveCampaign\Resources
 */
class DealStage extends Resource
{
    /**
     * object keys
     */
    const ITEM_KEY = 'dealStage';
    const COLLECTION_KEY = 'dealStages';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string Deal stage's title
     */
    public $title;

    /**
     * @var string Deal stage's pipeline id
     */
    public $group;

    /**
     * @var int Order of the deal stage.
     * If more than one deal stage share the same order value, the order of those deal stages may not be always the same.
     * If dealStage.order is not provided, the order is assigned with (the highest order of deal stages within the same pipeline) + 1
     */
    public $order;

    /**
     * @var string Option and direction to be used to sort deals in the deal stage.
     * The option and direction should be delimited by a space.
     * Direction can be either "ASC" or "DESC".
     */
    public $dealOrder;

    /**
     * @var string What to show in upper-left corner of Deal Cards
     * @see https://developers.activecampaign.com/reference#section-deal-stage-parameters-available-values
     */
    public $cardRegion1;

    /**
     * @var string What to show in upper-left corner of Deal Cards
     * @see https://developers.activecampaign.com/reference#section-deal-stage-parameters-available-values
     */
    public $cardRegion2;

    /**
     * @var string Whether to show the avatar in Deal Cards.
     * Can be one of show-avatar and hide-avatar. If set to show-avatar, deal cards will show the avatars.
     * If set to hide-avatar, deal cards will hide the avatars
     */
    public $cardRegion3;

    /**
     * @var string What to show next to the avatar in Deal Cards.
     * @see https://developers.activecampaign.com/reference#section-deal-stage-parameters-available-values
     */
    public $cardRegion4;

    /**
     * @var string What to show next to the avatar in Deal Cards.
     * @see https://developers.activecampaign.com/reference#section-deal-stage-parameters-available-values
     */
    public $cardRegion5;

    /**
     * @var string Deal Stage's color. 6-character HEX color code without the hashtag.
     * e.g. "434343" to assign the hex color value "#434343"
     */
    public $color;


    /**
     * @var int Deal stage's width in pixels, without px unit
     */
    public $width;

}
