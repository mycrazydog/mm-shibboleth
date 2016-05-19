	
@if(isset($posts))
	<div class="row invoice-info">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped">
			    <thead>
			        <tr>
			            <th style="width:3%">Post Id</th>
			            <th style="width:15%">Headline</th>
			            <th style="width:15%">Category</th>
			            <th style="width:7%">Publish Date</th>
			            <th style="width:15%">Writer/Collaborator</th>
			            <th style="width:15%">Staff</th>			            
			            <th style="width:15%">Department</th>
			            <th style="width:15%">Notes</th>
			        </tr>
			    </thead>
			    <tbody>
			        @foreach ($posts as $post)        
			        <tr>
			            <td style="width: 100px;">{!! $post->id !!}</td>
			            <td style="width: 100px;"><a href="/manage/posts/{!! $post->id !!}/edit" target="_blank" class="">{!! $post->headline !!}</a></td>
			            <td>
				            @if(($post->media_mention) == 1)		            
				            	<span class="label label-success">(Media Mention)</span>
				            @endif
				            @if(($post->presentation) == 1)		            
				            	<span class="label label-success">(Presentation)</span>
				            @endif
				            @if(($post->meeting) == 1)		            
				            	<span class="label label-success">(Meeting)</span>
				            @endif
				            @if(($post->testimonial) == 1)		            
				            	<span class="label label-success">(Testimonial)</span>
				            @endif
				            @if(($post->sponsored_event) == 1)		            
				            	<span class="label label-success">(Sponsored Event)</span>
				            @endif
				            @if(($post->development) == 1)		            
				            	<span class="label label-success">(Development)</span>
				            @endif
				            @if(($post->on_campus_collaboration) == 1)		            
				            	<span class="label label-success">(On Campus Collaboration)</span>
				            @endif
				            @if(($post->off_campus_collaboration) == 1)		            
				            	<span class="label label-success">(Off Campus Collaboration)</span>
				            @endif
				            @if(($post->achievement) == 1)		            
				            	<span class="label label-success">(Achievement)</span>
				            @endif
				            @if(($post->satisfaction_survey) == 1)		            
				            	<span class="label label-success">(Satisfaction Survey)</span>
				            @endif    
				            @if(($post->other) == 1)		            
				            	<span class="label label-success">(Other: {{ $post->other_desc }})</span>
				            @endif
			            </td>
			            <td>{!! $post->publish_date !!}</td>
			            <td>{!! $post->writer_collaborator !!}</td>
			            <td>
			            @foreach ($post->staffs as $staff)
			            	<span class="label label-success">({{ $staff->name }})</span>		            	
			            @endforeach				            
			            </td>
			            
			            <td style="width: 100px;">
			            @foreach ($post->departments as $department)
			            	<span class="label label-primary">({{ $department->name }})</span> 			            	
			           	@endforeach		            
			            </td>
			            <td>{!! $post->notes !!}</td>
			        </tr>	
			        @endforeach
			    </tbody>
			</table>
		</div><!-- /.col -->	
	</div><!-- /.row --> 
@endif


