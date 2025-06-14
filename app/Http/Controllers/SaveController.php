<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class SaveController extends BaseController
{
    protected string $actions_path = 'App\Actions\Save';
    protected string $dtos_path = 'App\Dtos\Save';
    protected string $requests_path = 'App\Http\Requests\Save';
}
