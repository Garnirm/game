<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        $errors = array_merge([ 'namespace' => get_called_class() ], $validator->errors()->all());

        if (config('app.env') !== 'testing') {
            Log::warning($errors);
        }

        throw new HttpResponseException(response()->json([ 'success' => false ], 422));
    }
}
