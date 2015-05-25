@extends('app')
@section('content')
{{{ var_dump($errors) }}}
<section id="content">
  <div class="container">
    <div class="card">

      <div class="card-header ch-alt m-b-20">
        <h2>Add Employee</h2>
      </div>

      <div class="card-body card-padding">
       <form method="post" action="/employees/create" id="myForm">
         <div class="form-group">
          <div class="fg-line">
            <input id="firstName" name="firstName" type="text" class="form-control input-md"  placeholder="First Name">
          </div>
        </div>

        <div class="form-group">
          <div class="fg-line">
            <input id="lastName" name="lastName" type="text" class="form-control input-md"  placeholder="Last Name">
          </div>
        </div>


      </div>
    </div>
    <div id="error"  style="display:none" class="alert alert-danger" role="alert">Please enter a valid name.</div>
    <div class="pull-right">
      <a class="btn bgm-gray waves-effect" href="/employees">Cancel</a>
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
   var value = $( "#firstName" ).val();

   event.preventDefault();
   if ($( "#firstName" ).val().length > 0 && $( "#lastName" ).val().length > 0){
    $( "#myForm" ).submit();
  }
  else{
    $( "#error" ).show();
  }
});
  
</script>
@endsection

