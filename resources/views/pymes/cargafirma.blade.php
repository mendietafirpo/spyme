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

    <!--verificar existencia cuit / razonSocial -->
    <div class="bg-red-200 w-1/3 rounded-md shadow-sm overscroll-contain mx-2 my-2 px-2">
        <form class="inline-block" name="verificar" action="{{ route('pymes.cargafirma',  ['frm' => 1]) }}" method="GET">
            <!-- ¿cuit? -->
            <div class="space-x-4 my-2">
                <label for="cuit" class="inline-block w-32 control-label">Cuit / dni:</label>
                <div class="inline-block">
                    <input id="xcuit" minlength="7" maxlength="11" name="xcuit" class="form-control rounded-md bg-white border-gray-300 w-36 h-10 px-2" required onkeyup = "chequear(this.form)"/>
                </div>
                <div id="xcuit" style="display:block;" class="inline-block">
                    <button  id="vercuit" disabled="disabled" type="submit" class="btn btn-black" onclick="">Verificar</button>
                </div>
            </div>
        </form>
    </div>
    <!--fin verificar-->

    <!-- formularios de carga-->
    <div class="grid grid-cols-1 gap-3 w-4/5 rounded-md shadow-md overscroll-contain bg-gray-200  mx-2 my-2 px-2">
        <div class="bg-green-200">
                <div id="titulo01" style="display:none;" class="float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
                Cargue los datos indentificatorios de la firma
                </div>
                <div id="titulo02" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
                Cargue los datos de contacto de la firma
                </div>
                <div id="titulo03" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
                Cargue los datos de localización de la firma
                </div>
        </div>
        <!--formularios-->
        <div class="flex">
            <form name="cargaFirma" hidden="hidden" action="{{ route('pymes.cargafirma') }}" method="POST">
                @csrf
            <div class="bg-purple-200 w-2/3 inline-block rounded-md px-1" id="parte1" style="display:block;">
                <!--primera parte-->
                <!-- idFirma -->
                <div class="form-group">
                    <input id="idFirma" hidden name="idFirma" value="{{ $idLast }}" class="form-control" readonly required/>
                </div>
                <!-- cuit -->
                <div class="form-group mt-2 inline-block">
                    <label for="cuit" class="inline-block control-label w-32">Cuit:</label>
                    <div class="inline-block w-32">
                        <input id="cuit" minlength="11" maxlength="11" name="cuit" class="form-control rounded-md bg-white border-gray-300 w-full h-10 px-2" required  onkeyup = "validar(this.form)"/>
                    </div>
                    <div id="msjcuit" class="inline-block font-thin ml-2 text-red-400 pull-right" style="display:none;">
                        <p> ¡el cuit debe tener 11 catacteres! </p>
                    </div>
                </div>
                <!-- razon social -->
                <div class="form-group mt-2 inline-block">
                    <label for="razonSocial" class="inline-block control-label w-32">Razon Social:</label>
                    <div class="inline-block w-96">
                        <input name="razonSocial" list="razonSocial" class="form-multiselect rounded-md bg-white border-gray-300 w-full h-10 px-2" required  onchange = "validar(this.form)"/>
                        <datalist id="razonSocial">
                        @foreach($rsoc as $razonSocial => $op)
                            <option value="{{ $op }}" {{ (old("razonSocial") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>

                    </div>
                </div>
                <!-- fecha de fundacion -->
                <div class="form-group mt-2 inline-block">
                    <label for="fechaFundacion" class="inline-block control-label w-32">Fecha de fundación:</label>
                    <div class="inline-block w-60">
                        <input id="fechaFundacion" type="date" name="fechaFundacion" class="form-control rounded-md bg-white border-gray-300 w-full h-10 px-2"/>
                    </div>
                </div>
                <!-- forma juridica -->
                <div class="form-group mt-2 inline-block">
                    <label for="formaJuridica" class="inline-block control-label w-32">Forma Jurídica:</label>
                    <div class="inline-block w-60">
                        <select name="formaJuridica" id="formaJuridica" class="form-multiselect rounded-md bg-white border-gray-300 w-full h-10 px-2" onchange = "validar(this.form)">
                        <option value=""></option>
                        @foreach($dffjur as $id => $fj)
                            <option value="{{ $id }}" {{ (old("formaJuridica") == $fj ? "selected":"") }}>{{ $fj }}</option>
                        @endforeach
                        </select>
                        @error('formaJuridica')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- situacion afip -->
                <div class="form-group mt-2 inline-block">
                    <label for="situacionAfip" class="inline-block control-label w-32">Situación Afip:</label>
                    <div class="inline-block w-60">
                        <select name="situacionAfip" id="situacionAfip" class="form-multiselect rounded-md bg-white border-gray-300 w-full h-10 px-2">
                        <option value=""></option>
                            @foreach($dfafip as $id => $afip)
                                <option value="{{ $id }}" {{ (old("situacionAfip") == $afip ? "selected":"") }}>{{ $afip }}</option>
                            @endforeach
                            </select>
                            @error('situacionAfip')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="bg-purple-200 w-2/3 inline-block" id="parte2" style="display:none;">
            <!--segunda parte-->
                <!-- telefono -->
                <div class="form-group mt-2 inline-block">
                    <label for="telefono" class="inline-block control-label w-32">Teléfono:</label>
                    <div class="inline-block w-80">
                        <input id="telefono" type="tel" name="telefono" class="form-control rounded-md bg-white border-gray-300 w-full h-10 px-2" required onkeyup = "validar2(this.form)"/>
                    </div>
                </div>
                <!-- telefono altern-->
                <div class="form-group inline-block">
                    <label for="telefono_op" class="inline-block control-label w-32">Teléfono alternativo: </label>
                    <div class="inline-block w-80">
                        <input id="telefono_op" type="tel" name="telefono_op" class="form-control rounded-md bg-white border-gray-300 w-full h-10 px-2"/>
                    </div>
                </div>
                <!-- email -->
                <div class="form-group inline-block">
                <label for="enail" class="inline-block control-label w-32">Email:</label>
                    <div class="inline-block w-80">
                        <input id="email" type="email" name="email" class="form-control rounded-md bg-white border-gray-300 w-full h-10 px-2" required onkeyup = "validar2(this.form)"/>
                    </div>
                </div>
                <!-- email altern -->
                <div class="form-group inline-block">
                    <label for="email_op" class="inline-block control-label w-32">Email alternativo:</label>
                    <div class="inline-block w-80">
                        <input id="email_op" type="text" name="email_op" class="form-control rounded-md bg-white border-gray-300 w-full h-10 px-2"/>
                    </div>
                </div>
            </div>
            <div class="bg-purple-200 w-2/3 inline-block" id="parte3" style="display:none;">
            <!--tercera parte-->
                <!-- direccion legal-->
                <div class="form-group mt-2 inline-block">
                    <label for="direccionLegal" class="inline-block control-label w-32">Dirección Legal: </label>
                    <div class="inline-block w-96">
                        <input id="direccionLegal" type="text" name="direccionLegal" class="form-control rounded-md bg-white border-gray-300 w-full h-10 px-2"/>
                    </div>
                </div>
                <!--ciudad-->
                <div class="form-group mt-2 inline-block">
                    <label for="ciudad" class="inline-block control-label w-32">Ciudad:</label>
                    <div class="inline-block w-80">
                    <input name="ciudad" list="ciudad" class="form-multiselect rounded-md bg-white border-gray-300 w-full h-10 px-2" required onkeyup = "validar3(this.form)"/>
                        <datalist id="ciudad">
                        @foreach($cities as $ciudad => $op)
                            <option value="{{ $op }}" {{ (old("ciudad") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
                <!--departamento/distrito-->
                <div class="form-group mt-2 inline-block">
                    <label for="departamento" class="inline-block control-label w-32">Departamento:</label>
                    <div class="inline-block w-80">
                        <input name="departamento" list="departamento" class="form-multiselect rounded-md bg-white border-gray-300 w-full h-10 px-2"  required="required" onchange = "validar3(this.form)"/>
                        <datalist id="departamento">
                        @foreach($districts as $departamento => $op)
                            <option value="{{ $op }}" {{ (old("departamento") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
                <!--provincia /state-->
                <div class="form-group mt-2 inline-block">
                    <label for="provincia" class="inline-block control-label w-32">Provincia:</label>
                    <div class="inline-block w-80">
                        <input name="provincia" list="provincia" class="form-multiselect rounded-md bg-white border-gray-300 w-full h-10 px-2" required="required" onchange = "validar3(this.form)"/>
                        <datalist id="provincia">
                        @foreach($states as $provincia => $op)
                            <option value="{{ $op }}" {{ (old("provincia") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
                <!--pais country-->
                <div class="form-group mt-2 inline-block">
                    <label for="pais" class="inline-block control-label w-32">Pais:</label>
                    <div class="inline-block w-80">
                        <input name="pais" list="pais" class="form-multiselect rounded-md bg-white border-gray-300 w-full h-10 px-2" required onchange = "validar3(this.form)"/>
                        <datalist id="pais">
                        @foreach($countries as $pais => $op)
                            <option value="{{ $op }}" {{ (old("pais") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
            </div>

                <div id="enviar" style="display:none;" class="pull-right py-2 px-2">
                        <button  id="guardar" disabled="disabled" type="submit" class="btn btn-success">Guardar</button>
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
                <div id="anterior2" style="display:none;" class="pull-left py-2">
                    <button type="button" class="btn btn-primary" onclick="anterior2()">Anterior</button>
                </div>

                <div id="cancelar1" style="display:none;" class="pull-right py-2 px-4">
                    <button type='submit' id="cancelar" class="btn btn-warning" onclick="cancelar1()">Borrar</button>
                </div>

            </form>
        </div>
        <div id="ayCtl1" style="display:none;" class="flex bg-yellow-300 rounded-md">
            <p class="text-red-700 font-thin px-2 py-2">ayuda control 1 </p>
        </div>
    </div>

</body>
<script src="{{ asset('/js/firmas.js') }}"> </script>
<script>
    xcuit =  "<?php echo session('xcuit') ?>";
</script>

<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
