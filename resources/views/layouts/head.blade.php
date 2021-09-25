<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="sci" href="{{ asset('/logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('/logo.png') }}" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="sci" />
    <meta name="keywords" content="pymes"/>
    <meta name="description" content="financiamiento pymes"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script language="JavaScript">
            function pregunta(){
                if (confirm('¿Estas seguro de enviar este formulario?')){
                document.tuformulario.submit()
                }
            }
    </script>
</head>
</html>
