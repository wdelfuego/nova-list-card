<?php

namespace Wdelfuego\NovaListCard\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Laravel\Nova\Http\Requests\NovaRequest;

use Wdelfuego\DataSource\DataSourceManager;
use Wdelfuego\DataSource\AbstractDataSource;
use Illuminate\Support\Facades\Log;

class ListCardController extends BaseController
{
    private $request;

    public function __construct(NovaRequest $request)
    {
        $this->request = $request;
    }
    
    public function getData(string $dataSourceKey)
    {
        $dataSource = DataSourceManager::dataSourceWithKey($dataSourceKey);
        if(!$dataSource instanceof AbstractDataSource)
        {
            throw new \Exception("Missing DataSource with key: $dataSourceKey");
        }
        
        return $dataSource->data();
    }
}
