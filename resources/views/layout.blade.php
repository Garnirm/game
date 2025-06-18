<!doctype html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="domain" content="{{ config('app.url') }}">
        <meta name="robots" content="noindex, nofollow">

        @vite([ 'resources/sass/app.scss', 'resources/js/app.js' ])

        <title>Jeu</title>
    </head>

    <body style="height: 100vh;">
        <div id="app" style="height: 100%;">
            <layout :housing_consumption="{{ $housing_consumption }}"></layout>
        </div>
    </body>
</html>
<!-- End supervision -->