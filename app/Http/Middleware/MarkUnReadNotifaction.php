<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkUnReadNotifaction
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('notify_admin') && auth('admin')->check()){

            $notifaction=auth('admin')->user()
            ->unreadNotifications()
            ->where('id',$request->query('notify_admin'))
            ->first();
            if($notifaction){
                $notifaction->markAsRead();
            }
        }
        return $next($request);
    }
}
