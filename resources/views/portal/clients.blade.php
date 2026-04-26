@extends('layouts.portal')

@section('title', 'All Clients - Kitchen365 Portal')

@section('content')
<div class="clients-grid">
    @php
        $clients = [
            ['name' => '3AC Capital', 'contact' => 'Cynthia Maser', 'requests' => 1],
            ['name' => '3AC Capital', 'contact' => 'Cynthia Maser', 'requests' => 8],
            ['name' => '5655', 'contact' => 'test', 'requests' => 0],
            ['name' => '75 Cabinets', 'contact' => 'Diana', 'requests' => 11],
            ['name' => 'A to Z Kitchens', 'contact' => 'Daniel', 'requests' => 3],
            ['name' => 'A&O Cabinets, LLC.', 'contact' => 'Cory Lutz', 'requests' => 12],
            ['name' => 'abc', 'contact' => 'Jason', 'requests' => 0],
            ['name' => 'Ace Kitchens In Baths LLC.', 'contact' => 'Ace kitchens and Baths llc Charles Licastro', 'requests' => 32],
            ['name' => 'AdaCo Construction LLC', 'contact' => 'Adam Hafez', 'requests' => 1],
            ['name' => 'Adame Construction', 'contact' => 'Gabriel Adame', 'requests' => 6],
            ['name' => 'Adame Construction', 'contact' => 'ryan', 'requests' => 1],
            ['name' => 'Advanced Interiors', 'contact' => 'Christopher Mericle', 'requests' => 62],
            ['name' => 'AES Builder and Home Improvements Inc', 'contact' => 'Stephen Longao', 'requests' => 2],
            ['name' => 'Affordable Cabinets of Cape Cod', 'contact' => 'Dennis McCartney', 'requests' => 3],
            ['name' => 'Affordable Granite & Cabinetry', 'contact' => 'Ed Sproat', 'requests' => 0],
            ['name' => 'Ai Home Renovations', 'contact' => 'Aaron', 'requests' => 0],
            ['name' => 'AIG Construction', 'contact' => 'Adriana', 'requests' => 0],
            ['name' => 'All Por Supply Co', 'contact' => 'All Pro Supply', 'requests' => 0],
        ];
    @endphp

    @foreach($clients as $client)
    <div class="client-card">
        <div class="client-info">
            <h3 class="client-name">{{ $client['name'] }}</h3>
            <p class="client-contact">{{ $client['contact'] }}</p>
            <div class="requests-line">Total Open Requests: <span class="requests-count">{{ $client['requests'] }}</span></div>
        </div>
        <button class="standard-btn">Standard</button>
    </div>
    @endforeach
</div>
@endsection
