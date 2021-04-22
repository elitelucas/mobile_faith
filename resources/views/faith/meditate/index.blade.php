@extends('layouts.master-layouts')

@section('title')
    Sounds List
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('title') Sounds Management @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success" href="/meditate/create">
                        <i class="bx bx-plus-circle"></i> Add Sound</a>
                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title(English)</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Audio</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $key => $record)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $record->title['ENG'] }}</td>
                                        <td>
                                            @if ($record->locked)
                                                <span style="color:red; font-size:20px;"><i class="bx bx-lock"></i></span>
                                            @else
                                                <span style="color:green; font-size:20px;"><i
                                                        class="bx bx-lock-open"></i></span>
                                            @endif
                                        </td>
                                        <td><img src="{{ asset($record->image_path) }}" alt="" height="50"></td>
                                        <td><audio controls>
                                                <source src="{{ asset($record->audio_path) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio></td>
                                        <td>{{ $record->created_at }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('meditate.edit', $record->id) }}">
                                                <i class="bx bx-edit"></i></a>
                                        </td>
                                        <td>
                                            <form action="/meditate/{{ $record->id }}" method="POST">
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
