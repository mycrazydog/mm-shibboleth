@extends('default')

@section('title', 'Dashboard')

@section('content')

<a href="{{ url('manage/posts/create') }}" class="btn  btn-success btn-lg"><i class="fa fa-plus"></i> Add New</a>

<br/><br/>

<div id="jsGrid"></div>



@include('_delete')

@endsection

@section('scripts')

<script>
$(function() {

	
 
    $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%", 

        sorting: true,
        paging: false,
        autoload: true,
        

 
 		data:  {!! $posts !!}, 
 		
 		rowClick: function(e) {
 		    editingClient = e.item;
 		    id= e.item.id;
 		    window.location.href = "/manage/posts/"+ id + "/edit";
 		    
 		},
 		

 
        fields: [
            
            { name: "id", type: "number", align: "center", width: 5},
            { name: "headline", type: "text", align: "left", title: "Headline", width: 60},
            { name: "full_name", type: "text", align: "center", title: "Name", width: 20},
            { name: "publish_date", type: "text", align: "center", title: "Event Date", width:20}
            
        ]
        

    });
 
});
</script>

@endsection