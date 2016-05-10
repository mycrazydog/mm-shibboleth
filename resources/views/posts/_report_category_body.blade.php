<section class='invoice'>

	<div class="row">
	{!! Form::open(array('action' => 'ReportsController@postCategory', 'method' => 'POST')) !!}
		  
        <div class="col-sm-12">             

          
		          <div class="form-group">
		          	<label>Category</label>	 
		          	 <a data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" 
		          	 data-content="Please select the category or categories for your entry. If none of the existing categories fit, click the box beside 'other' and type in your category.">
		          	 <span class="badge bg-blue"><i class="fa fa-info"></i></span>
		          	 </a>
		          	
		          	<p class="help-block">Select all that apply</p>
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('media_mention', 1) !!}
		          		  Media Mention
		          		</label>
		          	</div>
		          
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('presentation', 1) !!}
		          		  Presentation
		          		</label>
		          	</div>
		          
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('meeting', 1) !!}
		          		  Meeting
		          		</label>
		          	</div>
		          
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('sponsored_event', 1) !!}
		          		  Sponsored Event
		          		</label>
		          	</div>
		            
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('on_campus_collaboration', 1) !!}
		          		  On-Campus Collaboration
		          		</label>
		          	</div>
		          
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('off_campus_collaboration', 1) !!}
		          		  Off-Campus Collaboration
		          		</label>
		          	</div>   
		          
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('development', 1) !!}
		          		  Conference/Staff Development
		          		</label>
		          	</div>
		          
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('satifaction_survey', 1) !!}
		          		  Client Satisfaction Survey
		          		</label>
		          	</div>
		            
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('achievement', 1) !!}
		          		  Achievement
		          		</label>
		          	</div>
		          
		          	<div class="checkbox">
		          		<label>
		          		  {!! Form::checkbox('testimonial', 1) !!}
		          		  Testimonial/Accolades
		          		</label>
		          	</div> 

					<div class="checkbox">
						<label>
						  {!! Form::checkbox('other', 1) !!}						  
						  Other
						</label>
					</div> 	

		          </div>  
		          
		                
             
        </div>
        <div class="col-sm-12">
        
	        <div class="form-group">			
				{!! Form::label('staff', 'Institute Staff Involved') !!}  
				<a data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Select the name of the staff member involved">
					<span class="badge bg-blue"><i class="fa fa-info"></i></span>
				</a>
	 	          
				{!! Form::select('staff', (['0' => ''] + $staff_options), null, ['id' => 'staff','class' => 'form-control']) !!}
	        </div><!-- /.form-group -->
        	        
        </div>
        <div class="col-sm-6">
        	<div class="form-group">
        	  {!! Form::label('publish_date', 'Publish date/Event date ') !!}  
        	  <a data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Enter the date of the media mention.">
        	  	<span class="badge bg-blue"><i class="fa fa-info"></i></span>
        	  </a>
        	  
        	  <div class="input-group">
        	    <div class="input-group-addon">
        	      <i class="fa fa-calendar"></i>
        	    </div>
        	   
        	    {!! Form::text('publish_date_from', null, ['class' => 'form-control reservation']) !!}
        	  </div><!-- /.input group -->
        	</div><!-- /.form group -->
        </div> 
        <div class="col-sm-6">
        	<div class="form-group">
        	  {!! Form::label('publish_date', 'Publish date/Event date ') !!}  
        	  <a data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Enter the date of the media mention.">
        	  	<span class="badge bg-blue"><i class="fa fa-info"></i></span>
        	  </a>
        	  
        	  <div class="input-group">
        	    <div class="input-group-addon">
        	      <i class="fa fa-calendar"></i>
        	    </div>
        	   
        	    {!! Form::text('publish_date_to', null, ['class' => 'form-control reservation']) !!}
        	  </div><!-- /.input group -->
        	</div><!-- /.form group -->
        </div>  
        
        
        <div class="col-sm-6">  <button type="submit" name="action" value="query" class="btn btn-info pull-right btn-block btn-lg"><i class="fa fa-database" aria-hidden="true"></i>&nbsp;&nbsp;Query</button> </div>
        <div class="col-sm-6">  <button type="submit" name="action" value="excel" class="btn btn-info pull-right btn-block btn-lg"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Export To Excel</button> </div>
        

	{!! Form::close() !!}		
	</div><!-- /row -->
	
	@include('posts/category')
	
    
</section>