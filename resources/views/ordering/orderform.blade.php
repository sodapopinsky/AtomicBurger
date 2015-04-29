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
                     <h2>{{{$orderForm->get('name')}}}</h2>
          
      
     
 <ul class="actions">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="md md-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="/ordering/edit/{{{$orderForm->getObjectId()}}}">Edit List</a>
                                                </li>
                                                <li>
                                                    <a id="sa-warning">Delete List</a>
                                                </li>
                                                
                                            </ul>
                                        </li>
                                    </ul>

                   
  </div>

            <div class="table-responsive">
       
                <table class="table">
                    <thead>
                        <tr>
           
                            <th>Item</th>
                            <th><div class="pull-right">Order Quantity</div></th>
                   

                     

                        </tr>
                    </thead>
                    <tbody>


                       @foreach ($results as $item)
                       @if($item->item->get('par') - $item->item->get('quantityOnHand') > 0)
                       <tr>
                     
                         <td>
                    
                                  
                                <div class="checkbox media">
                                  
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                    <b> {{{ $item->item->get('name') }}}</b>
                                            </label>
                                        </div>
                                    </div>
                                    <div style="color:#9E9E9E"><small>Last updated <span style="color:#8BC34A"> {{{ $item->item->getUpdatedAt()->format('M-d') }}}</span></small></div>
                               </td>

                          <td><div class="pull-right" >
                         <h4> {{{ $item->item->get('par') - $item->item->get('quantityOnHand')  }}}</h4>
                          </div></td>
                     
                        
                    

                    </tr>
@endif
                    @endforeach
                        
                          @foreach ($results as $item)
                       @if($item->item->get('par') - $item->item->get('quantityOnHand') <= 0)
                       <tr >
                     
                        <td>
                    
                                  
                                <div class="checkbox media">
                                  
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox" checked="checked">
                                                <i class="input-helper"></i>
                                                    <b> {{{ $item->item->get('name') }}}</b>
                                            </label>
                                        </div>
                                    </div>
                                    <div style="color:#9E9E9E"><small>Last updated <span style="color:#8BC34A"> {{{ $item->item->getUpdatedAt()->format('M-d') }}}</span></small></div>
                               </td>

                          <td><div class="pull-right" >
                         <h4> {{{ $item->item->get('par') - $item->item->get('quantityOnHand')  }}}</h4>
                          </div></td>
                        

                     
                        
                    

                    </tr>
@endif
                    @endforeach




                </tbody>
            </table>
            
        </div>

                                   




<form action="/ordering/deleteform/<?php echo $id?>" method="post" id="deleteForm">
</form>





                </div>
            </section>
        </section>
        
@endsection

@section('js')
   <script>
      //Warning Message
            $('#sa-warning').click(function(){
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this list!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: true 
                }, function(){   
                    $( "#deleteForm" ).submit();
                });
            });

            </script>
@endsection