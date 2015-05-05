
<?php use Carbon\Carbon; ?>
<?php $message = "g"; ?>
@extends('app')
@section('content')
<style>
    .dropdown-menu-right-input {
       background: none;
       border: none;
       color: #333;
       cursor: pointer; width:100%;
   }
</style>
<section id="content">
    <div class="container">

       <div class="block-header">
          <h2>{{{$employee->firstName}}} {{{$employee->lastName}}}</h2>
 <ul class="actions">
                            
                            <li class="dropdown">
                                <a class="icon-pop" href="" data-toggle="dropdown">
                                    <i class="md md-more-vert"></i>
                                </a>
                    
                                
                    <ul class="dropdown-menu dropdown-menu-right ">
                     <form method="post" action="/employees/delete/{{{$employee->getObjectId()}}}">

                         <input type="submit" class="dropdown-menu-right-input" value="Delete"   >

                     </form>
                     <li>
                            </li>
                        </ul>
      </div>



      <a style="display:none;"   id="target" data-toggle="modal" href="#modalDefault" class="btn btn-sm btn-default">Modal - Small</a>

      <!-- Modal Default -->  
      <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <form action="/insert/writeup" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Write Up</h4>
                </div>
                <div class="modal-body">
              
                <input type="hidden" name="employeeId" value="{{{$employee->getObjectID()}}}">
                 <div class="form-group">
                    <div class="fg-line">
                        <textarea name="writeUp" class="form-control" rows="5" placeholder="What'd they do this time?"></textarea>
                    </div>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link">Save changes</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
              </form>
        </div>
    </div>
</div>

<div class="card">




    <div class="listview lv-bordered lv-lg">
        <div class="lv-header-alt">
            <h2 class="lvh-label hidden-xs">Write Ups</h2>

            <ul class="lv-actions actions">
                <li>
                    <a onclick="goModal();">
                        <i class="md md-add-circle-outline"></i>
                    </a>
                </li>

            </ul>
        </div>

        <div class="lv-body">

 @foreach($writeUps as $item)
            <div class="lv-item media">
              
               <div class="media-body">
                <div class="lv-title">{{{$item->writeUp}}}</div>
                <ul class="lv-attrs">
                    <li>{{{Carbon::instance($item->getCreatedAt())->toDateString()}}}</li>

                </ul>

                <div class="lv-actions actions dropdown">
                    <a href="" data-toggle="dropdown" aria-expanded="true">
                        <i class="md md-more-vert"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right ">
                     <form method="post" action="/delete/writeup/{{{$item->getObjectId()}}}">

                         <input type="submit" class="dropdown-menu-right-input" value="Delete"   >

                     </form>
                     <li>



                     </li>

                 </ul>
             </div>
         </div>
   
     </div>
      @endforeach
 </div>
</div>


</div>


</div>


</section>
@endsection
@section('js')
<script type="text/javascript">

   $(document).ready(function(){
    var message =  '{{{Session::get("message")}}}';
    if(message)
        writeUpDeleted();
});
   function goModal(){

       $( "#target" ).click();
   }
            /*
             * Notifications
             */
             function writeUpDeleted(from, align, icon, type, animIn, animOut){
                $.growl({
                    icon: icon,
                    title: '',
                    message: '<b>Write Up Deleted</b>',
                    url: ''
                },{
                    element: 'body',
                    type: 'success',
                    allow_dismiss: true,
                    placement: {
                        from: from,
                        align: align
                    },
                    offset: {
                        x: 20,
                        y: 85
                    },
                    spacing: 10,
                    z_index: 1031,
                    delay: 2500,
                    timer: 1000,
                    url_target: '_blank',
                    mouse_over: false,
                    animate: {
                        enter: animIn,
                        exit: animOut
                    },
                    icon_type: 'class',
                    template: '<div data-growl="container" class="alert" role="alert">' +
                    '<button type="button" class="close" data-growl="dismiss">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '<span class="sr-only">Close</span>' +
                    '</button>' +
                    '<span data-growl="icon"></span>' +
                    '<span data-growl="title"></span>' +
                    '<span data-growl="message"></span>' +
                    '<a href="#" data-growl="url"></a>' +
                    '</div>'
                });
};


</script>
}

@endsection