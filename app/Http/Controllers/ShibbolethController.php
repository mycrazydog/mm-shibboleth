<?php
namespace App\Http\Controllers;

use Illuminate\Auth\GenericUser;

use Auth;
use Config;
use Request;
use Redirect;
use Session;
use View;

use Sentinel;

class ShibbolethController extends Controller
{

    /**
     * Constructor
     */
    public function __construct(GenericUser $user = null)
    {
        $this->user = $user;
    }

    /**
     * Create the session, send the user away to the IDP
     * for authentication.
     */
    public function create()
    {
    	// goes to https://mysite.info:443/Shibboleth.sso/Login
    	// with the target idpAuthorize after Shibboleth has successfully authenticated
    	return Redirect::to('https://' . Request::server('SERVER_NAME') . ':' . Request::server('SERVER_PORT') . config('shibboleth.idp_login') . '?target=' . action('ShibbolethController@idpAuthorize'));
    }

    /**
     * Login for users not using the IdP.
     */
/*     
    public function localCreate()
    {
        return $this->viewOrRedirect(config('shibboleth.local_login'));
    }
*/    

    /**
     * Setup authorization based on returned server variables
     * from the IdP.
     */
    public function idpAuthorize()
    {
       $email = $this->getServerVariable(config('shibboleth.idp_login_email'));
       $first_name = $this->getServerVariable(config('shibboleth.idp_login_first'));
       $last_name  = $this->getServerVariable(config('shibboleth.idp_login_last'));
       $password = str_random(100);
       


        if ($email) {
        	 $credentials = [ 'email' => $email];

        	$user = Sentinel::findByCredentials($credentials); 
        	
        	if($user){        		
        		Sentinel::login($user);	        	
        	}else{
        		// unable to find user, so now we check to see if new users are allowed to be added        	
        		if (config('shibboleth.add_new_users', true)) {
        			// Add New user
        			$params = ['email' => $email, 'password' => $password, 'first_name' => $first_name, 'last_name' => $last_name];         			
        			$user = Sentinel::registerAndActivate($params);        			
        			// User starts as role: standard user
        			$account_type = 1;
        			// Find the role using the role name
        			$role = Sentinel::findRoleById($account_type);	
        			// Assign the role to the users 	        			
        			$role->users()->attach($user);    
        			
        			Session::put('auth_type', 'idp');    			
        			return \Redirect::route('manage.posts.index')
        			    ->with('success', 'User (and password) has been created successfully!');      			
        		}    		
        		return \Redirect::route('home')
        		    ->with('warning', 'We are not accepting new users at this time');         		       	
        	}				
			Session::put('auth_type', 'idp');
            return $this->viewOrRedirect(config('shibboleth.shibboleth_authenticated'));

        } else {             
            return $this->viewOrRedirect(config('shibboleth.login_fail'));
        }
    }
    
    /**
     * Get current information about the session.
     */
    public function session()
    {
        echo 'Logged In: ' . ((Sentinel::check()) ? 'yes' : 'no') . '<br /><br/>';
        echo '<br/><br/>Session Information: <br /><pre>' . var_dump(Session::all()). '</pre><br/><br/>'. phpinfo();
    }

    /**
     * Wrapper function for getting server variables.
     * Since Shibalike injects $_SERVER variables Laravel
     * doesn't pick them up. So depending on if we are
     * using the emulated IdP or a real one, we use the
     * appropriate function.
     */
    private function getServerVariable($variableName)
    {

            $nonRedirect = Request::server($variableName);
            $redirect    = Request::server('REDIRECT_' . $variableName);
            return (!empty($nonRedirect)) ? $nonRedirect : $redirect;
    }

    /*
     * Simple function that allows configuration variables
     * to be either names of views, or redirect routes.
     */
    private function viewOrRedirect($view)
    {
        return (View::exists($view)) ? view($view) : Redirect::to($view);
    }
}
