<?php

namespace App\Http\Middleware;

use App\Modules\Manage\ManagerModel;
use Closure;
use Illuminate\Support\Facades\Session;

class ManageAuth
{


    
    public function handle($request, Closure $next)
    {
        if (!Session::get('manager')) {
            Session::put('url.intended', \URL::full());
            return redirect('/manage/login');
        } 

        return $next($request);
    }
}
