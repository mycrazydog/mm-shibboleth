@extends('default')

@section('title', 'Dashboard')

@section('content')

<a href="{{ url('manage/posts/create') }}" class="btn  btn-success btn-lg"><i class="fa fa-plus"></i> Add New</a>

<br/><br/>

Page {!! $posts->currentPage() !!} of {!! $posts->lastPage() !!}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">Headline/Title</th>
            <th class="span2">Date</th>
            <th class="span2">User</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)        
        <tr>
            <td><a href="{{ route('manage.posts.edit', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="{{ route('manage.posts.edit', $post->id) }}">{!! $post->headline !!}</a></td>
            <td>{{{ $post->created_at->diffForHumans() }}}</td>
            <td>{!! $post->author->first_name !!} {!! $post->author->last_name !!}</td>
            
            <!-- Delete -->
            <td>
            
                {!! Form::open([
                        'route' => array('manage.posts.destroy', $post->id),
                        'method' => 'delete',
                        'style' => 'display:inline'
                   ])
                !!}
                    <button class='btn btn-xs btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Delete Post" data-message='Are you sure you want to delete this post ?'>
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                {!! Form::close() !!}
                
            </td>
            
        </tr>

        @endforeach
    </tbody>
</table>

{!! $posts->render() !!}

@include('_delete')

@endsection