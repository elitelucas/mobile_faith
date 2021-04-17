@extends('layouts.master-layouts')

@section('title')
Edit Sound
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
                <h4 class="card-title mb-4">Edit Meditate</h4>

                <form action="/meditate/{{$record->id}}" method="POST"  enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="id" value="{{$record->id}}">                 
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$record->title}}">
                    </div>  
                    <div class="form-group">
                        <label for="formrow-firstname-input">Image File(Upload again only when want to update)</label>                          
                        <input type="file" name="image_file" accept="image/*" >
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Audio File(Upload again only when want to update)</label>                          
                        <input type="file" name="audio_file" accept="audio/*" >
                    </div>                 
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="locked"
                            name="locked" @if($record->locked) checked @endif>
                        <label class="custom-control-label" for="locked">Lock Meditate</label>
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