@section('header')
    @parent <!-- tells blade to include the parent contetn -->
    <p>Added to the parent header</p>
@stop

@section('content')
    <p>ID: {{ $item->id }}</p><!-- This is a row in the db; You can echo any row in the items table that way awsome :) -->
    <p>Name: {{ $item->name }}</p>
    <p>Display Name: {{ $item->display_name }}</p>
    <p>Web Description: {{ $item->web_description }}</p>
    <p>Loadout Slot: {{ $item->loadout_slot }}</p>
    <p>Price: {{ $item->price }}</p>
    <img src="images/{{ $item->name }}.jpg" alt="{{ $item->web_description }}">
@stop