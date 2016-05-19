<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Requests\PostsFormRequest;
use Illuminate\Http\Request;

use App\Post;
use App\Department;
use App\Project;
use App\Source;
use App\Staff;
use App\User;

use Sentinel;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Form;
use View;
use DB;

class PostsController extends Controller
{
    
    protected $post;
      public function __construct(Post $post)
      {
          $this->post = $post;
          $this->middleware('admin', ['only' => 'destroy']);
          $this->middleware('owner', ['only' => 'update']);
      }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        //$posts = Post::select('id', 'headline')->orderBy('created_at', 'DESC')->get(); 
        
        // Get this post comments
        //$posts = $this->post->select('id', 'headline')->orderBy('created_at', 'DESC')->get();
        
        
		$posts = Post::join('users', function ($join) {
		            $join->on('posts.user_id', '=', 'users.id');
		        })->select('posts.id', 'posts.headline', DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'), 'posts.publish_date')->orderBy('posts.publish_date', 'DESC')
		        ->get();
        
        
        return view('posts.index', compact('posts'));
        
        /*
        if(Sentinel::getUser()->inRole('admins')) {      
        	$posts = $this->post->orderBy('created_at', 'DESC')->paginate(25); 
        }else{        
	        $user = Sentinel::getUser()->id;
	        $posts = $this->post->where('user_id', $user)->orderBy('created_at', 'DESC')->paginate(25);
        }
        */
        
        //return view('posts.index', compact('posts'));
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        //Populate the select(dropdowns)
        $department_options = Department::lists('name', 'id');
        //dd($department_options);
        
        //$project_options = Project::lists('name', 'id');
        $source_options = Source::lists('name', 'id');        
        $staff_options = Staff::select('Id', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->orderBy('first_name')->lists('full_name', 'Id');
        
        // Show the page
        return view('posts.forms.create', compact('department_options','source_options', 'staff_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PostsFormRequest $request)
    {
        //
        $user = Sentinel::getUser()->id;
        
        $post = new Post;
        //$post -> user_id = Auth::id();
        $post -> user_id = $user;
        $post -> headline = $request->headline;
        $post -> media_mention = (\Input::get('media_mention') == 1) ? 1 : 0;
        $post -> presentation = (\Input::get('presentation') == 1) ? 1 : 0;
        $post -> meeting = (\Input::get('meeting') == 1) ? 1 : 0;
        $post -> sponsored_event = (\Input::get('sponsored_event') == 1) ? 1 : 0;
        $post -> on_campus_collaboration = (\Input::get('on_campus_collaboration') == 1) ? 1 : 0;
        $post -> off_campus_collaboration = (\Input::get('off_campus_collaboration') == 1) ? 1 : 0;
        $post -> development = (\Input::get('development') == 1) ? 1 : 0;
        $post -> satifaction_survey = (\Input::get('satifaction_survey') == 1) ? 1 : 0;
        $post -> achievement = (\Input::get('achievement') == 1) ? 1 : 0;
        $post -> testimonial = (\Input::get('testimonial') == 1) ? 1 : 0;
        $post -> other = (\Input::get('other') == 1) ? 1 : 0;
        $post -> other_desc = $request->other_desc;   
		//$post -> source_id = ($request->source_id == null) ? null : $request->source_id;
		$post -> publish_date = ($request->publish_date == null) ? null : date('Y-m-d', strtotime($request->publish_date));;    
		$post -> writer_collaborator = $request->writer_collaborator;
		//$post -> department_id = ($request->department_id == null) ? null : $request->department_id;
		//$post -> project_id = ($request->project_id == null) ? null : $request->project_id;
        $post -> notes = $request->notes;
        $post -> url = $request->url;
        

        
    
		if ($request->file('attachment')) {
			$file = $request->file('attachment');
			$filename = $file->getClientOriginalName();
			$extension = $file -> getClientOriginalExtension();
			$name = $user . '-' . time() . '-' . str_slug($filename, "-") . '.' .$extension;			
			//$file = $file->move('/var/www/vhosts/lgscharlotte.org/private/uploads/', $name);
			$file = $file->move(public_path() . '/resources/', $name);		
			$post->attachment = $name;
		}	
	
        
        
        
//        $attachment = "";
//        if(Input::hasFile('attachment'))
//        {
//            $file = Input::file('attachment');
//            $filename = $file->getClientOriginalName();
//            $extension = $file -> getClientOriginalExtension();
//            $picture = sha1($filename . time()) . '.' . $extension;
//        }
//        $post -> attachment = $attachment;
        
        

        
        $post -> save();
        
        
        if (Input::get('staff_list')) {
        	$post->staffs()->attach(Input::get('staff_list'));  
        }
        
        if (Input::get('department_list')) {
        	$post->departments()->attach(Input::get('department_list'));  
        } 
        
        if (Input::get('source_list')) {
        	$this->syncSources($post, $request);	   
        }
//        // Move the files
//        if(Input::hasFile('attachment'))
//        {
//            $destinationPath = public_path() . '/resources/'.$post->id.'/';
//            Input::file('attachment')->move($destinationPath, $attachment);
//        }
        
       
        if($request->submitVal){
        	return \Redirect::route('manage.posts.create', array($post->id))
            ->with('success', 'Your post has been created!');
        }else{
			return \Redirect::route('manage.posts.index', array($post->id))
			->with('success', 'Your post has been created!');        
        }           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        
        //Populate the select(dropdowns)
        
        //$department_options = Department::lists('name', 'id');
        //$department_id = $post->department_id;
        $department_options = Department::lists('name', 'id');        
        $department_selected = $post->departments->lists('id');
        
        
                      
        
        //$project_options = Project::lists('name', 'id');
        //$project_id = $post->project_id;
        
        $source_options = Source::lists('name', 'id');
        $source_selected = $post->sources->lists('id');
        
        $staff_options = Staff::select('Id', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->orderBy('first_name')->lists('full_name', 'Id');  
        $staff_selected =  $post->staffs->lists('id');
        
        // Show the page        
        return view('posts.forms.edit',compact('post','department_options','department_selected','source_options','source_selected', 'staff_options', 'staff_selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PostsFormRequest $request, $id)
    {
        
        $user = Sentinel::getUser()->id;
        
        //
        $post = Post::findOrFail($id);
	    //$post -> user_id = Auth::id();	    
	    //$post -> user_id = $user;
	    
	    //get the user who updates, not creates
	    $post -> user_id_updater = $user;
	    $post -> headline = $request->headline;
	    $post -> media_mention = (\Input::get('media_mention') == 1) ? 1 : 0;
	    
	    // This would work too
	    //($request->get('due') == null) ? 1 : 0;	    
	    
	    $post -> presentation = (\Input::get('presentation') == 1) ? 1 : 0;
	    $post -> meeting = (\Input::get('meeting') == 1) ? 1 : 0;
	    $post -> sponsored_event = (\Input::get('sponsored_event') == 1) ? 1 : 0;
	    $post -> on_campus_collaboration = (\Input::get('on_campus_collaboration') == 1) ? 1 : 0;
	    $post -> off_campus_collaboration = (\Input::get('off_campus_collaboration') == 1) ? 1 : 0;
	    $post -> development = (\Input::get('development') == 1) ? 1 : 0;
	    $post -> satifaction_survey = (\Input::get('satifaction_survey') == 1) ? 1 : 0;
	    $post -> achievement = (\Input::get('achievement') == 1) ? 1 : 0;
	    $post -> testimonial = (\Input::get('testimonial') == 1) ? 1 : 0;
	    $post -> other = (\Input::get('other') == 1) ? 1 : 0;
	    $post -> other_desc = $request->other_desc;
	    
	    //$post -> source_id = ($request->source_id == null) ? null : $request->source_id;	    
	    $this->syncSources($post, $request);	    
	    	    
        $post -> publish_date = ($request->publish_date == null) ? null : date('Y-m-d', strtotime($request->publish_date));;    
	    $post -> writer_collaborator = $request->writer_collaborator;
	    //$post -> department_id = ($request->department_id == null) ? null : $request->department_id;
	    //$post -> project_id = ($request->project_id == null) ? null : $request->project_id;
	    $post -> notes = $request->notes;
	    $post -> url = $request->url;
	    
	    
	    
	     //Add this additional check. If input tag is null then empty array is used. Needed for sync()
	    //$tags = $this->request->input('tags', []);
	    
	    $staffs = Input::get('staff_list', []);
	    $post->staffs()->sync($staffs);   

    	$departments =  Input::get('department_list', []);
    	$post->departments()->sync($departments);  
   
	     
	
//	    $attachment = "";
//	    if(Input::hasFile('attachment'))
//	    {
//	        $file = Input::file('attachment');
//	        $filename = $file->getClientOriginalName();
//	        $extension = $file -> getClientOriginalExtension();
//	        $picture = sha1($filename . time()) . '.' . $extension;
//	    }
//	    $post -> attachment = $attachment;

		if ($request->file('attachment')) {
			$file = $request->file('attachment');
			$filename = $file->getClientOriginalName();
			$extension = $file -> getClientOriginalExtension();
			$name = $user . '-' . time() . '-' . str_slug($filename, "-") . '.' .$extension;			
			//$file = $file->move('/var/www/vhosts/lgscharlotte.org/private/uploads/', $name);
			$file = $file->move(public_path() . '/resources/', $name);		
			$post->attachment = $name;
		}		


	    $post -> save();

	    
	    
 
	    
	    
	    
	    
	    
//	    if(Input::hasFile('attachment'))
//	    {
//	        $destinationPath = public_path() . '/resources/'.$post->id.'/';
//	        Input::file('attachment')->move($destinationPath, $attachment);
//	    }
	         
	    if($request->submitVal){
	    	return \Redirect::route('manage.posts.create', array($post->id))
	        ->with('success', 'Your post has been created!');
	    }else{
	    	return \Redirect::route('manage.posts.index', array($post->id))
	    	->with('success', 'Your post has been created!');        
	    }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();
        return \Redirect::route('manage.posts.index')->with('warning', 'Your post has been deleted!');
    }
    
    
    /**
     * This is used to add NEW sources not already in our sources table
     *
     */
    private function syncSources($post, $request)
    {
        if (!$request->has('source_list'))
        {
            $post->sources()->detach();
            return;
        }
    
        $allSourceIds = array();
    
        foreach ($request->source_list as $sourceId)
        {
            if (substr($sourceId, 0, 4) == 'new:')
            {
                $newSource = Source::create(['name' => substr($sourceId, 4)]);
                $allSourceIds[] = $newSource->id;
                continue;
            }
            $allSourceIds[] = $sourceId;
        }
    
        $post->sources()->sync($allSourceIds);
    }
}
