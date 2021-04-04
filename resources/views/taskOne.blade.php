@extends('layout')

@section('title')Задание 1 @endsection

@section('main_content')

<form method="post" action="/">

<div class="form-group">
<label for="exampleTextarea">Название пасты</label>
<input type="email" class="form-control" id="exampleInputEmail1" style="width:300px" aria-describedby="emailHelp" placeholder="Введите пасту">
</div>

<div class="form-group">
<label for="exampleTextarea">Текст</label>
<textarea class="form-control" id="exampleTextarea" rows="3" style="width:500px"></textarea>
</div>

<div class="form-group">
    <label for="exampleSelect1">Ограничение доступа:</label>
    <select class="form-control" id="exampleSelect1" style="width:200px">
      <option>public</option>
      <option>unlisted</option>
      <option>private</option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleSelect1">Срок хранения ссылки:</label>
    <select class="form-control" id="exampleSelect1" style="width:200px">
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
    <select class="form-control" id="exampleSelect1" style="width:200px">
      <option>public</option>
      <option>unlisted</option>
      <option>private</option>
    </select>
  </div>

  <div class="form-group">
  <button style="width:100px">Отправить</button> 
  </div>

</form>
 @endsection