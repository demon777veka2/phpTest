@extends('layout')

@section('title')Авторизация @endsection

@section('main_content')


<div class="container" style=" margin:0 25% 0 25%; width:50%;">
   <div class="row" >

      <form method="post" action="/login">
       @csrf
         <div class="col-md-offset-3 col-md-6" style='width:700px'>
         <div style="color:red">{{ isset($error) ? $error : '' }}</div>
         
            <form class="form-horizontal">
               <span class="heading">АВТОРИЗАЦИЯ</span>
               <div class="form-group">
                  <input type="text" class="form-control" id="login" name="login" placeholder="Login" style="width:200px;">
                  <i class="fa fa-user"></i>
               </div>

               <div class="form-group help">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="width:200px;">
                  <i class="fa fa-lock"></i>
                  <a href="#" class="fa fa-question-circle"></a>
               </div>
               
              <a href="/login"><button type="submit" class="btn btn-default">ВХОД</button> </a>
               </div>
            </form>
         </div>
      </form>
   </div>
</div>


@endsection