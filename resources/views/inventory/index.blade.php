@extends('app')

@section('content')

<?php

use Parse\ParseClient;
// use Carbon\Carbon;

ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');

use Parse\ParseObject;
use Parse\ParseQuery;
$query = new ParseQuery("inventoryObjects");
$query->descending("createdAt");
$results = $query->find();
?>

<section id="content">
    <div class="container">



        <div class="card">

            <div class="card-header ch-alt m-b-20">
                <h2>Inventory</h2>


                <a href="/inventory/additem" class="btn bgm-cyan btn-float"><i class="md md-add"></i></a>
            </div>





            <div class="table-responsive">
            <?php /*
                <table class="table">
                    <thead>
                        <tr>

                            <th>Object Name</th>
                            <th>Quantity On Hand</th>
                            <th>Par</th>
                            <th>Last Updated</th>

                        </tr>
                    </thead>
                    <tbody>


                       @foreach ($results as $item)
                        <?php 
                      $carbon = Carbon::instance($item->getUpdatedAt());
                        ?>
                       <tr>

                        <td><a href="/inventory/{{{ $item->getObjectId() }}}">{{{ $item->get('name') }}}</a></td>
                        <td>{{{ $item->get('quantityOnHand') }}}</td>
                     
                        <td>{{{$carbon->diffInDays()}}}</td>
                        @if($carbon->diffInMinutes() < 60)
                        <td><span style="color:#4CAF50">{{{ $carbon->diffForHumans() }}}</span></td>
                        @else
                        <td><span >{{{ $carbon->diffForHumans() }}}</span></td>
                        @endif
                        
                    

                    </tr>

                    @endforeach


                </tbody>
            </table>
            */ ?>
        </div>

    </div>





</div>
</section>
</section>

@endsection