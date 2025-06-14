<?php

namespace App\Http\Requests\Map;

use App\Http\Requests\BaseRequest;

class TilesContentRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'save_id' => [ 'required', 'string' ],

            'x_max' => [ 'required', 'integer' ],
            'x_start' => [ 'required', 'integer' ],

            'y_max' => [ 'required', 'integer' ],
            'y_start' => [ 'required', 'integer' ],
        ];
    }
}
