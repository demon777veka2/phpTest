@extends('layout')

@section('title')Задание 1 @endsection

@section('main_content')

<div class="post-view">

        @foreach($review as $el)
            <div class="alert alert-warning">
                <h3>{{$el->hash}}    </h3> 
            </div>    
        @endforeach
        
</div>



@endsection