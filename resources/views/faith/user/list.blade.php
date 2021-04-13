@extends('layouts.master-layouts')

@section('title')
User
@endsection

@section('content')


<h1 class="text-primary mb-5 text-center">User List</h1>

@foreach($records as $record)
<div class="row">    
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-7">
                                <h4 class="card-title"><i>{{$record->title}}</i></h4>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection

@section('script')

@endsection