@extends('layouts.master-layouts')

@section('title')
    Add Sound
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
                    <h4 class="card-title mb-4">Add Sound</h4>

                    <form action="/meditate" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            @foreach (Config::get('constants.languages') as $language)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Title({{ $language['name'] }})</label>
                                        <input type="text" class="form-control" name="title_{{$language['code']}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="formrow-firstname-input">Thumbnail Image</label>
                            <input type="file" name="thumbnail_file" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="formrow-firstname-input">Background Image</label>
                            <input type="file" name="image_file" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="formrow-firstname-input">Audio File</label>
                            <input type="file" name="audio_file" accept="audio/*" required>
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
