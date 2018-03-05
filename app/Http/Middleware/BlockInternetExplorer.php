<?php

namespace App\Http\Middleware;

use Closure;

class BlockInternetExplorer
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
        preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
        if(count($matches)<2){
          preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
        }

        if (count($matches) > 1 && $matches[1] <= 11){
            echo "<h3 style='text-align:center;font-family:sans-serif'>Este navegador não é compatível com o ".env('APP_NAME_SHORT_1')." Por favor, utilize o <a href='https://www.mozilla.org/pt-BR/firefox/new/'>Mozilla Firefox</a> ou o <a href='https://www.google.com/chrome/browser/desktop/index.html'>Google Chrome</a></h3>";
            die;
        }

        return $next($request);
    }
}
