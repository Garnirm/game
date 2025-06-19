<?php

namespace App\Http\Requests\Building;

use App\Http\Requests\BaseRequest;

class UpdateHousingRepartitionRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'save_id' => [ 'required', 'string' ],
            'building_id' => [ 'required', 'string' ],

            'housing_worker' => [ 'required', 'integer' ],
            'housing_specialist' => [ 'required', 'integer' ],
            'housing_engineer' => [ 'required', 'integer' ],
            'housing_elite' => [ 'required', 'integer' ],
        ];
    }
}
