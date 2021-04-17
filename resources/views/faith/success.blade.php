@extends('layouts.master-without-nav')

@section('title')
    Success
@endsection

@section('body')

    <body>
    @endsection

    @section('content')

        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h4 class="text-uppercase">Success</h4>
                            <h6 class="text-center">{{ $message }}</h6>
                        </div>
                    </div>
                </div>             
            </div>
        </div>

    @endsection
