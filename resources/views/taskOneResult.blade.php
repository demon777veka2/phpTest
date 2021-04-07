@extends('layout')

@section('title')Задание 1 @endsection

@section('main_content')

<div class="post-view">
    @if(!isset($error))
    @foreach($review as $el)
    <div style="margin:0 auto; width:50%;float:left;  height: 800px; padding-left: 10%">
        <div class="form-group">
            <label for="exampleTextarea">Название пасты</label>
            <input type="text" value="{{$el->pasta_name}}" class="form-control" style="width:300px">
        </div>

        <label for="exampleTextarea">Текст</label>
        <pre style="width:750px"><code class="{{$el->language}}" >
                  {{$el->pasta_text}}
            </code></pre>

        <div class="form-group">
            <label for="exampleSelect1">Ограничение доступа:</label>
            <select class="form-control" style="width:200px">
                <option>{{$el->access_limiter}} </option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleSelect1">Выбрать язык</label>
            <select class="form-control" id="language" name="language" style="width:200px">
                <option>{{$el->language}}</option>

            </select>
        </div>
    </div>
    @endforeach

    <div style="width:400px;float:left">
        @if(isset($myPasta))
        <div style="float:left; width:300px; margin-top: 20px ;">
            <div style="border: 2px double black;">
                <h2 style="text-align: center; ">Мои пасты</h2>
                <div style="border: 1px double black">
                    @foreach($myPasta as $el)
                    <div class="aslert alert-warning" style="text-align: center;  ">
                        <a href="{{$el->hash}}">
                            <h3>{{$el->pasta_name}}</h3>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div style="margin-left:10%">{{$myPasta->links()}}</div>
        </div>
        @endif

        <div style="float:left; width:300px; margin-top: 20px ;">
            <div style="border: 2px double black;">
                <h2 style="text-align: center; ">Пасты</h2>
                <div style="border: 1px double black">
                    @foreach($tenOpenPast as $el)
                    <div class="aslert alert-warning" style="text-align: center;  ">
                        <a href="{{$el->hash}}">
                            <h3>{{$el->pasta_name}}</h3>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    @else
    <div class="alert alert-warning">
        {{$error}}
    </div>
    @endif

</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"></script>
<script>
    hljs.highlightAll();
</script>

@endsection