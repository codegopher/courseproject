@extends('layouts.master')

@section('title', 'Главная')

@section('main-class', 'active')

@section('content')
    <div class="container">
      <div class="page-header">
        <h1>Добро пожаловать!</h1>
      </div>
      <p class="lead">Здесь вы можете найти себе репетитора для решения любой задачи. Для этого <a href="/case">оставьте заявку</a></p>
      <p class="lead">Вы-репетитор? <a href="/case">Включайтесь</a> в работу и помогайте другим!</p>
    </div>
@endsection
