<?php

namespace App\Http\Middleware;

use Closure;
use Redis;

class PushRedis {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $redis = Redis::connection();
        $redis->publish('message', json_encode(\App\Push::jsonNotificacionesWeb()));
        return $next($request);
    }

}
