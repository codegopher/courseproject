<!-- Template -->

{{-- Comment --}}

<!DOCTYPE HTML>
<html>
  <head>

  <meta charset="utf-8">
    <title>Курсач - @yield('title')</title>
    
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link href="/css/sticky-footer.css" rel="stylesheet" type="text/css"> <!-- local -->

    <!-- link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"
    rel="stylesheet" -->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- script src="js/titlechange.js"></script --> <!-- self-made, local -->
    <!-- Placed here because being needed before loading of the whole page -->

  </head>
  <body>

      <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Курсовой проект</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul id="header_navlist" class="nav navbar-nav">
            <li class= "@yield('main-class')"><a href="/">Главная</a></li>
            <li class="@yield('about-class')"><a href="/about">О проекте</a></li>
            <li class="@yield('cont-class')"><a href="/contact">Контакты</a></li>
            <li class="@yield('case-class')"><a href="/case">Оставить заявку</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class= "@yield('log-class')"><a href="{{ url('/login') }}">Войти</a></li>
                        <li class= "@yield('reg-class')"><a href="{{ url('/register') }}">Зарегистрироваться</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выйти</a></li>
                                <li><a href="{{ url('/home') }}"><i class="fa fa-btn fa-sign-out"></i>Личная страница</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<!-- Container inside -->
      @yield('content')
<!-- End of content -->

      <div id="footer">
        <div class="container">
          <p class="text-muted">Москва, 2016</p>
        </div>
      </div>

<!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  </body>
</html>

<!-- End of template -->