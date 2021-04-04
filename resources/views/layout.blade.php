<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/"><ya-tr-span data-index="1-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Home" data-translation="Задание 1" data-type="trSpan">Задание 1</ya-tr-span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/taskTwo"><ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Link" data-translation="Задание 2" data-type="trSpan">Задание 2</ya-tr-span></a>
          </li>
          <li class="nav-item" style="margin-left: 800px">
          <button>Вход</button> 
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
</header>

<main class="flex-shrink-0">
    <div class="countainer"  style="margin-top:70px;">
        @yield('main_content')
    </div>
</main>


</body>
</html>