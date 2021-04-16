@extends('layouts.master-layouts')

@section('title')
    User List
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('title') User Management @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success" href="/user/create">
                        <i class="bx bx-plus-circle"></i> Add User</a>
                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Praytime</th>
                                    <th>Invites</th>
                                    <th>DamID</th>
                                    <th>ReligionID</th>
                                    <th>Created Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $key => $record)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->email }}</td>
                                        <td>{{ $record->prayTime }}</td>
                                        <td>{{ $record->invites }}</td>
                                        <td>{{ $record->damID }}</td>
                                        <td>{{ $record->religionID }}</td>
                                        <td>{{ $record->created_at }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('user.edit', $record->id) }}">
                                                <i class="bx bx-edit"></i></a>
                                        </td>
                                        <td>
                                            <form action="/user/{{ $record->id }}" method="POST">
                                                {{ csrf_field() }}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit"> <i
                                                        class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->


@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });

    </script>
@endsection
