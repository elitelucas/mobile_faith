@extends('layouts.master-layouts')

@section('title')
    Setting
@endsection

@section('css')

@endsection

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Change Admin Panel Password</h4>
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
                    <form action="/resetpassword" method="POST">
                        {{ csrf_field() }}
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
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection

@section('script')
    <script>

    </script>
@endsection
