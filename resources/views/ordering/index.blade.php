@extends('app')
@section('content')
   {{{  var_dump(parse_url(getenv("DATABASE_URL"))) }}}
<section id="content">
    <div class="container">
        <div class="card">

            <div class="card-header ch-alt m-b-20">
                <h2>Order Forms</h2>
                <a href="/ordering/addform" class="btn bgm-cyan btn-float"><i class="md md-add"></i></a>
            </div>

            <div class="listview">
               @foreach ($results as $item)
                <a class="lv-item" href="/ordering/orderform/{{{ $item->getObjectId() }}}">
                 <div class="media">
                    <div class="media-body">
                        <div class="lv-title">{{{ $item->get('name')}}}</div>
                        <small class="lv-small">-</small>
                    </div>
                 </div>
                </a>
               @endforeach

        </div>
    </div>


</section>
@endsection