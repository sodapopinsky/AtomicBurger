@extends('app')
@section('content')
<section id="content">
  <div class="container">

    <div class="block-header">
      <h2>Inventory Adjust</h2>
    </div>

    <div class="card">
      <form action="/inventory/doadjust/{{{ $results->getObjectId() }}}" method="post" id="adjustform">
       <div class="card-header">
        <h2>{{{ $results->get('name') }}} <small>{{{ $results->get('measurement') }}}</small></h2>
      </div>
      <div class="card-body card-padding">
       <div class="form-group">
        <div class="fg-line">
          <input id="quantity" name="quantity" type="text" class="form-control input-lg input-mask" data-mask="00" placeholder="Enter New Quantity">
        </div>
      </div>
      </form> 
    </div>

    <div id="error"  style="display:none" class="alert alert-danger" role="alert">Please enter a valid number.</div>
  </div>

  <div class="pull-right">
    <a class="btn bgm-gray waves-effect" href="/inventory">Cancel</a>
    <button id="save" class="btn bgm-blue waves-effect " style="margin-right:5px;">Save</button>
  </div>

</section>
@endsection

@section('js')
<script>
  $( "#save" ).click(function( event ) {
   var value = $( "#quantity" ).val();

   event.preventDefault();
   if ( value == 0 || (value.length > 0 && $.isNumeric(value))){
    $( "#adjustform" ).submit();
  }
  else{
    $( "#error" ).show();
  }
  });
 </script>
 @endsection