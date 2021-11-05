<head>
@include('layouts.head')
@include('flash-message')
</head>
<header>
@include('layouts.header')
</header>

<body onload="carga()">
@include('layouts.main')

@if(Session::has('jsAlert'))
    @if(session('info'))
    {{ session('info') }}
    @endif
@endif


<!-- formularios de carga-->
<div class="grid grid-cols-1 w-4/5 rounded-md shadow-md overscroll-contain bg-gray-200  mx-2 my-2 px-2">
    <div class="bg-green-200">
            <div id="titulo01" style="display:none;" class="float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Cargue la indentificación del proyecto
            </div>
            <div id="titulo02" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Cargue los valores del proyecto
            </div>
            <div id="titulo03" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Otras variables del proyecto
            </div>
            <div id="titulo04" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Antecedentes, descripción y objetivos del proyecto
            </div>
            <div id="titulo05" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Variables del proyecto
            </div>

    </div>
    <!--formularios-->
    <div class="grid grid-cols-1">
        <form class="col-span-1" name="cargaProyecto" action="{{ route('pymes.cargaproyecto') }}" method="POST">
            @csrf
        <div class="bg-purple-200 w-full inline-block rounded-md px-1" id="parte1" style="display:none;">
            <!--primera parte-->
                <!-- idProy -->
                <div class="form-group">
                    <input id="idProy" hidden name="idProy" value="{{ $idLast }}" class="form-control" readonly required/>
                </div>
                <!-- fecha de referencia -->
                <div class="form-group mt-2 inline-block">
                    <label for="fechaReferencia" class="inline-block control-label align-top pt-1 w-32">Fecha de referencia:</label>
                    <div class="inline-block w-44">
                        <input type="date" name="fechaReferencia" class="bg-white rounded-md h-11 w-full rounded-md bg-white border-blue-300 w-full h-10" autofocus onchange = "validar(this.form)"/>
                    </div>
                </div>
                <!-- nombre proyecto -->
                <div class="form-group inline-block">
                    <label for="nombreProyecto" class="inline-block control-label align-top pt-2 w-32">Nombre del proyecto:</label>
                    <div class="inline-block w-96">
                    <textarea class="bg-white rounded-md h-20 w-full border-blue-300" name="nombreProyecto" autofocus onkeyup = "validar(this.form)"></textarea>
                    </div>
                </div>
                <!-- bienes q prod -->
                <div class="form-group inline-block">
                    <label for="bienesQueProduce" class="inline-block control-label align-top pt-2 w-32">Bienes que produce:</label>
                    <div class="inline-block w-96">
                        <textarea class="bg-white rounded-md h-28 w-full border-blue-300" name="bienesQueProduce" autofocus onkeyup = "validar(this.form)"></textarea>
                    </div>
                </div>
                <!-- garantías ofrecidas -->
                <div class="form-group inline-block">
                    <label for="garantiasOfrecidas" class="inline-block control-label align-top pt-1 w-32">Garantias ofrecidas:</label>
                    <div class="inline-block w-96">
                        <input name="garantiasOfrecidas" list="garantiasOfrecidas" class="form-multiselect rounded-md bg-white border-blue-300 w-full h-10" required onkeyup = "validar(this.form)"/>
                        <datalist id="garantiasOfrecidas">
                        @foreach($gtias as $garantiasOfrecidas => $op)
                            <option value="{{ $op }}" {{ (old("garantiasOfrecidas") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
        </div>
        <div class="bg-purple-200 w-2/3 inline-block" id="parte2" style="display:none;">
        <!--segunda parte-->
                <!-- bienes q prod -->
                <div class="form-group top-0 mt-2 inline-block">
                    <label for="destinoFondos" class="inline-block control-label align-top pt-2 w-32">Destino de los Fondos:</label>
                    <div class="inline-block w-96">
                        <textarea class="bg-white rounded-md h-28 w-full border-blue-300" name="destinoFondos" autofocus onkeyup = "validar2(this.form)"></textarea>
                    </div>
                </div>
                <!-- montoTotal -->
                <div class="form-group inline-block">
                    <label for="montoTotal" class="inline-block control-label w-32">Monto solicitado:</label>
                    <div class="inline-block w-96">
                        <input class="bg-white rounded-md h-11 w-full border-blue-300 px-1"  type="number" step="0.1" name="montoTotal" required autofocus onkeyup = "validar2(this.form)"/>
                    </div>
                </div>
                <!-- inversionTotal -->
                <div class="form-group inline-block">
                    <label for="inversionTotal" class="inline-block control-label align-top pt-1 w-32">Inversión total:</label>
                    <div class="inline-block w-96">
                        <input class="bg-white rounded-md h-11 w-full border-blue-300 px-1"  type="number" step="0.1" name="inversionTotal" required autofocus onchange = "monInversion(this.form)" onkeyup = "validar2(this.form)"/>
                        <input name="relMonInv" hidden="hidden" disable class="text-red-400 font-thin size-xs w-full">
                    </div>
                </div>
                <!-- personalOcupado -->
                <div class="form-group inline-block">
                    <label for="personalOcupado" class="inline-block control-label w-32">Personal ocupado:</label>
                    <div class="inline-block w-96">
                        <input class="bg-white rounded-md h-11 w-full border-blue-300 px-1"  type="number" name="personalOcupado" autofocus/>
                    </div>
                </div>
        </div>
        <div class="bg-purple-200 w-2/3 inline-block" id="parte3" style="display:none;">
        <!--tercera parte-->
                <!-- ciiuCs -->
                <div class="form-group mt-2 inline-block">
                    <label for="ciiuCs" class="inline-block control-label w-32">Código actividad: </label>
                    <div class="inline-block w-20">
                        <input name="ciiuCs" id="ciiuCs" class="bg-white rounded-md h-11 w-full border-blue-300 px-1" onchange = "validar3(this.form)"/>
                    </div>
                    <div class="inline-block w-30">
                        <button type="button" class="bg-black hover:bg-gray-500 text-white font-bold mx-2 py-2 px-2 rounded-md" onclick="pegarciiu()">Pegar código</button>
                    </div>
                    <div class="inline-block w-30">
                        <a class="bg-blue-600 hover:bg-purple-500 text-white font-bold py-2 px-2 rounded-md" href="{{ route('pymes.ciiusearch') }}" target="_blank">Buscar código</a>
                    </div>
                </div>
                <!-- tipo Moneda -->
                <div class="form-group inline-block">
                    <label for="ciiuCs" class="inline-block control-label w-32">Tipo de moneda:</label>
                    <div class="inline-block w-96">
                        <select name="moneda" id="moneda" class="form-multiselect block rounded-md border-blue-300 shadow-sm mt-1 w-full" onchange = "validar3(this.form)">
                        <option value=""></option>
                        @foreach($dfmoney as $id => $mon)
                            <option value="{{ $id }}" {{ (old("moneda") == $mon ? "selected":"") }}>{{ $mon }}</option>
                        @endforeach
                        </select>
                        @error('moneda')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- tipo de Cambio -->
                <div class="form-group inline-block">
                    <label for="tipodeCambio" class="inline-block control-label w-32">Tasa de cambio:</label>
                    <div class="inline-block w-96">
                        <input class="bg-white rounded-md h-11 w-full border-blue-300 px-1"  type="number" step="0,01" name="tipodeCambio" required autofocus onchange = "validar3(this.form)"/>
                    </div>
                </div>
        </div>
        <div class="bg-purple-200 w-2/3 inline-block" id="parte4" style="display:none;">
                <!-- descripcionProyecto -->
                <label for="descripcionProyecto" class="control-label">Descripcipón del proyecto</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1" name="descripcionProyecto" autofocus></textarea>
                <!-- antecentes -->
                <label for="antecedentes" class="control-label">Antecedentes - reseña histórica</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1" name="antecentes" autofocus></textarea>
                <!-- justificacion -->
                <label for="justificacion" class="control-label">Justificación o fundamentos del proyecto</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1" name="justificacion" autofocus></textarea>
                <!-- tasacion  -->
                <label for="tasacion" class="control-label">Tasación estimada del bien ofrecido en garantía</label>
                <input class="bg-white rounded-md h-11 w-full border-blue-300 px-1" name="tasacion" autofocus>
                <!-- nroPartida -->
                <label for="nroPartida" class="control-label">Numero de partida</label>
                <input class="bg-white rounded-md h-11 w-full border-blue-300 px-1" name="nroPartida" autofocus>
                <!-- nroMatricula -->
                <label for="nroMatricula" class="control-label">Número de matrícula</label>
                <input class="bg-white rounded-md h-11 w-full border-blue-300 px-1" name="nroMatricula" autofocus>
        </div>
            <div id="enviar" style="display:none;" class="pull-right py-2 px-2">
                    <button  id="guardar" disabled="disabled" type="submit" class="bg-black hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md">Guardar</button>
            </div>

        <!--botones siguiente / anterior -->
            <div id="siguiente1" style="display:none;" class="pull-right py-2">
                <button type="button" class="btn btn-primary" onclick="siguiente1()">Siguiente</button>
            </div>
            <div id="anterior1" style="display:none;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="anterior1()">Anterior</button>
            </div>
            <div id="siguiente2" style="display:none;" class="pull-right py-2">
                <button type="button" class="btn btn-primary" onclick="siguiente2()">Siguiente</button>
            </div>
            <div id="siguiente3" style="display:none;" class="pull-right pr-4 py-2">
                <button type="button" class="bg-gray-600 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-md" onclick="siguiente3()">Mas...</button>
            </div>
            <div id="anterior2" style="display:none;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="anterior2()">Anterior</button>
            </div>
            <div id="anterior3" style="display:none;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="anterior3()">Anterior</button>
            </div>

            <div id="cancelar1" style="display:none;" class="pull-right py-2 px-4">
                    <a href="{{ route('pymes.cargaproyecto') }}" id="cancelar" class="btn btn-warning" onclick="cancelar1()">Borrar</a>
            </div>

        </form>
</div>

</body>
<script src="{{ asset('/js/proyectos.js') }}"> </script>
<script>
    xcuit =  "<?php echo session('xcuit') ?>";
</script>


<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
