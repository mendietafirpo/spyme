<head>
@include('layouts.head')
</head>
<header>
@include('layouts.header')
</header>

<body>
@include('layouts.main')
<!--encabezado-->
<div class="grid grid-cols-1 w-3/4 h-1/6 flex flex-wrap content-start mx-2 my-2">
<div class="bg-red-200 text-center w-3/7 h-1/8"> Uso exclusivo para integrantes de la ueperios </div>
<!--<div class="bg-white-200 text-center w-3/7 h-1/8"> /// </div>
<div class="bg-blue-200 text-center w-3/7 h-1/8"> Argentina </div>-->
</div>

<!--caja principal-->
<div class="relative flex items-left justify-top min-h-screen bg-gray-200 dark:bg-gray-900 sm:items-center sm:mx-2 my-2 sm:pt-100">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-left pt-8 sm:justify-start sm:pt-0">
        </div>

    </div>
</div>
</body>
<footer>
    @include('layouts.main')
    @include('layouts.foo-ueperios')
</footer>
