@extends('layouts.master-layouts')

@section('title')
    Pray List
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('title') Pray Management @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <a class="btn btn-success" href="/pray/create">
                        <i class="bx bx-plus-circle"></i> Add Pray</a> --}}
                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $key => $record)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ @$record->user->name }}</td>
                                        <td>{{ $record->title }}</td>
                                        <td>{{ $record->description }}</td>
                                        <td>{{ $record->created_at }}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('pray.edit', $record->id) }}">
                                                <i class="bx bx-edit"></i></a>
                                        </td>
                                        <td>
                                            <form action="/pray/{{ $record->id }}" method="POST">
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
