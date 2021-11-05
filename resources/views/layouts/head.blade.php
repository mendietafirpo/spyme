<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="sci" href="{{ asset('/logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('/logo.png') }}" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="spyme" />
    <meta name="keywords" content="pymes"/>
    <meta name="description" content="financiamiento pymes"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
</head>
</html>
