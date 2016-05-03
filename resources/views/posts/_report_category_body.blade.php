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
        <div class="col-sm-6">  <button type="submit" name="action" value="query" class="btn btn-info pull-right btn-block btn-lg"><i class="fa fa-database" aria-hidden="true"></i>&nbsp;&nbsp;Query</button> </div>
        <div class="col-sm-6">  <button type="submit" name="action" value="excel" class="btn btn-info pull-right btn-block btn-lg"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Export To Excel</button> </div>
        

	{!! Form::close() !!}		
	</div><!-- /row -->
	
	
	

@if(isset($posts))
	<div class="row invoice-info">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped">
			    <thead>
			        <tr>
			            <th style="width:5%">Post Id</th>
			            <th style="width:50%">Headline</th>
			            <th style="width:20%">Writer/Collaborator</th>
			            <th style="width:25%">Department</th>
			        </tr>
			    </thead>
			    <tbody>
			        @foreach ($posts as $post)        
			        <tr>
			            <td style="width: 100px;">{!! $post->post_id !!}</td>
			            <td style="width: 100px;">
			            <a href="/manage/posts/{!! $post->post_id !!}/edit" target="_blank" class="">{!! $post->post_headline !!}</a>
			            </td>
			            <td style="width: 100px;">{!! $post->post_wc !!}</td>			            
			            <td>{!! $post->post_dept !!}</td>
			        </tr>	
			        @endforeach
			    </tbody>
			</table>
		</div><!-- /.col -->	
	</div><!-- /.row --> 
@endif
	
    
</section>