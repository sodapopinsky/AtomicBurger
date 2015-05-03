<?php use Carbon\Carbon; ?>

@extends('app')

@section('content')
<div class="container">
	<div class="row">
	  
      <div class="card">
      <div class="card-header">
      <div class="pull-right bgm-yellow" style="padding:5px;">
          <div  class="bgm-yellow"><h1>Lbs: <span id="ajaxpatties"></span></h1></div>
            <div>Today AM: <span id="ajaxthisAM"></span></div>
              <div>Today PM: <span id="ajaxthisPM"></span></div>
            <div>Tomorrow AM: <span id="ajaxnextAM"></span></div>
          </div>
      <h3>Meat Calculator for {{{Carbon::now()->toFormattedDateString()}}}</h3>
         
      </div>

          <div class="card-body card-padding">
       
               <div class="form-group">
                                <div class="fg-line">
                                    <input id="pattyCount" type="text" class="form-control input-lg" placeholder="Number of 2.5oz patties">
                                </div>
                </div>
                <button id="calculate" class="btn bgm-blue waves-effect " style="margin-right:5px;">Calculate</button>
       
            </div>

 

      </div>


	</div>
</div>

@endsection

@section('js')
<script>
$("#calculate").click(
    function(){

       $.ajax({
    type: 'GET',
    // make sure you respect the same origin policy with this url:
    // http://en.wikipedia.org/wiki/Same_origin_policy
    url: '/calculatemeat',
    data: { 
        'patties': $("#pattyCount").val()
    },
    success: function(response){
      
     var r = $.parseJSON(response);
     $.each( r, function( key, value ) {
        $('#ajax'+key).html(parseInt(value));

     });

             


    }
});

    }
    );

</script>


@endsection