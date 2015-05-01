<?php use Carbon\Carbon; ?>
@extends('app')
@section('content')

<section id="content">
  <div class="container">
    <div class="card">

      <div class="card-header ch-alt m-b-20">
        <h2>Inventory</h2>
        <a href="/inventory/additem" class="btn bgm-cyan btn-float"><i class="md md-add"></i></a>
      </div>

      <div class="table-responsive">
        <table class="table ">
          <thead>
            <tr>
              <th>Object Name</th>
              <th><div class="pull-right">Quantity On Hand</div></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($results as $item)
            <tr>
            <td>
                <a href="/inventory/{{{ $item->getObjectId() }}}">{{{ $item->get('name') }}}</a>
                <div style="color:#9E9E9E"><small>Last updated <span style="color:#8BC34A">
  
                {{{ Carbon::instance($item->getUpdatedAt())->diffForHumans() }}}
                 </span></small></div>
              </td>
              <td>
                <div class="pull-right" >
                  <h4> {{{ floatval($item->get('quantityOnHand')) }}} </h4>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</section>
@endsection