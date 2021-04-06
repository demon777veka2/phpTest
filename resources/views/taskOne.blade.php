@extends('layout')

@section('title')Задание 1 @endsection

@section('main_content')


<div style="margin:0 auto; width:50%;float:left;  height: 800px">

  <form method="post" action="/addPasta" style="margin-left: 10%" >
    @csrf
    <div class="form-group" >
     <label for="exampleTextarea">Название пасты</label>
      <input type="text" class="form-control" id="pasta_name" name="pasta_name" style="width:300px" aria-describedby="emailHelp" placeholder="Введите пасту">
    </div>

    <div class="form-group">
      <label for="exampleTextarea">Текст</label>
      <textarea class="form-control" id="pasta_text" name="pasta_text" rows="3" style="width:500px"></textarea>
    </div>

    <div class="form-group">
        <label for="exampleSelect1">Ограничение доступа:</label>
        <select class="form-control" id="access_limiter" name="access_limiter" style="width:200px">
          <option>public</option>
          <option>unlisted</option>
          <option>private</option>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleSelect1">Срок хранения ссылки:</label>
        <select class="form-control" name="time_delete" id="time_delete" style="width:200px">
          <option>10 мин</option>
          <option>1 час </option>
          <option>3 часа</option>
          <option>1 день</option>
          <option>1 неделя</option>
          <option>1 месяц</option>
          <option>без ограничения</option>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleSelect1">Выбрать язык</label>
        <select class="form-control" id="language" name="language" style="width:200px">
          <option>C#</option>
          <option>php</option>
          <option>perl</option>
        </select>
    </div>

    <div class="form-group">
       <button style="width:100px">Отправить</button> 
    </div>
  </form>
</div>

<div style="float:left; width:300px; margin-top: 20px ;">
  <div style="border: 2px double black;">
    <h2 style="text-align: center; ">Пасты</h2>
    <div style="border: 1px double black">
      @foreach($tenOpenPast as $el)
                <div class="alert alert-warning" style="text-align: center; ">
                  <a href="{{$el->hash}}" > <h3>{{$el->pasta_name}}</h3></a>
                </div>    
      @endforeach
    </div>
  </div>

  
</div>
 @endsection