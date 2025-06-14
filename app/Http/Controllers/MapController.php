<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class MapController extends BaseController
{
    protected string $actions_path = 'App\Actions\Map';
    protected string $dtos_path = 'App\Dtos\Map';
    protected string $requests_path = 'App\Http\Requests\Map';
}
