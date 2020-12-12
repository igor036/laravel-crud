<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ url('fontawesome/css/brands.css') }}" rel="stylesheet">
        <link href="{{ url('fontawesome/css/solid.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }
            th {
                width: 200px;
                text-align: center;
            }
            td {
                text-align: center;
            }
        </style>
    </head>
    <body class="antialiased">

        @yield('content')

    </body>
</html>
