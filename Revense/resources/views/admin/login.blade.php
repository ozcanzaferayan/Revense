<!DOCTYPE html>
<html>
    <head>
        <title>{!! Config::get('global.siteName') !!}</title>
        <link rel="stylesheet" href="{!! URL::asset('style/adm.css') !!}" />
    </head>
    <body>
        {!! Form::open(array('route' => 'adminLoginSubmit', 'id' => 'loginForm', 'method' => 'post')) !!}
        <div class="formRow"> {!! Form::label('email', 'E-Posta', array('class' => 'awesome')) !!} </div>
        <div class="formRow"> {!! Form::text('email', 'example@gmail.com', array('class' => 'defaultTextBox')) !!} </div>
        <div class="formRow"> {!! Form::label('password', 'Şifre', array('class' => 'awesome')) !!} </div>
        <div class="formRow"> {!! Form::password('password', array('class' => 'defaultTextBox')) !!} </div>
        <div class="formRow"> {!! Form::submit('Giriş', array('class' => 'defaultButton')) !!} </div>
        {!! Form::close() !!}
    </body>
</html>