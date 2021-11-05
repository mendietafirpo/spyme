
    <!-- Bootstrap CSS-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
-->
@include('layouts.head_notas')
<body>
        <!--logo y encabezado-->
<div class="bg-red-700 w-96 ml-10">
    que pasa
</div>

<div class="grid grid-cols-11 h-32 w-96 ml-4 mt-6">
    <div class="inline-block col-span-2 bg-gray-400">
    Logo 1
    </div>
    <div class="inline-block col-span-7 bg-gray-200 text-center font-serif">
        <div class="inline-block size-base"> Secretaría General de la Gobernación</div>
        <div class="inline-block size-base w-96"> Unidad Operadora Provincial – CFI</div>
        <div class="inline-block mb-4 size-base"> cfierios@gmail.com </div>
        <div class="inline-block bg-gray-200 text-center font-sans">
            <div class="inline-block">“2021-Año del Bicentenario de la Muerte del Caudillo Francisco Ramírez”-</div>
        </div>
    </div>
    <div class="inline-block col-span-2 bg-gray-600">
    Logo 2
    </div>
</div>
<!--fecha-->
<div class="grid grid-cols-1 bg-white h-8 w-3/4 ml-4 pr-2 mt-2 text-right">
<a>Paraná, dias del mes del año</a>
</div>
<!--remitente-->

<div class="grid grid-cols-6 h-96 w-4/5 ml-4">

            <div class="inline-block col-span-1">
                <div class="inline-block">Cuit: </div>
            </div>
            <div class="inline-block col-span-3 mx-2">
                <div class="inline-block">Razon Social: </div>
            </div>
            <div class="inline-block col-span-2">
                <div class="inline-block">Ciudad: </div>
            </div>

<div class="text-center pdf-btn">
                  <a href="{{ route('pdf.generate') }}" class="btn btn-primary">Generate PDF</a>
</div>

</div>
</body>
