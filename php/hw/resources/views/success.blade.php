@extends('layouts.master')

@section('title', 'Заявка добавлена!')

@section('content')
    <div class="container">
      <div class="page-header">
        <h1>Заявка добавлена</h1>
      </div>
      <p class="lead">Ваша заявка успешно поступила в обработку. Ждите ответа по e-mail или telegram.</p>
      <p>Прикрутить проверку статуса?</p>
      <p class="lead"><a href="/case">Оставить еще одну?</a></p>
    </div>
@endsection
