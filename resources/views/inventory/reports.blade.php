<?php use Carbon\Carbon; ?>
@extends('app')
@section('content')
<section id="content">
  <div class="container">



    <div class="card">
    
       <div class="card-header">
        <h2>Adjustments</h2>
      </div>
 
       @foreach ($results as $item)
 
      <div>     <b>  {{{ Carbon::instance($item->getUpdatedAt()) }}} </b> {{{$item->inventoryObject->name}}} - {{{$item ->quantity}}}</div>
      @endforeach
  </div>


</section>
@endsection

@section('js')
 @endsection