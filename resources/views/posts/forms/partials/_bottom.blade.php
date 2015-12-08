<!-- Modal -->
<div class="modal fade" id="modalSource" tabindex="-1" role="dialog" aria-labelledby="modalSourceLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Source</h4>
      </div>
      <div class="modal-body">
      	{!! Form::open(['method' => 'POST', 'action' => 'DataSourceController@store', 'class' => 'form-horizontal frmAddSource']) !!}	
          <ul>
              @foreach($errors->all() as $error)
                  <li>{!! $error !!}</li>
              @endforeach
          </ul>
      
          <div class="form-group">
{!! Form::label('sourcename', 'Source Name') !!}  
{!! Form::text('sourcename', null, ['class' => 'form-control', 'placeholder'=>'Source Name']) !!}
          </div> <!-- /field -->
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        {!! Form::submit('Submit', array('class'=>'button btn btn-primary')) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>  
<!-- /Modal -->


<!-- Page script -->
<script type="text/javascript">
$('document').ready(function() {

    // Prepare reset.
    function resetModalFormErrors() {
        $('.form-group').removeClass('has-error');
        $('.form-group').find('.help-block').remove();
    }

    // Intercept submit.
    $('form.frmAddSource').on('submit', function(e) {
        e.preventDefault();

        // Set vars.
        var form   = $(this),
            url    = form.attr('action'),
            submit = form.find('[type=submit]');

		var data        = form.serialize(),
                contentType = 'application/x-www-form-urlencoded; charset=UTF-8';


        // Please wait.
        if (submit.is('button')) {
            var submitOriginal = submit.html();
            submit.html('Please wait...');
        } else if (submit.is('input')) {
            var submitOriginal = submit.val();
            submit.val('Please wait...');
        }

        // Request.
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            contentType: contentType,
            processData: false

        // Response.
        }).always(function(response, status) {

            // Reset errors.
            resetModalFormErrors();

            // Check for errors.
            if (response.status == 422) {
                var errors = $.parseJSON(response.responseText);

                // Iterate through errors object.
                $.each(errors, function(field, message) {
                    console.error(field+': '+message);
                    var formGroup = $('[name='+field+']', form).closest('.form-group');
                    formGroup.addClass('has-error').append('<p class="help-block">'+message+'</p>');
                });

                // Reset submit.
                if (submit.is('button')) {
                    submit.html(submitOriginal);
                } else if (submit.is('input')) {
                    submit.val(submitOriginal);
                }
            }
        }).done(function(data) {
        	//successful
        	$.ajax({
        		type: 'GET',
        		dataType: 'json',
        		delay: 250,
        		url:  'https://unccharlotte.info/api/datasource'
        	}).done(function(data) {
        	    // If successful
        	    $(".source_list").select2("updateResults");   
        	    
        	    
        	    
        	                     
        	   console.log(data);
        	}).fail(function(jqXHR, textStatus, errorThrown) {
        	    // If fail
        	    console.log(textStatus + ': ' + errorThrown);
        	});        
        });
    });

    // Reset errors when opening modal.
    $('.frmAddSource-open').click(function() {
        resetModalFormErrors();
    });

});
</script>	  