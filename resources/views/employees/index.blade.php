@extends('app')
@section('content')

<section id="content">
    <div class="container">
        <div class="card">

            <div class="card-header ch-alt m-b-20">
                <h2>Employees</h2>
                <a href="/employees/create" class="btn bgm-cyan btn-float"><i class="md md-add"></i></a>
            </div>

            <div class="listview" style="padding-bottom:10px;">
               @foreach ($employees as $item)

                <a class="lv-item" href="/employees/profile/{{{ $item->id }}}">
                 <div class="media">
                    <div class="media-body" style="padding:5px;">
                        <div class="lv-title">{{{ $item->firstName }}} {{{ $item->lastName }}}</div>

                    </div>
                 </div>
                </a>
               @endforeach



        </div>
    </div>


</section>
@endsection