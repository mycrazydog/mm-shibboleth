	
@if(isset($posts))
	<div class="row invoice-info">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped">
			    <thead>
			        <tr>
			            <th style="width:2%">Post Id</th>
			            <th style="width:23%">Headline</th>
			            <th style="width:25%">Staff</th>
			            <th style="width:25%">Writer/Collaborator</th>
			            <th style="width:25%">Department</th>
			        </tr>
			    </thead>
			    <tbody>
			        @foreach ($posts as $post)        
			        <tr>
			            <td style="width: 100px;">{!! $post->id !!}</td>
			            <td style="width: 100px;">
			            <a href="/manage/posts/{!! $post->id !!}/edit" target="_blank" class="">{!! $post->headline !!}</a>
			            </td>
			            <td>
			            @foreach ($post->staffs as $staff)
			            	<span class="label label-success">({{ $staff->name }})</span>			            	
			            @endforeach				            
			            </td>
			            <td>{!! $post->writer_collaborator !!}</td>
			            <td style="width: 100px;">
			            @foreach ($post->departments as $department)
			            	<span class="label label-primary">({{ $department->name }})</span> 			            	
			           	@endforeach		            
			            </td> 
			        </tr>	
			        @endforeach
			    </tbody>
			</table>
		</div><!-- /.col -->	
	</div><!-- /.row --> 
@endif



