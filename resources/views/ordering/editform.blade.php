@extends('app')

@section('content')

<?php

use Parse\ParseClient;
 
ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');

use Parse\ParseObject;
use Parse\ParseQuery;

$query = new ParseQuery("orderForms");
try {
  $orderForm = $query->get($id);
  // The object was retrieved successfully.
} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
}

$query = new ParseQuery("orderFormItems");
$query->equalTo("orderForm",$orderForm);
$query->includeKey("item");
$orderFormItems = $query->find();
$orderFormItemIds = array();
foreach($orderFormItems as $item){
   array_push($orderFormItemIds,$item->item->getObjectId());
}

$query = new ParseQuery("inventoryObjects");
$query->descending("createdAt");
$results = $query->find();


/*
$query = new ParseQuery("inventoryObjects");
$query->containedIn("playerName",
                  ["Jonathan Walsh", "Dario Wunsch", "Shawn Simon"]);
*/
?>

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
                     
                        <td>    <div class="checkbox media">
                                  
                                        <div class="media-body">
                                            <label>
                                            <?php
if(in_array($item->getObjectId(),$orderFormItemIds)){ ?>
 <input onclick="test('{{{$item->getObjectId()}}}')" type="checkbox" checked="checked" class="pull-right">
 <?php                               
}
else{ ?>
 <input onclick="test('{{{$item->getObjectId()}}}')" type="checkbox"  class="pull-right">
 <?php
}
                                            ?>
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
  var formData = {itemId:id,formId:"<?php echo $id;?>"};
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