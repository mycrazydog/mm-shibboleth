<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Request;
use Illuminate\Contracts\Auth\Guard;

class ShibboletAuthenticate
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
        
        
        //        
		//$email = $request->server->get('eppn');
		$email =  Request::server('eppn');        
		
		if($email){
			$credentials = [ 'email' => $email];        
			$user = Sentinel::findByCredentials($credentials);
			Sentinel::login($user);
		}
		
		/* 
		Lazy Session
		<Location />
		  AuthType shibboleth
		  ShibRequireSession off
		  require shibboleth
		</Location>		
		
		Non-Lazy Session		
		<Location />
		  AuthType shibboleth
		  ShibRequestSetting requireSession 1
		  require shib-session
		</Location>
		*/
    
        return $next($request);
    }
}
