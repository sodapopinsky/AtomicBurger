@extends('app')
@section('content')

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

<form action="/ordering/deleteform/<?php echo $orderForm->getObjectId(); ?>" method="post" id="deleteForm">
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