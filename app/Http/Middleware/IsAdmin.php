<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //เรียกใช้ auth() แล้วไปเรียกใช้ user() และเข้าไปที่ is_admin เพื่อเข้าไปเช็คว่ามันเท่ากับ 1 หรือไม่ ถ้าเท่ากับ 1 จะทำการ return request ไป
        //ถ้าไม่ใช่ 1 จะทำการ ทำการ redirect ไปที่หน้า home
        if(auth()->user()->is_admin == 1){
            return $next($request);
        }

        return redirect('home')->with('error',"You don't have admin access.");
    }
}