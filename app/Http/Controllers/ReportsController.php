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
    public function index()
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
       
       return view('posts.reports', compact('staff_options', 'staff_id', 'posts','total' ,'media_mention', 'presentation', 'meeting', 'testimonial', 'sponsored_event', 'on_campus_collaboration', 'off_campus_collaboration', 'achievement', 'satifaction_survey', 'other', 'today'));       
       
       
    }



}
