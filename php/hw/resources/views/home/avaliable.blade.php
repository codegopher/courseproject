@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Доступные заявки</div>
                <div class="panel-body">
                    <p>Вы можете приняться за решение следующих задач:</p>
                    
@if(isset($htmldata[0]))
@foreach ($htmldata as $el)
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/task/'.$el->id) }}">
{{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                      <div class="col-md-2">
                                        Заявка # {{$el->id}}
                                      </div>
                                      <div class="col-md-8">
                                        Предмет: {{$el->name}}
                                      </div>
                                      <div class="col-md-2">
                                            <button type="submit" class="btn btn-default" name="action" value="take">В работу</button>
                                      </div>
                                    </div>
                                </div>

                                <div class="panel-body">

                                      <div class="row col-md-8">
                                          <div class="col-md-12">
                                            Описание: 
                                          </div>
                                          <div class="col-md-12">
                                            <textarea style="width:100%; height:100%;" name="comment" value="comment" disabled="true" rows="5">{{$el->tasktext}}
                                            </textarea>
                                          </div>
                                      </div>

                                      <div class="row col-md-4">
                                          <div class="col-md-12">
                                            Файл:
                                          </div>
                                          <div class="col-md-12">
                                            {{$el->taskfile}}
                                          </div>
                                          <div class="col-md-12">
                                            Заявка от:
                                          </div>
                                          <div class="col-md-12">
                                            {{$el->created_at}}
                                          </div>
                                      </div>
                                </div>

                            </div>
                        </div>

                    </form>
@endforeach
@else
<p>Сейчас для Вас нет доступных задач.</p>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
