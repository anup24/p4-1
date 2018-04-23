<!doctype html>
<html lang='en'>
<head>
    <title>{{ $title }}</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- Custom CSS --}}
    <link href='/css/p3_style.css' type='text/css' rel='stylesheet'>
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- Favicon --}}
    <link rel="icon" href="/images/books-icon.png">
    @stack('head')
</head>
<body>

@include('modules.nav')

<section>
    @yield('content')
</section>

<section>
    @yield('form')
</section>

<footer>
    &copy; {{ date('Y') }}
</footer>

@stack('body')

</body>
</html>