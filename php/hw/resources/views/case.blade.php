@extends('layouts.master')

@section('title', 'Применение')

@section('case-class', 'active')

@section('content')
    <div class="container">

<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/task') }}">
{{ csrf_field() }}

  <div class="form-group">
    <label for="name" class="col-sm-4 control-label">Имя</label>
    <div class="col-sm-4">
      <input id="firstname" class="form-control" name="firstname" placeholder="Имя">
    </div>
  </div>

  <div class="form-group">
    <label for="sname" class="col-sm-4 control-label">Фамилия</label>
    <div class="col-sm-4">
      <input class="form-control" name="surname" placeholder="Фамилия">
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-sm-4 control-label">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control" name="email" placeholder="E-mail">
    </div>
  </div>

  <div class="form-group">
    <label for="num" class="col-sm-4 control-label">Телефон</label>
    <div class="col-sm-4">
      <input class="form-control" name="pnum" placeholder="Телефон">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="telegram_response" value="true"> Оповестить по telegram
        </label>
      </div>
    </div>
  </div>

 <div class="form-group">
   <div class="col-sm-offset-3 col-sm-5">
     <label for="comment">Описание:</label>
     <textarea class="form-control" rows="4" name="comment" value="comment"></textarea>
   </div>
</div>


 <div class="form-group">
  <div class="col-sm-offset-3 col-sm-5">
    <label for="subject">Предмет:</label>
    <select class="form-control" id="subject" name="subject">
    @foreach ($htmldata as $el)
      <option value="{{$el->id}}">{{$el->name}}</option>
    @endforeach
    </select>
  </div>
</div>

 <div class="form-group">
   <div class="col-sm-offset-4 col-sm-5">
	  <input type="file" name="taskfile" data-bfi-disabled>
	  <p class="help-block">Прикрепите фото, если нужно</p>
   </div>
 </div>

  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-2">
      <button type="submit" class="btn btn-default">Отправить</button>
    </div>
  </div>

</form>

    </div>
@endsection
