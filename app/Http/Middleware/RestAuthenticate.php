<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiUser;
use App\Http\Traits\ApiResponse;


class RestAuthenticate
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $basic_access_token = $request->header('Authorization');

        if ($basic_access_token) {

            $access_tokenAr = explode(' ', $basic_access_token); // "Basic token_string"

            $access_token = $access_tokenAr[1]; // "token_string"

            $base64_decode = base64_decode($access_token);

            $login_cred = explode(':', $base64_decode);

            if (!isset($login_cred[0]) || !isset($login_cred[1])) {
                return $this->responseError('-1011','Login or password is incorrect!');
            }

            $login = $login_cred[0];

            $password = $login_cred[1];

            $user = ApiUser::active()
                ->where([['login', '=', $login], ['password', '=', $password]])
                ->first();

            if (!$user) {
                return $this->responseError('-1012','Your account is not active or blocked!');
            }
            $user_id = $user->id;

            $request->merge(['user_id' => $user_id]);

        } else {
            return $this->responseError('-1011','Authorization in header is required!');
        }
        return $next($request);
    }
}
