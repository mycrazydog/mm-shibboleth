<section class='invoice'>

	<div class="row">
		<div class="col-md-12">
{!! Form::open(['method' => 'GET']) !!}	

@if( ! empty($staff_id))	
{!! Form::hidden('staff_id', $staff_id) !!}
@endif
		  
		  {!! Form::hidden('print', 1) !!}
		  <button type="submit" class="btn btn-success no-print"><i class="fa fa-print"></i> Print</button>
		  <h2 class="page-header">
		    <i class="fa fa-globe"></i> Full Report
		    <small class="pull-right">Date: {{ date('F d, Y', strtotime($today)) }}</small>
		  </h2>
{!! Form::close() !!}
@if( ! empty($staff_options))		  
{!! Form::open(['method' => 'GET']) !!}			  
        <div class="col-sm-9">              
          {!! Form::select('staff_id', $staff_options, $staff_id, ['class' => 'form-control', 'placeholder' => 'Please select a staff member']) !!}
        </div>
        <div class="col-sm-3">
          <button type="submit" class="btn btn-info pull-right btn-block btn-sm">Sort</button>
        </div>
            
{!! Form::close() !!}
@endif
		</div> 
	</div> 
	
	<div class="row invoice-info">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped">
			    <thead>
			        <tr>
			            <th style="width: 100px;">Date/Creator</th>
			            <th>Title/Notes/Website</th>
			        </tr>
			    </thead>
			    <tbody>
			        @foreach ($posts as $post)        
			        <tr>
			            <td style="width: 100px;">
				            Id: {!! $post->id !!}<br>
				            {{ date('M d, Y', strtotime($post->created_at)) }}<br>
				            {!! $post->author->first_name !!} {!! $post->author->last_name !!}		                        
			            </td>
			            <td>
			            <h4>{!! $post->headline !!}</h4>
			            <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong><br>
			            {{ $post->notes }}<br>			            
			            @if ($post->website)
				            <strong>Website:</strong> <a href="{{ $post->website }}" target="_blank">{{ $post->website }}</a>			            
				            <br>
			            @endif
			            <strong>Staff:</strong> 
			            @foreach ($post->staffs as $staff)  	            
			            <small class="label label-info">{!! $staff->first_name !!} {!! $staff->last_name !!}</small>
			            @endforeach    
			            </td>	
			        </tr>	
			        @endforeach
			    </tbody>
			</table>
		</div><!-- /.col -->	
	</div><!-- /.row --> 
	
	
	<div class="row">
		
	    <div class="col-md-4">
	    	<p class="lead">Summary</p>
			<div class="table-responsive">
				<table class="table">
				  <tbody><tr>
				    <th style="width:50%">Media Mention:</th>
				    <td>{!! $media_mention !!}</td>
				  </tr>
				  <tr>
				    <th>Presentation:</th>
				    <td>{!! $presentation !!}</td>
				  </tr>
				  <tr>
				    <th>Meeting:</th>
				    <td>{!! $meeting !!}</td>
				  </tr>
				  <tr>
				    <th>Testimonial:</th>
				    <td>{!! $testimonial !!}</td>
				  </tr>
				</tbody>
				</table>
			</div>
	    </div><!-- /.col -->
	    <div class="col-md-4">
			<div class="table-responsive">
				<table class="table">
				  <tbody><tr>
				    <th style="width:50%">Sponsored event:</th>
				    <td>{!! $sponsored_event !!}</td>
				  </tr>
				  <tr>
				    <th>On campus collaboration:</th>
				    <td>{!! $on_campus_collaboration !!}</td>
				  </tr>
				  <tr>
				    <th>Off campus collaboration:</th>
				    <td>{!! $off_campus_collaboration !!}</td>
				  </tr>
				  <tr>
				    <th>Achievement:</th>
				    <td>{!! $achievement !!}</td>
				  </tr>
				</tbody>
				</table>
			</div>        
	    </div><!-- /.col -->
	    <div class="col-md-4">
			<div class="table-responsive">
				<table class="table">
				  <tbody><tr>
				    <th style="width:50%">Satisfaction survey:</th>
				    <td>{!! $satifaction_survey !!}</td>
				  </tr>
				  <tr>
				    <th>Other:</th>
				    <td>{!! $other !!}</td>
				  </tr>
				  <tr>
				    <th>Total:</th>
				    <td>{!! $total !!}</td>
				  </tr>
				</tbody>
				</table>
			</div>
	    </div><!-- /.col -->
	</div><!-- /.row --> 
    
</section>