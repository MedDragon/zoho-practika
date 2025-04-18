<?php

/**
 * TrustHosts Middleware
 *
 * This middleware is responsible for determining which host patterns
 * should be trusted for this application.
 *
 * @package App\Http\Middleware
 */

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }//end hosts()
}//end class
