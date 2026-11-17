<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LegacyDeprecationHeaders
{
    /**
     * Attach standard RFC 8594 deprecation & sunset headers without mutating legacy JSON bodies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (isset($response->headers)) {
            $response->headers->set('Deprecation', 'true');
            $response->headers->set('Sunset', 'Sun, 01 Aug 2027 00:00:00 GMT');
            $response->headers->set('Link', '<https://aloc.com.ng/docs/migration>; rel="successor-version"');
            $response->headers->set('X-ALOC-Upgrade', 'Migrate to ALOC Station v1 (https://aloc.com.ng/docs/migration) before Aug 1, 2027');
        }

        return $response;
    }
}
