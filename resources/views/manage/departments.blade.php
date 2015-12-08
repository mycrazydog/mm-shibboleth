@extends('default')

@section('title', 'Departments')

@section('content')

<a href="{{ url('manage/departments/create') }}" class="btn  btn-success"><i class="fa fa-plus"></i> Add New</a>

<br/><br/>

Page {!! $departments->currentPage() !!} of {!! $departments->lastPage() !!}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">Name</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)        
        <tr>
            <td><a href="{{ route('manage.departments.edit', $department->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="{{ route('manage.departments.edit', $department->id) }}">{!! $department->name !!}</a></td>
			<!-- Delete -->
			<td>
			
			    {!! Form::open([
			            'route' => array('manage.departments.destroy', $department->id),
			            'method' => 'delete',
			            'style' => 'display:inline'
			       ])
			    !!}
			        <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Delete Department" data-message='Are you sure you want to delete this department?'>
			            <span class="glyphicon glyphicon-trash"></span>
			        </button>
			    {!! Form::close() !!}
			    
			</td>            
        </tr>

        @endforeach
    </tbody>
</table>

{!! $departments->render() !!}

@include('_delete')

@endsection