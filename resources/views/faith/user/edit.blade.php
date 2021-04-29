@extends('layouts.master-layouts')

@section('title')
Edit User
@endsection

@section('css')
@endsection

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit User</h4>

                <form action="/user/{{$record->id}}" method="POST">
                    {{csrf_field()}}  
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="id" value="{{$record->id}}">                 
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$record->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$record->email}}">
                    </div>        
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" @if ($record->is_active) checked @endif>
                        <label class="custom-control-label" for="is_active">Activate/Block</label>
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