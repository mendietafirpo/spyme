<head>
@include('layouts.head')
@include('flash-message')
</head>
<header>
@include('layouts.header')
</header>

<body>
@include('layouts.main')

@if(Session::has('jsAlert'))
    @if(session('info'))
    {{ session('info') }}
    @endif
@endif


<!-- formularios de carga-->
<div class="grid grid-cols-1 w-4/5 rounded-md shadow-md overscroll-contain bg-gray-200  mx-2 my-2 px-2">
    <div class="bg-green-200">
            <div id="titulo01" style="display:block;" class="float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Carge los datos del expediente
            </div>

    </div>
    <!--formularios-->
    <div class="grid grid-cols-1">
        <form class="col-span-1" name="cargatramite" action="{{ route('pymes.cargatramite') }}" method="POST">
            @csrf
        <div class="bg-purple-200 w-96 inline-block rounded-md px-1" id="parte1" style="display:block;">
            <!--primera parte-->
                <!--ocultos-->
                <input name="id" hidden value="{{ $idLast }}" class="form-control" readonly required />
                <!-- idProy -->
                <input id="idProy" hidden name="idProy" value="{{ $idProy }}" class="form-control" readonly required/>
                <!-- operatoria programa -->
                <!-- fecha presentación idea  proyecto -->
                <div class="form-group mt-2 inline-block">
                    <label for="presentacionIdeaProy" class="inline-block control-label align-top pt-1 w-32">Fecha de presentación:</label>
                    <div class="inline-block w-44">
                        <input type="date" name="presentacionIdeaProy" class="bg-white rounded-md h-11 w-full rounded-md bg-white border-blue-300 w-full h-10" autofocus onchange = "validar(this.form)"/>
                    </div>
                </div>
                <!-- fecha de consulta sujeto credito -->
                <div class="form-group mt-2 inline-block">
                    <label for="consultaAgenteFinan" class="inline-block control-label align-top pt-1 w-32">Consulta banco (sujeto crédito):</label>
                    <div class="inline-block w-44">
                        <input type="date" name="consultaAgenteFinan" class="bg-white rounded-md h-11 w-full rounded-md bg-white border-blue-300 w-full h-10" autofocus onchange = "validar(this.form)"/>
                    </div>
                </div>
                <!-- fecha del informe sujeto de crédito -->
                <div class="form-group mt-2 inline-block">
                    <label for="informeSujetoCredito" class="inline-block control-label align-top pt-1 w-32">Informe sujeto de crédito:</label>
                    <div class="inline-block w-44">
                        <input type="date" name="informeSujetoCredito" class="bg-white rounded-md h-11 w-full rounded-md bg-white border-blue-300 w-full h-10" autofocus onchange = "validar(this.form)"/>
                    </div>
                </div>
                <!-- sujeto de crédito -->
                <div class="form-group inline-block">
                    <label for="sujetoCredito" class="inline-block control-label align-top pt-1 w-32">Resultado Sujeto d crédito:</label>
                    <div class="inline-block w-44">
                        <input name="sujetoCredito" list="sujetoCredito" class="form-multiselect rounded-md bg-white border-blue-300 w-full h-10" onkeyup = "validar(this.form)"/>
                        <datalist id="sujetoCredito">
                        @foreach($sujetocred as $sujetoCredito => $op)
                            <option value="{{ $op }}" {{ (old("sujetoCredito") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
                <!-- fecha de remisión organismo -->
                <div class="form-group mt-2 inline-block">
                    <label for="remisionOrganismo" class="inline-block control-label align-top pt-1 w-32">Remisión organismo:</label>
                    <div class="inline-block w-44">
                        <input type="date" name="remisionOrganismo" class="bg-white rounded-md h-11 w-full rounded-md bg-white border-blue-300 w-full h-10" autofocus onchange = "validar(this.form)"/>
                    </div>
                </div>

            </div>
            <div id="enviar" style="display:none;" class="pull-right py-2 px-2">
                    <button  id="guardar" disabled="disabled" type="submit" class="bg-black hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md">Guardar</button>
            </div>

        <!--botones siguiente / anterior -->
            <div id="cancelar1" style="display:none;" class="pull-right py-2 px-4">
                    <a href="{{ route('pymes.cargatramite') }}" id="cancelar" class="btn btn-warning" onclick="cancelar1()">Borrar</a>
            </div>

        </form>
</div>

</body>
<script src="{{ asset('/js/tramite.js') }}"> </script>

<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
