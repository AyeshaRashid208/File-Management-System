@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class= "form-group">
                    <a href="/image"><button type="button" href="{{ url('/image') }}" class="btn btn-primary btn-lg">Images</button> </a>
                    <label > &nbsp &nbsp &nbspTotal Size : &nbsp </label> <strong>{{$size}}</strong>
                    </div>
                    <br>
                    <div class= "form-group">
                    <a href="/vedio"><button type="button" href="{{ url('/vedio') }}" class="btn btn-primary btn-lg">Vedios</button> </a>
                    <label > &nbsp &nbsp &nbspTotal Size : &nbsp </label> <strong>{{$vedio_size}}</strong>
                    </div>
                    <br>
                    <div class= "form-group">
                    <a href="/document_upload"><button type="button"  class="btn btn-primary btn-lg">Document</button></a>
                    <label > &nbsp &nbsp &nbspTotal Size : &nbsp </label> <strong>{{$doc_size}}</strong>

                    </div>
                     <br>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection