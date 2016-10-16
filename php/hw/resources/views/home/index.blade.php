@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Солнце еще высоко</div>
                <div class="panel-body">
                    <p>Это - ваш личный кабинет.
                    Вы можете просмотреть <a href="/home/avaliable">доступные</a> Вам задачи, а также заняться активными заявками.</p>
                    <p>Опишите решение, прикрепите файл, если это необходимо, и закройте заявку, либо откажитесь от нее.</p>

@if(isset($htmldata[0]))
@foreach ($htmldata as $el)
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/task/'.$el->id) }}">
{{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <div class="row">
                                      <div class="col-md-2">
                                        Заявка # {{$el->id}}
                                      </div>
                                      <div class="col-md-6">
                                        Предмет: {{App\Subject::find($el->subject_id)->name}}
                                      </div>
                                      <div class="col-md-2">
                                            <button type="submit" class="btn btn-danger" name="action" value="refuse">Отказаться</button>
                                      </div>
                                      <div class="col-md-2">
                                            <button type="submit" class="btn btn-success" name="action" value="close">Закончить</button>
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


                                      <div class="row col-md-8">
                                          <div class="col-md-12">
                                            Описание:
                                          </div>
                                          <div class="col-md-12">
                                            <textarea placeholder="Опишите решение задачи" style="width:100%; height:100%;" name="solutiontext" value="solutiontext" rows="5"></textarea>
                                          </div>
                                      </div>

                                      <div class="row col-md-4">
                                          <div class="col-md-12">
                                            Файл решения:
                                          </div>
                                          <div class="col-md-12">
                                            <input type="file" name="solutionfile" data-bfi-disabled>
                                          </div>
                                      </div>

                                </div>

                            </div>
                        </div>

                    </form>
@endforeach
@else 
<p>Сейчас вы не решаете ни одной задачи.</p>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
