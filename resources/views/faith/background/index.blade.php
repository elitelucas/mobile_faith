@extends('layouts.master-layouts')

@section('title')
    Background List
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css') }}">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('title') Background Management @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success" href="/background/create">
                        <i class="bx bx-plus-circle"></i> Add Background</a>
                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Source</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $key => $record)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            <a class="image-popup-no-margins" href="{{ asset($record->path) }}">
                                                <img class="img-fluid" alt="" src="{{ asset($record->path) }}" width="100">
                                            </a>                                           
                                        </td>
                                        <td>{{ $record->created_at }}</td>                                        
                                        <td>
                                            <form action="/background/{{ $record->id }}" method="POST">
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
    <!-- Magnific Popup -->
    <script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>
    <!-- Lightbox init js -->
    <script src="{{ URL::asset('assets/js/pages/lightbox.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });

    </script>
@endsection
