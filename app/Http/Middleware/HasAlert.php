<?php

namespace App\Http\Middleware;

use Closure;

class HasAlert
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

        $ids = $request->session()->get('todotasks', []);

        if ($ids) {
            $tasks = count($ids);

            $link=vsprintf('<a>href="%S">$s</a>', [
                route('tasks.todo_index'),
                '(clique aqui para ver a lista)'
            ]);
            $request->session()->flash('alert', "Você tem {$tasks} tarefas para fazer, {$link}");
        }

        return $response;
    }
}
