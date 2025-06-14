<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

abstract class BaseController extends Controller
{
    protected string $actions_path;
    protected string $dtos_path;
    protected string $requests_path;

    public function __call($function, $args = null)
    {
        $action_class = $this->actions_path.'\\'.ucfirst($function).'Action';
        $request_class = $this->requests_path.'\\'.ucfirst($function).'Request';
        $dto_class = $this->dtos_path.'\\'.ucfirst($function).'Dto';

        $validated_parameters = [];

        if ($this->isClassExists($request_class)) {
            $validated_parameters = app($request_class)->validated();
        }

        if ($this->isClassExists($dto_class)) {
            $dto = app($dto_class, $validated_parameters + request()->route()->parameters());

            $action = app($action_class)->execute($dto);
        } else {
            $action = app($action_class)->execute($validated_parameters);
        }

        return $this->respond($action);
    }

    protected function respond(array $action): JsonResponse
    {
        $status = (isset($action['status'])) ? $action['status'] : 200;

        return response()->json([
            'success' => $action['success'],
            'data' => $action['data'] ?? null,
            'errors' => $action['errors'] ?? [],
        ], $status);
    }

    private function isClassExists(string $namespace): bool
    {
        $namespace_format = Str::of($namespace)->lcfirst()->replace('\\', '/')->append('.php');

        if (!File::exists(base_path($namespace_format))) {
            return false;
        }

        return class_exists($namespace);
    }
}
