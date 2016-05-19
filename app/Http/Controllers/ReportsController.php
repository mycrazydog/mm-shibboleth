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

use Sentinel;

use Carbon\Carbon;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Form;
use View;
use DB;
use Excel;

class ReportsController extends Controller
{
    protected $post;
      public function __construct(Post $post)
      {
          $this->post = $post;
          $this->middleware('admin', ['only' => 'destroy']);
      }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function staffIndex()
    {
        //
        $staff_options = Staff::select('Id', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->orderBy('first_name')->lists('full_name', 'Id');
        
        $print = Input::get('print');
        $staff_id = Input::get('staff_id');
        
       if($staff_id){      
       	$staff = Staff::find($staff_id);
       	$posts = $staff->posts;       	 
       	 
   	 	$media_mention = $staff->posts->sum('media_mention');
   	 	$presentation = $staff->posts->sum('presentation');
   	 	$meeting = $staff->posts->sum('meeting');
   	 	$testimonial = $staff->posts->sum('testimonial');
   	 	$sponsored_event = $staff->posts->sum('sponsored_event');
   	 	$on_campus_collaboration = $staff->posts->sum('on_campus_collaboration');
   	 	$off_campus_collaboration = $staff->posts->sum('off_campus_collaboration');
   	 	$achievement = $staff->posts->sum('achievement');
   	 	$satifaction_survey = $staff->posts->sum('satifaction_survey');
   	 	$other = $staff->posts->sum('other');
   	 	$total = $staff->posts->count();
   	 	$today = Carbon::now();
       	         
       }else{
       	
       	$posts = Post::orderBy('created_at', 'DESC')->get();
       	
       	$media_mention = DB::table('posts')->sum('media_mention');
       	$presentation = DB::table('posts')->sum('presentation');
       	$meeting = DB::table('posts')->sum('meeting');
       	$testimonial = DB::table('posts')->sum('testimonial');
       	$sponsored_event = DB::table('posts')->sum('sponsored_event');
       	$on_campus_collaboration = DB::table('posts')->sum('on_campus_collaboration');
       	$off_campus_collaboration = DB::table('posts')->sum('off_campus_collaboration');
       	$achievement = DB::table('posts')->sum('achievement');
       	$satifaction_survey = DB::table('posts')->sum('satifaction_survey');
       	$other = DB::table('posts')->sum('other');
       	$total = DB::table('posts')->count();
       	$today = Carbon::now();
       	
       }
        
       if($print){
       		return view('print', compact('posts','total' ,'media_mention', 'presentation', 'meeting', 'testimonial', 'sponsored_event', 'on_campus_collaboration', 'off_campus_collaboration', 'achievement', 'satifaction_survey', 'other', 'today'));
       }
       
       return view('posts.report_staff', compact('staff_options', 'staff_id', 'posts','total' ,'media_mention', 'presentation', 'meeting', 'testimonial', 'sponsored_event', 'on_campus_collaboration', 'off_campus_collaboration', 'achievement', 'satifaction_survey', 'other', 'today'));       
       
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function categoryIndex()
    {
        //
        $staff_options = Staff::select('Id', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->orderBy('first_name')->lists('full_name', 'Id')->toArray();
              	
       //$posts =  Post::all(); 
       
       	$posts =  Post::with(array('departments' => function($query)
       	{
       	    $query->addSelect(array('name'));
       	}))->with(array('staffs' => function($query)
       	{
       	    $query->addSelect(array(DB::raw("concat(staff.first_name, ' ', staff.last_name) as `name`")));
       	}));
       	
       	$posts = $posts->get();	
       	
       	      
       return view('posts.report_category', compact('posts', 'staff_options'))->withInput(Input::all()); 
 
       
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postCategory(Request $request)
    {
    	       	
    	       	
    	       	Input::flash();
    	       	
    	       	$detail = Input::get('detail');
    	       	
    	       	$staff_options = Staff::select('Id', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->orderBy('first_name')->lists('full_name', 'Id')->toArray();
    	       		    	       	    	       	
    	       	$posts =  Post::with(array('departments' => function($query)
    	       	{
    	       	    $query->addSelect(array('name'));
    	       	}))->with(array('staffs' => function($query)
	       		{
	       		    $query->addSelect(array(DB::raw("concat(staff.first_name, ' ', staff.last_name) as `name`")));
	       		}));	

	

	

    	           	
    			if(Input::has('media_mention'))
    			{
    				$posts = $posts->mediamention();			
    			} 
    			if(Input::has('presentation'))
    			{
    				$posts = $posts->presentation();			
    			} 
    			if(Input::has('meeting'))
    			{
    				$posts = $posts->meeting();			
    			} 
    			if(Input::has('testimonial'))
    			{
    				$posts = $posts->testimonial();			
    			} 
    			if(Input::has('sponsored_event'))
    			{
    				$posts = $posts->sponsoredevent();			
    			} 
    			if(Input::has('on_campus_collaboration'))
    			{
    				$posts = $posts->orWhere('on_campus_collaboration', 1);			
    			} 
    			if(Input::has('off_campus_collaboration'))
    			{
    				$posts = $posts->offcampuscollaboration();			
    			} 
    			if(Input::has('achievement'))
    			{
    				$posts = $posts->achievement();			
    			} 
    			if(Input::has('satifaction_survey'))
    			{
    				$posts = $posts->satifactionsurvey();			
    			} 
    			if(Input::has('other'))
    			{
    				$posts = $posts->orWhere('other', 1);			
    			} 
    			
    			if(Input::has('staff'))
    			{
    				if(Input::get('staff') != 0)
    				{    				
	    				$posts = $posts->whereHas('staffs', function ($query) {
	    				   $query->where('id', '=', Input::get('staff'));
	    				});	
    				}
    			} 
    			

    			
    			if((Input::has('publish_date_from')) || (Input::has('publish_date_to')))
    			{
    				
    				$from = date('Y-m-d', strtotime(Input::get('publish_date_from')));
    				
    				if(Input::has('publish_date_to'))
    				{
    					$to = date('Y-m-d', strtotime(Input::get('publish_date_to')));
    				}else{
    					$to = date('Y-m-d', strtotime(Carbon::now()));
    				}
    				
    				
    				
    			    $posts = $posts->whereBetween('publish_date', array($from, $to));		
    			}   			
    			
    	
    			$posts = $posts->get();
    			
    			
    				
    				//dd($posts);   			
    				
    			
    			/*$posts = $posts->with(['departments' => function($query) {
    				    $query->select('name');
    				}])->get();*/
    			
    						
      			
    			// I do this mapping to flatten the nested arrays
    		
//    			$posts = array_map(function($val)
//    			    {
//    			      return array_dot($val);
//    			    }, $posts);



    				       	
    			
    			
    			$action = Input::get('action', 'none');
    			
    			if($action=='query'){
    			   
    			   return view('posts.report_category', compact('posts', 'staff_options', 'detail'))->withInput(Input::all()); 
    			   
    			}else if($action=='excel'){

					
					if($detail == 1){
						Excel::create('Export', function($excel) use($posts) {
						    $excel->sheet('Data', function($sheet) use($posts) {
						        //$sheet->fromArray($posts);   
						        $sheet->loadView('posts.category_full')->with('posts', $posts); 					        
						    });
						})->export('xls');
					}else{					
						Excel::create('Export', function($excel) use($posts) {
						    $excel->sheet('Data', function($sheet) use($posts) {
						        //$sheet->fromArray($posts);   
						        $sheet->loadView('posts.category')->with('posts', $posts); 					        
						    });
						})->export('xls');				
					}

    			}
    			
    			 
    			
    			/*
    			Excel::create('posts', function($excel) use($posts) {
    			    $excel->sheet('Category', function($sheet) use($posts) {
    			        $sheet->fromArray($posts);
    			    });
    			})->export('xls');
    			
    			*/
    
    }
    
    
}