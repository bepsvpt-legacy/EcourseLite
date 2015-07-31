<?php

namespace App\Http\Middleware;

use App\Ecourse\Core;
use Cache;
use Closure;

class CheckSessionValid
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
        if ((null === ($session = session('PHPSESSID'))) || (null === session('COOKIE')))
        {
            return redirect()->route('signIn');
        }
        else if ( ! $this->checkSessionValid($session))
        {
            return redirect()->route('signIn');
        }

        return $next($request);
    }

    public function checkSessionValid($session)
    {
        $content = Cache::remember($session, 24, function()
        {
            return getRequest(Core::COURSES);
        });

        if (false !== mb_strpos($content, '權限錯誤'))
        {
            return false;
        }

        session()->put('courseListsContent', $content);

        return true;
    }
}