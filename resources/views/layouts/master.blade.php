<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title')</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- Custom CSS --}}
    <link href='/css/p4.css' type='text/css' rel='stylesheet'>
    {{-- Favicon --}}
    <link rel="icon" href="/images/books-icon.png">
    @stack('head')
</head>
<body>

@include('modules.nav')

<section id='container'>
    @yield('content')
</section>

<footer>
    &copy; {{ date('Y') }}
</footer>

@stack('body')

</body>
</html>