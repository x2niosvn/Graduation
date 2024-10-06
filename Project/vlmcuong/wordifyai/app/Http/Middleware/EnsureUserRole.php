<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

//Thêm thư viện Auth
use Illuminate\Support\Facades\Auth;


class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        //check xem user đã đăng nhập chưa và role của user có trùng với role truyền vào không
        if(Auth::check() && Auth::user()->role_id == $role){
            return $next($request);
        }


        //nếu không thì trả về trang chủ
        return redirect('/dashboard');
        
    }
}
