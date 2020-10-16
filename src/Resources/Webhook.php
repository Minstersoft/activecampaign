<?php

namespace Minstersoft\ActiveCampaign\Resources;

class Webhook extends Resource
{

    /**
     * object keys
     */
    const ITEM_KEY = 'webhook';
    const COLLECTION_KEY = 'webhooks';

    const EVENT_FORWARD = 'forward';
    const EVENT_OPEN = 'open';
    const EVENT_SHARE = 'share';
    const EVENT_SENT = 'sent';
    const EVENT_SUBSCRIBE = 'subscribe';
    const EVENT_SUBSCRIBER_NOTE = 'subscriber_note';
    const EVENT_CONTACT_TAG_ADDED = 'contact_tag_added';
    const EVENT_CONTACT_TAG_REMOVED = 'contact_tag_removed';
    const EVENT_UNSUBSCRIBE = 'unsubscribe';
    const EVENT_UPDATE = 'update';
    const EVENT_DEAL_ADD = 'deal_add';
    const EVENT_DEAL_NOTE_ADD = 'deal_note_add';
    const EVENT_DEAL_PIPELINE_ADD = 'deal_pipeline_add';
    const EVENT_DEAL_STAGE_ADD = 'deal_stage_add';
    const EVENT_DEAL_TASK_ADD = 'deal_task_add';
    const EVENT_DEAL_TASK_COMPLETE = 'deal_task_complete';
    const EVENT_DEAL_TASKTYPE_ADD = 'deal_tasktype_add';
    const EVENT_DEAL_UPDATE = 'deal_update';
    const EVENT_BOUNCE = 'bounce';
    const EVENT_REPLY = 'reply';
    const EVENT_CLICK = 'click';
    const EVENT_LIST_ADD = 'list_add';
    const EVENT_SMS_REPLY = 'sms_reply';
    const EVENT_SMS_SENT = 'sms_sent';
    const EVENT_SMS_UNSUB = 'sms_unsub';

    const SOURCE_PUBLIC = 'public';
    const SOURCE_ADMIN = 'admin';
    const SOURCE_API = 'api';
    const SOURCE_SYSTEM = 'system';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string url
     */
    public $url;

    /**
     * @var array of string
     */
    public $events;

    /**
     * @var array of string
     */
    public $sources;

}
