@extends('layouts.master-layouts')

@section('title')
Edit Pray
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
                <h4 class="card-title mb-4">Edit Pray</h4>

                <form action="/pray/{{$record->id}}" method="POST">
                    {{csrf_field()}}  
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="id" value="{{$record->id}}">                 
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$record->title}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{$record->description}}">
                    </div>   
                    <div class="form-group">
                        <label for="religion_id">ReligionID</label>
                        <input type="number" class="form-control" id="religion_id" name="religion_id" value="{{$record->religion_id}}">
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