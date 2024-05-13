@extends('layout.index')

@push('plugin-styles')
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
@endpush


@section('content')
<div class="d-flex justify-content-start p-2">
    <h3>Localizacion del usuario <span id="userName"></span></h3>
    <a href="{{ route('users.index') }}" class="btn btn-sm btn-info ms-auto align-self-center">Regresar</a>
</div>

<div class="p-6 bg-white border-b border-gray-200">
    <table id="listLocations" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Region</th>
                <th>Comuna</th>
                <th>Addresd</th>
                <th>Latilude</th>
                <th>Longtitude</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Region</th>
                <th>Comuna</th>
                <th>Addresd</th>
                <th>Latilude</th>
                <th>Longtitude</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>


<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mapModal" id="locationMap"></div>
        <div id="fullAddress"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleCancelLocation()">Close</button>
        <button type="button" class="btn btn-primary" onclick="handleSaveLocation()">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('custom-scripts')
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
<script src="{{ asset('assets/src/users/list_locations.js') }}"></script>
@endpush

