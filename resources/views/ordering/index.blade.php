@extends('app')

@section('content')

<?php

use Parse\ParseClient;

ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
use Parse\ParseObject;
use Parse\ParseQuery;





$query = new ParseQuery("orderForms");
$query->descending("createdAt");
$results = $query->find();
?>

<section id="content">
    <div class="container">


        <div class="card">

            <div class="card-header ch-alt m-b-20">
                <h2>Order Forms</h2>


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





</div>
</section>
</section>

@endsection