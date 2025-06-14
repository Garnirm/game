<?php

namespace App\Http\Requests\Save;

use App\Http\Requests\BaseRequest;

class RetrieveRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'save_id' => [ 'required', 'string' ],
        ];
    }
}
