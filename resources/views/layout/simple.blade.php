<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.partials.head')
    </head>

    <body>
        <div id="app">
            @include('layout.partials.nav')
            @yield('breadcrumbs')
            <main>
                @yield('content')
            </main>

            @include('layout.partials.footer')
            @include('layout.partials.footer-scripts')
        </div>
    </body>
</html>
