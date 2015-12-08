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
		$posts = $this->post->orderBy('created_at', 'DESC')->get();

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

        return view('posts.reports', compact('posts','total' ,'media_mention', 'presentation', 'meeting', 'testimonial', 'sponsored_event', 'on_campus_collaboration', 'off_campus_collaboration', 'achievement', 'satifaction_survey', 'other', 'today'));
    }

        public function pagePrint()
        {
            //
    $posts = $this->post->orderBy('created_at', 'DESC')->get();

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

            return view('print', compact('posts','total' ,'media_mention', 'presentation', 'meeting', 'testimonial', 'sponsored_event', 'on_campus_collaboration', 'off_campus_collaboration', 'achievement', 'satifaction_survey', 'other', 'today'));
        }

}
