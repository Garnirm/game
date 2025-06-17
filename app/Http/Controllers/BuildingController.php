<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class BuildingController extends BaseController
{
    protected string $actions_path = 'App\Actions\Building';
    protected string $dtos_path = 'App\Dtos\Building';
    protected string $requests_path = 'App\Http\Requests\Building';
}
