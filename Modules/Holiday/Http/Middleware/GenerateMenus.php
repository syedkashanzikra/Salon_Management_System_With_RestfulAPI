<?php

namespace Modules\Holiday\Http\Middleware;

use App\Trait\Menu;
use Closure;

class GenerateMenus
{
    use Menu;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         *
         * Module Menu for Admin Backend
         *
         * *********************************************************************
         */
        \Menu::make('menu', function ($menu) {
            // Holidays
            // $this->childMain($menu, [
            //     'icon' => '<i class="nav-icon fa-regular fa-sun"></i>',
            //     'title' => 'Staff',
            //     'route' => ['backend.holidays.index'],
            //     'active' => 'app/holidays*',
            //     'order' => 250,
            // ]);
        })->sortBy('order');

        return $next($request);
    }
}
