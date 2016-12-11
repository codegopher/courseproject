@extends('layouts.master')

@section('title', 'Регистрация')

@section('log-class', '')

@section('reg-class', 'active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Регистрация</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                    <div class="row col-md-8">

                        <div class="form-group">
                            <label for="realname" class="col-md-4 control-label">Имя</label>
                            <div class="col-md-6">
                                <input id="firstname" class="form-control" name="firstname">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="surname" class="col-md-4 control-label">Фамилия</label>
                            <div class="col-md-6">
                                <input id="surname" class="form-control" name="surname">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Логин</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Подтверждение</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row col-md-4">
                        <div class="form-group">
                            <label class="control-label">Область деятельности:</label>

@foreach ($htmldata as $el)
                                <div class="checkbox">
                                    <label>
                                        <input id="s{{$el->id}}" type="checkbox" name="subj[]" value="{{$el->id}}"> {{$el->name}}
                                    </label>
                                </div>
@endforeach

                        </div>                    
                    </div>

                    <div class="row col-md-4">
                        <div class="form-group">
                            <label class="control-label">Оповещения:</label>


                                <div class="checkbox">
                                    <label>
                                        <input id="email-notify" type="checkbox" name="email-notify"> E-mail
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input id="tlg-notify" type="checkbox" name="tlg-notify"> Telegram
                                    </label>
                                </div>

                        </div>                    
                    </div>

                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Зарегистрироваться
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
