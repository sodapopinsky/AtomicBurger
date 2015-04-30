@extends('app')
@section('content')

<section id="content">
  <div class="container">
   <div class="card">

    <div class="card-header ch-alt m-b-20">
      <h2>Add Inventory Item</h2>
    </div>

    <div class="card-body card-padding">

      <div class="form-group">
        <form action="/inventory/doadditem" method="post" id="adjustform">

          <div class="form-group fg-float">
            <div class="fg-line">
              <input id="itemname" name="itemname" type="text" class="form-control fg-input">
            </div>
            <label class="fg-label">Item Name</label>
          </div>

          <div class="form-group fg-float">
            <div class="fg-line">
              <input id="itemmeasurement" name="itemmeasurement" type="text" class="form-control fg-input">
            </div>
            <label class="fg-label">Measurement Description</label>
          </div>
        </div>

        <div id="error"  style="display:none" class="alert alert-danger" role="alert">Please fill out all fields</div>

        <div class="pull-right" style="margin-top:40px;">
          <a class="btn bgm-gray waves-effect" href="/inventory">Cancel</a>
          <button id="save" class="btn bgm-blue waves-effect " style="margin-right:5px;">Save</button>
        </div>
      </form>
    </div>

  </section>

@endsection

@section('js')
  <script>
    $( "#save" ).click(function( event ) {
     event.preventDefault();
     if ( $( "#itemname" ).val().length > 0 && $( "#itemmeasurement" ).val().length > 0){
      $( "#adjustform" ).submit();
    }
    else{
      $( "#error" ).show();
    }
  });
  </script>
@endsection