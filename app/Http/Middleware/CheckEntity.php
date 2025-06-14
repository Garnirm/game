<?php

namespace App\Http\Middleware;

use App\Exceptions\EntityNotFound;
use App\Exceptions\RouteParameterNotFound;
use App\Services\SingleModel\AccountSingle;
use Illuminate\Http\Request;

class CheckEntity
{
    public function handle(Request $request, \Closure $next)
    {
        $account_id = AccountSingle::id();

        $config = config('route_parameters');
        $parameters = $request->route()->parameters();

        foreach ($parameters as $parameter => $value) {
            if (!isset($config[ $parameter ])) {
                throw new RouteParameterNotFound('Route parameter '.$parameter.' not configured.');
            }

            $entity = $config[ $parameter ]::query()->account($account_id)->where('id', $value)->first();

            if (is_null($entity)) {
                log_user_error([ 'account_id' => $account_id, $parameter => $value, 'route' => url()->current(), 'step' => $parameter.'_not_exists' ]);

                throw new EntityNotFound();
            }

            $request->route()->setParameter($parameter, $entity);
        }

        return $next($request);
    }
}
