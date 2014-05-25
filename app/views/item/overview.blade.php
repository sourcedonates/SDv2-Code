@extends('layouts.master')

@section('header')
    @parent
@stop

@section('content')
    <div id="grid" class="desktop-10 tablet-5 item-container">
        @foreach ($items as $item)
        <a id="item" data-price="{{ $item->price }}" class="item equal desktop-3 tablet-3 mobile-half contained mix lightbox {{ $item->loadout_slot }}" href="assets/images/items/groot/{{ $item->name }}.jpg" title="{{ $item->price }} credits - {{ $item->display_name }}">
            <div class="overlay">
                <div class="name align-center">{{ $item->display_name }}</div>
                <div class="price align-right"><div class="credits">{{ $item->price }}</div>credits</div>
            </div>
            <img class="item-image" src="assets/images/items/{{ $item->name }}.jpg" data-src="assets/images/items/{{ $item->name }}.jpg" alt="{{ $item->web_description }}">
       
        </a>
        @endforeach
    </div>
@stop