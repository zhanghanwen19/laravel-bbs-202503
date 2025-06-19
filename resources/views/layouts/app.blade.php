<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon"
          href="https://assets-bwa.worldofwarcraft.blizzard.com/static/kazoo-favicon.f7ae41ccd221fd5ac67e68960a6498898eec4a98.svg">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php$settings = \App\Models\Setting::getSettingsFromCache();@endphp

    <title>@yield('title', $settings['site_name']->value ?? '')</title>

    <meta name="description" content="{{ $settings['seo_description']->value ?? 'Pandaria bbs' }}"/>
    <meta name="description" content="@yield('description', 'Pandaria bbs')"/>

    <meta name="keywords" content="{{ $settings['seo_keywords']->value ?? 'Pandaria bbs' }}"/>

    <!-- Use vite include styles and scripts. -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')

</head>

<body>
<div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

        @include('shared._messages')

        @yield('content')

    </div>

    @include('layouts._footer')
</div>

@includeWhen((auth()->check() && app()->isLocal()), 'layouts._impersonate')

@yield('scripts')
</body>
</html>
