<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (app()->environment('local')) {
            $log = [
                'url'          => $request->getUri(),
                'user_id'      => $request->has('partner_id') ? $request->partner_id : null,
                'request_body' => json_encode($request->all()),
                'response'     => $response->getContent(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now()
            ];
            DB::beginTransaction();
            try {
                DB::table('loggers')->insert($log);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $logging = [
                    'url'           => $log['url'] ?? null,
                    'error_message' => $e->getMessage(),
                    'request_body'  => $log['request_body'] ? json_encode($log['request_body']) : null,
                    'response'      => $log['response'] ?? null
                ];
                Log::channel('logger')->warning($logging);
            }
        }
        return $response;
    }
}
