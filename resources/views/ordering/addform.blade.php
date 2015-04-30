@extends('app')
@section('content')

<section id="content">
  <div class="container">
    <div class="card">

      <div class="card-header ch-alt m-b-20">
        <h2>Create Order Form</h2>
      </div>

      <div class="card-body card-padding">
       <form method="post" action="/ordering/createform" id="orderForm">
         <div class="form-group">
          <div class="fg-line">
            <input id="formName" name="formName" type="text" class="form-control input-md"  placeholder="Enter Order Form Name">
          </div>
        </div>
      </div>
    </div>
    <div id="error"  style="display:none" class="alert alert-danger" role="alert">Please enter a valid title.</div>
    <div class="pull-right">
      <a class="btn bgm-gray waves-effect" href="/ordering">Cancel</a>
      <button id="save" class="btn bgm-blue waves-effect " style="margin-right:5px;">Create</button>               
    </div>           
  </form> 
  
</div>
</section>
</section>

@endsection


@section('js')
<script>
  $( "#save" ).click(function( event ) {
   var value = $( "#formName" ).val();

   event.preventDefault();
   if (value.length > 0){
    $( "#orderForm" ).submit();
  }
  else{
    $( "#error" ).show();
  }
});
  
</script>
@endsection

