<?php

namespace App\Http\Middleware;


use Closure;
use Sentinel;
use Redirect;
use App\Post;


class OwnerMiddleware
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


		
		// To be sure you are requesting the correct name I suggest you run php artisan route:list to
		// look for what Laravel has named the route parameter (when you are using Route::resource)
		$postId = $request->posts;
		//$postId = $id;
		
		


		
		
		// I don't like using segments, but this works too
		// example url /manage/posts/4/edit 
		// 0 = manage / 1 = posts / 2 = 4
		//$postId = $request->segments()[2];

		$post = Post::findOrFail($postId);

		 

		
		

		$user = Sentinel::getUser();
		$admin = Sentinel::findRoleByName('Admins');
		
		
		
		if (($post->user_id !== $user->id) || ($user->inRole($admin))){
		    //abort(403, 'Unauthorized action.');
		    return Redirect::route('manage.posts.index')->with('warning', 'You cannot edit an entry you did not create'); 
		}
		
		return $next($request);    
    }
    

    
    
}