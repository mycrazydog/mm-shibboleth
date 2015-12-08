@extends('default')

@section('title', 'Staff')

@section('content')

<a href="{{ url('manage/staff/create') }}" class="btn  btn-success"><i class="fa fa-plus"></i> Add New</a>

<br/><br/>

Page {!! $staffs->currentPage() !!} of {!! $staffs->lastPage() !!}


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">Last Name</th>
            <th class="span6">First Name</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($staffs as $staff)        
        <tr>
            <td><a href="{{ route('manage.staff.edit', $staff->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="{{ route('manage.staff.edit', $staff->id) }}">{!! $staff->last_name !!}</a></td>
            <td><a href="{{ route('manage.staff.edit', $staff->id) }}">{!! $staff->first_name !!}</a></td>
			<!-- Delete -->
			<td>
			
			    {!! Form::open([
			            'route' => array('manage.staff.destroy', $staff->id),
			            'method' => 'delete',
			            'style' => 'display:inline'
			       ])
			    !!}
			        <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Delete Staff" data-message='Are you sure you want to delete this staff ?'>
			            <span class="glyphicon glyphicon-trash"></span>
			        </button>
			    {!! Form::close() !!}
			    
			</td>
        </tr>

        @endforeach
    </tbody>
</table>


{!! $staffs->render() !!}

@include('_delete')

@endsection