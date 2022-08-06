@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong><label >Images</label></strong>
                    <br>
                    <label >Total Images : &nbsp </label> <strong>{{$count}}</strong>
                    <br>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="/imageupload" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">

                            <div class="custom-file">

                                <label class="custom-file-label" for="inputGroupFile01" > <strong> Choose Image</strong>
                                </label>
                                <br>
                                <br>
                                
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="image">
                                <br><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection