<?php

namespace App\Http\Requests\Save;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'people_name' => [ 'required', 'string' ],
            'save_name' => [ 'required', 'string' ],
            'difficulty' => [ 'required', Rule::in([ 'easy', 'normal', 'hard' ]) ],
            'territory_growth' => [ 'required', Rule::in([ 'slow', 'normal', 'fast' ]) ],

            'wealth_resources' => [ 'required', 'string' ],
            'ia_density' => [ 'required', 'string' ],
            'initial_proximity' => [ 'required', 'string' ],
            'map_seed' => [ 'sometimes', 'nullable', 'string' ],

            'first_city_name' => [ 'required', 'string' ],
            'player_trait_points' => [ 'required', 'integer' ],
            'ia_trait_points' => [ 'required', 'integer' ],
        ];
    }
}
