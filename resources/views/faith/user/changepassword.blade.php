@extends('layouts.master-layouts')

@section('title')
    Edit User
@endsection

@section('css')
    <!-- Summernote css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/summernote/summernote.min.css') }}">
@endsection

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Change User[{{$record->name}}] Password</h4>
                    @if (!empty($success))
                        <div class="alert alert-success" role="alert">
                            {{ $success }}
                        </div>
                    @endif
                    @if (!empty($error))
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endif
                    <form action="/user/updatepassword" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $record->id }}">
                        <div class="form-group">
                            <label for="title">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password">
                        </div>
                        <div class="form-group">
                            <label for="description">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                            <a href="/user" class="btn btn-success w-md">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->


@endsection

@section('script')
    <!-- Summernote js -->
    <script src="{{ URL::asset('assets/libs/summernote/summernote.min.js') }}"></script>

    <script>
        $(".summernote").summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: !0
        });

    </script>
@endsection
