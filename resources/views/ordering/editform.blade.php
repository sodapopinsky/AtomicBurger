@extends('app')
@section('content')
<section id="content">
  <div class="container">

    <div class="card">

      <div class="card-header ch-alt m-b-20">
       <h2>{{{$orderForm->get('name')}}}<small>Edit Form </small></h2>                 
     </div>

     <div class="table-responsive">
      
      <table class="table">
        <thead>
          <tr>
            <th>Check to Include</th>
          </tr>
        </thead>
        <tbody>
         @foreach ($results as $item)
         <tr>
          <td>   
           <div class="checkbox media">
            <div class="media-body">
              <label>
                @if(in_array($item->getObjectId(),$orderFormItemIds))
                
                <input onclick="test('{{{$item->getObjectId()}}}')" type="checkbox" checked="checked" class="pull-right">
                @else 

                <input onclick="test('{{{$item->getObjectId()}}}')" type="checkbox"  class="pull-right">
                @endif
                <i class="input-helper"></i>
                {{{ $item->get('name') }}}
              </label>
            </div>
          </div>
        </td>
        
      </tr>
      @endforeach
    </tbody>
  </table>
  
</div>
</div>
</section>
</section>

@endsection

@section('js')
<script>
  function test(id){
    var formData = {itemId:id,formId:"<?php echo $orderForm->getObjectId();?>"};
    $.ajax({
      url : "/ordering/saveedits",
      type: "POST",
      data : formData,
      success: function(data, textStatus, jqXHR)
      {
        console.log(data);
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
       
      }
    });
  }
</script>
@endsection