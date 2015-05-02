
<?php use Carbon\Carbon; ?>

@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div id="calendar-widget"></div>
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
				events: function(start, end, timezone, callback) {
			 $.ajax({

						url: '/events',
						dataType: 'json',
						data: {
                // our hypothetical feed requires UNIX timestamps
                start: start.unix(),
                end:  end.unix()
            },
            success: function(response) {
            	console.log(response.length)
            	var event = [];
            	$.each( response, function( key, value ) {
            		event.push({
            			title: $(value).attr('title'),
            			start: $(value).attr('start'),
            			end: $(value).attr('end'),
            			className: $(value).attr('className'),
            			allDay: true
            		});
            	});

            	callback(event);
            }
        });
				}


			});
		})();
	}



</script>
@endsection
