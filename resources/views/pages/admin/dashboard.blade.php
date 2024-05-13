@section('title', 'Dashboard')
@extends('layout.index')

@push('plugin-styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
@endpush
@section('content')
<h5>User on Maps </h5>

<div class="card">
    <div class="card-body">
        <div id="map"></div>
    </div>
</div>
@endsection



@push('custom-scripts')
<script src="{{ asset('assets/src/dashboard.js') }}"></script>
@endpush
