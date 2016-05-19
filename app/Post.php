<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    
    //https://laracasts.com/discuss/channels/general-discussion/form-model-binding-date-carbon
    
	function getPublishDateAttribute($attr)
	{
	   if (!is_null($attr))
	   {
	    return date("m/d/Y", strtotime($attr));
	   }
	}
	
	
	/**
	 * Return the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
	    return $this->belongsTo('App\User', 'user_id');
	    
	    //$user_id = $this->user_id;	    
	    //$user_email = User::findOrFail($user_id);    
	    //return $user_email;
	}
	
	
	/**
	 * Get the staffs for the post
	 */
	public function staffs(){
		
		return $this->belongsToMany('App\Staff');
		
	}
	
	/**
	 * Get the departments for the post
	 */
	public function departments(){
		
		return $this->belongsToMany('App\Department', 'post_department', 'post_id', 'department_id');
		
	}
	
	/**
	 * Get the staffs for the post
	 */
	public function sources(){
		
		return $this->belongsToMany('App\Source');
		
	}
	
	
	
	
	 	
	public function scopeMediaMention($query)
	{
	    return $query->orWhere('media_mention', 1);
	}	
	public function scopePresentation($query)
	{
	    return $query->orWhere('presentation', 1);
	}	
	public function scopeMeeting($query)
	{
	    return $query->orWhere('meeting', 1);
	}  
	public function scopeTestimonial($query)
	{
	    return $query->orWhere('testimonial', 1);
	}   
	public function scopeSponsoredEvent($query)
	{
	    return $query->orWhere('sponsored_event', 1);
	} 
	public function scopeOnCampusCollaboration($query)
	{
	    return $query->orWhere('on_campus_collaboration', 1);
	}    
	public function scopeOffCampusCollaboration($query)
	{
	    return $query->orWhere('off_campus_collaboration', 1);
	}       
    public function scopeAchievement($query)
    {
        return $query->orWhere('achievement', 1);
    } 
    public function scopeSatifactionSurvey($query)
    {
        return $query->orWhere('satifaction_survey', 1);
    }      
    public function scopeOther($query)
    {
        return $query->orWhere('other', 1);
    }   
}
