
<?php use Carbon\Carbon; ?>

@extends('app')

@section('content')
<div class="container">
	<div class="row">
	   <div class="btn-demo">
                                <a style="display:none;"  id="target" data-toggle="modal" href="#modalNarrower" class="btn btn-sm btn-default">Modal - Small</a>
          </div>

		<div id="calendar-widget"></div>


                            <!-- Modal Small -->	
                            <div class="modal fade" id="modalNarrower" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modalTitle"></h4>

                                        </div>
                                        <div class="modal-body">
                                        <input id="modalAmount">
                                        </div>
                                        <div class="modal-footer">
                                        <input type="hidden" name="activeEventId" id="activeEventId" >
                                        <input type="hidden" name="activeEventShift" id="activeEventShift" >
                                         <input type="hidden" name="activeEventStart" id="activeEventStart" >
                                 
                                            <button id="projectionDelete" type="button"  data-dismiss="modal" class="btn bgm-red">Delete</button>
                                            <button id="projectionSave"  type="button" class="btn bgm-green" data-dismiss="modal">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


	</div>
</div>

@endsection

@section('js')
<script>



	if($('#calendar-widget')[0]) {
		(function(){
			$('#calendar-widget').fullCalendar({
				contentHeight: 'auto',
				theme: true,

				header: {
					right: '',
					center: 'prev, title, next',
					left: ''
				},
				defaultDate: '{{{Carbon::today()}}}', 
				editable: true,
				
				eventClick: function(calEvent, jsEvent, view) {
					  if(calEvent.editable == false)
					  	return;
					  $( "#modalTitle").html(calEvent.displayDate + ' - ' + calEvent.shift);
					  $( "#activeEventId").val(calEvent.id);
					  	 $( "#activeEventShift").val(calEvent.shift);
					  	   	 $( "#activeEventStart").val(calEvent.saveDate);

					    $( "#modalAmount").val(calEvent.amount);
$( "#target" ).click();

        // change the border color just for fun
        $(this).css('border-color', 'red');
				},
				events: function(start, end, timezone, callback) {
					$.ajax({

						url: '/sales/getsales',
						dataType: 'json',
						data: {
                // our hypothetical feed requires UNIX timestamps
                start: start.unix(),
                end:  end.unix()
            },
            success: function(response) {
            	
            	var event = [];
            	$.each( response, function( key, value ) {
            		event.push({
            			title: $(value).attr('title'),
            			start: $(value).attr('start'),
            			end: $(value).attr('end'),
            			id: $(value).attr('id'),
            			className: $(value).attr('className'),
            			allDay: true,
            			editable: $(value).attr('editable'), 
            			disableResizing:true,
            			saveDate: $(value).attr('saveDate'),
            			shift: $(value).attr('shift'),
            			amount: $(value).attr('amount'),
            			displayDate: $(value).attr('displayDate')
            		});
            	});

            	callback(event);
            }

        });
				}


			});
})();
}


$( "#projectionDelete" ).click(function() {

$.ajax({
    type: 'POST',
    // make sure you respect the same origin policy with this url:
    // http://en.wikipedia.org/wiki/Same_origin_policy
    url: '/sales/deleteprojection',
    data: { 
        'objectId': $("#activeEventId").val(),
         'start': $("#activeEventStart").val()
       
    },
    success: function(msg){
    	$('#calendar-widget').fullCalendar( 'refetchEvents' );  ///could be done better without refetchin all events
       
    }
});


});


$( "#projectionSave" ).click(function() {

$.ajax({
    type: 'POST',
    // make sure you respect the same origin policy with this url:
    // http://en.wikipedia.org/wiki/Same_origin_policy
    url: '/sales/saveprojection',
    data: { 
        'shift': $("#activeEventShift").val(),
        'start': $("#activeEventStart").val(),
              'amount': $("#modalAmount").val()
    },
    success: function(msg){
    	$('#calendar-widget').fullCalendar( 'refetchEvents' );  ///could be done better without refetchin all events

    }
});


});




</script>
@endsection
