<?php

namespace AsayDev\LaraTickets\Traits;

use AsayDev\LaraTickets\Helpers\TicketsHelper;
use AsayDev\LaraTickets\Models\Setting;
use Mews\Purifier\Facades\Purifier;

trait Purifiable
{
    /**
     * Updates the content and html attribute of the given model.
     *
     * @param string $rawHtml
     *
     * @return \Illuminate\Database\Eloquent\Model $this
     */
    public function setPurifiedContent($rawHtml)
    {
        $this->content = Purifier::clean($rawHtml, ['HTML.Allowed' => '']);
        $this->html = Purifier::clean($rawHtml, $purifier_config->value);
        return $this;
    }
}
