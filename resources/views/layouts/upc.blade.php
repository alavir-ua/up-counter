<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор компослуг</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

<!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap 4.3.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            height: 100%;

        }

        .page-content {
            flex: 1 0 auto;
        }

        #sticky-footer {
            flex-shrink: 0;
            padding-right: 30px;
        }

        /* Other Classes for Page Styling */

        body {
            background-image: url("{{asset('images/upc.jpg')}}");
            color: #ffffff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }

        button,
        button:active,
        button:focus {
            outline: none;
        }

        .mycard {
            opacity: 0.8;
            color: #000;
        }

        .alert-green {
            border-color: #1aff1a;
            color: #1aff1a;
        }

        .alert-red {
            border-color: #ff0000;
            color: #ff0000;
        }

        .icons {
            list-style-type: none;
        }

        .btn-list {
            font-size: 25px;
            margin-right: 10px;
            border-color: transparent;
            outline: none;
            transition: all 0.5s ease;
        }

        .icons__item {
            display: inline-block;
        }

        .icons__item a {
            text-decoration: none;
        }
    </style>
</head>
<body class="d-flex flex-column">
<div id="app" class="page-content">
    <main class="py-4">
        @yield('content')
    </main>
</div>
<footer id="sticky-footer" class="py-4">
    <div class="container text-right text-light">
        <small>Авторське право &copy; <?php
			$fromYear = 2017;
			$thisYear = (int)date('Y');
			echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');
			?>, Компанія Alavir & Ко. Всі права захищені.
        </small>
    </div>
</footer>
</body>
</html>
