<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('preferences.identity.name') }}</title>
        <meta name="description" content="{{ config('preferences.identity.description') }}" inertia="description">        

        <!-- Icon -->
        <link rel="icon" href="{{ asset(config('preferences.identity.icon_file')) }}" />

        <!-- Color -->
        <meta name="theme-color" content="{{ config('preferences.identity.accent_color') }}" >

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=montserrat:100,200,300,400,400i,500,600,700,800,900" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

        <!-- TODO: LOL, style tag breaks linter -->
        <{{ 'style' }}>
            :root {
                @foreach(getAppColorPallete() as $step => $color)
                    --color-{{ $step }}: {{ $color }};
                @endforeach
            }
        <{{ '/style'}}>

        <!-- Analytics -->
        @if(config('preferences.analytics.google_analytics'))
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('preferences.analytics.google_analytics') }}"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }

                gtag('js', new Date());
                gtag('config', "{{ config('preferences.analytics.google_analytics') }}");
            </script>
        @endif
    </head>
    <body class="font-sans antialiased">
        @inertia
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    </body>
</html>
