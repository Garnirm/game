<?php

namespace App\Actions\Building;

use App\Models\Building;
use App\Models\Job;
use App\Models\Pop;
use App\Models\Save;

class DetailsAction
{
    public function execute(array $params): array
    {
        $save = Save::find($params['save_id']);

        if (!$save) {
            abort(404);
        }

        $building = Building::query()->where('save_id', $save->id)->where('id', $params['building_id'])->first();

        if (!$building) {
            abort(404);
        }

        $building->living_pops = Pop::where('building_id', $building->id)
            ->get()
            ->mapWithKeys(function ($pop) {
                return [ $pop->class => $pop ];
            })
            ->toArray();

        $jobs = Job::query()
            ->where('save_id', $save->id)
            ->where('building_id', $building->id)
            ->toBase()
            ->get()
            ->map(function ($job) {
                $job->label = config('game_design.jobs.'.$job->type.'.label');

                return $job;
            })
            ->toArray();

        return [
            'success' => true,
            'data' => [
                'building' => $building,
                'jobs' => $jobs,
            ],
        ];
    }
}