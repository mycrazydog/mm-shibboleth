@extends('default')

@section('title', 'Sources')

@section('content')

<a href="{{ url('manage/sources/create') }}" class="btn  btn-success"><i class="fa fa-plus"></i> Add New</a>

<br/><br/>

Page {!! $sources->currentPage() !!} of {!! $sources->lastPage() !!}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">Name</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sources as $source)        
        <tr>
            <td><a href="{{ route('manage.sources.edit', $source->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="{{ route('manage.sources.edit', $source->id) }}">{!! $source->name !!}</a></td>
			<!-- Delete -->
			<td>
			
			    {!! Form::open([
			            'route' => array('manage.sources.destroy', $source->id),
			            'method' => 'delete',
			            'style' => 'display:inline'
			       ])
			    !!}
			        <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Delete Source" data-message='Are you sure you want to delete this source ?'>
			            <span class="glyphicon glyphicon-trash"></span>
			        </button>
			    {!! Form::close() !!}
			    
			</td>
        </tr>

        @endforeach
    </tbody>
</table>

{!! $sources->render() !!}

@include('_delete')

@endsection