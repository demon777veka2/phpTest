@extends('layout')

@section('title')Задание 1 @endsection

@section('main_content')

<div class="post-view" style=" margin:0 25% 0 25%; width:50%;">
@if(!isset($error))
        @foreach($review as $el)
            <div class="alert alert-warning">
                <h3>{{$el->hash}}    </h3> 
            </div>    
        @endforeach
@else
    <div class="alert alert-warning">
        {{$error}}
    </div>    
@endif

        
</div>



@endsection