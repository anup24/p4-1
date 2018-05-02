<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ env('APP_URL') }}">@yield('title','Blind Date with a Book')</a>
        <div id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ env('APP_URL') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/translations">Translations <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ env('GITHUB_URL') }}" target='_blank'>GitHub</a>
                </li>
            </ul>
        </div>
    </nav>
</header>