<?php

namespace Minstersoft\ActiveCampaign\Actions;

use Minstersoft\ActiveCampaign\Resources\Automation;
use Minstersoft\ActiveCampaign\Resources\Contact;

trait ManagesContactAutomations
{
    use ImplementsActions;

    /**
     * Get all organizations.
     *
     * @param \Minstersoft\ActiveCampaign\Resources\Contact $contact
     * @param \Minstersoft\ActiveCampaign\Resources\Automation $automation
     *
     * @return array
     */
    public function addContactToAutomation(Contact $contact, Automation $automation)
    {
        $data = [
            'contact' => $contact->id,
            'automation' => $automation->id,
        ];

        return $this->post('contactAutomations', ['json' => ['contactAutomation' => $data]]);
    }
}
