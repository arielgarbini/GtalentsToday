<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('app.page_not_found')</title>

    {!! HTML::style('assets/css/materialize.min.css') !!}
    {!! HTML::style('assets/css/style.css') !!}

</head>

<body class="body404">

    <section class="body404-text">
        <h3>WHOOOOPS</h3>
        <h1>ERROR 404</h1>
        <p class="p404">@lang('app.message_error404') 
            <br>@lang('app.thanks')
        </p>
        <div class="body404-text-button">
            <a href="{{ URL('/') }}" class="btn-main">@lang('app.back_to') {{ settings('app_name') }}</a>
        </div>
    </section>
</body>
</html>