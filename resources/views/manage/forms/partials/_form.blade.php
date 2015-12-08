
<div class="form-group">
  @if($page_id == 'staff')
  	<div class="form-group">
  	{!! Form::label('first_name', 'First name') !!}  
  	{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
  	</div>
  	<div class="form-group">
  	{!! Form::label('last_name', 'Last name') !!}  
  	{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
  	<div class="form-group">
  @else 
  	<div class="form-group">
  	{!! Form::label('name', 'Name') !!} 
  	{!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
  	</div>
  @endif
  
  {!! errors_for('name', $errors) !!}  
</div>







