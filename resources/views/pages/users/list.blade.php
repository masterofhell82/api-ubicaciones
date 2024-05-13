@extends('layout.index')


@push('plugin-styles')

<link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
@endpush

@section('content')
<h3>listemos los usuarios</h3>

<div class="p-6 bg-white border-b border-gray-200">
    <table id="listUser" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>

@endsection


@push('custom-scripts')
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
<script src="{{ asset('assets/src/users/list.js') }}"></script>
@endpush
