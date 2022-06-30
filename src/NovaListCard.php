<?php

namespace Wdelfuego\NovaListCard;

use Laravel\Nova\Card;
use Wdelfuego\NovaListCard\AbstractDataSource;

use Illuminate\Support\Facades\Log;

class NovaListCard extends Card
{
    public $width = '1/2';

    public function __construct(string $dataSourceKey)
    {
        Log::debug("Constructing NovaListCard for data source with key : " .$dataSourceKey);
        $this->withMeta(['dataSourceKey' => $dataSourceKey]);
    }

    public function component()
    {
        return 'nova-list-card';
    }
}
