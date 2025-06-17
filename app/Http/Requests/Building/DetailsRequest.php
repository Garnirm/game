<?php

namespace App\Http\Requests\Building;

use App\Http\Requests\BaseRequest;

class DetailsRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'save_id' => [ 'required', 'string' ],
            'building_id' => [ 'required', 'string' ],
        ];
    }
}
