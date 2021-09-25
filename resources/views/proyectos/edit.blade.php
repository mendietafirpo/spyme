<?php
use Carbon\Carbon;
?>
<head>
@include('layouts.head')
@include('flash-message')
</head>
<body>
@include('layouts.main')
    <div class="grid grid-cols-2 bg-gray-200 lg:max-w-4xl sm:max-w-full rounded-md mx-2 my-2">
        <div class="col float-left font-semibold text-xl text-blue-700 py-2 px-2 w-3/4">
                Editar datos de persona
        </div>
        <div class="flex justify-end py-2 px-2">
            <a class="btn btn-primary pull-left" href="{{ url('/pymes/mysmes') }}">Volver</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form class="bg-green-100 w-3/4 mx-2" action="{{ route('proyectos.update',$proyecto->idProy) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Id Proy:</strong>
                    <input type="text" name="idProy" value="{{ $proyecto->idProy }}" readonly class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha Referencia:</strong>
                    @if($proyecto->fechaReferencia)
                        <input class="form-control" name="fechaReferencia" type="date" value="{{ Carbon::parse($proyecto->fechaReferencia)->format('Y-m-d') }}">
                    @else
                        <input class="form-control" name="fechaReferencia" type="date">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre Proyecto:</strong>
                    <input class="form-control" name="nombreProyecto" value="{{ $proyecto->nombreProyecto }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 h-26">
                <div class="form-group">
                <strong>Bienes Que Produce:</strong>
                <textarea class="form-control h-20" name="bienesQueProduce">{{ old('bienesQueProduce', $proyecto->bienesQueProduce) }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Garantias Ofrecidas:</strong>
                    <input class="form-control" name="garantiasOfrecidas"  value="{{ $proyecto->garantiasOfrecidas }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 h-32">
                <div class="form-group">
                <strong>Destino Fondos:</strong>
                <textarea class="form-control h-28" id="destinoFondos" name="destinoFondos" >{{ old('destinoFondos', $proyecto->destinoFondos) }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 h-36">
                <div class="form-group">
                <strong>Descripcion Proyecto:</strong>
                <textarea class="form-control h-28" name="descripcionProyecto">{{ old('descripcionProyecto', $proyecto->descripcionProyecto) }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 h-36">
                <div class="form-group">
                <strong>Antecentes:</strong>
                <textarea class="form-control h-28" name="antecentes">{{ old('antecentes', $proyecto->antecentes) }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 h-36">
                <div class="form-group">
                <strong>Justificacion:</strong>
                <textarea class="form-control h-28" name="justificacion">{{ old('justificacion', $proyecto->justificacion) }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Moneda:</strong>
                <select name="moneda" id="moneda" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                @foreach($dfmoney as $id => $mon)
                    <option value="{{ $id }}" {{ ( $id == $proyecto->moneda) ? 'selected' : '' }}>
                        {{ $mon }}
                    </option>
                @endforeach
                </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>tipodeCambio:</strong>
                    <input class="form-control"  type="number" step="0.01" name="tipodeCambio"  value="{{ $proyecto->tipodeCambio }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>montoActFijo:</strong>
                    <input class="form-control" type="number" step="0.1" name="montoActFijo"  value="{{ $proyecto->montoActFijo }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>montoCapTrab:</strong>
                    <input class="form-control" type="number" step="0.1" name="montoCapTrab" value="{{ $proyecto->montoCapTrab }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>montoTotal:</strong>
                    <input class="form-control" type="number" step="0.1" name="montoTotal" value="{{ $proyecto->montoTotal }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>inversionTotal:</strong>
                    <input class="form-control" type="number" step="0.1" name="inversionTotal" value="{{ $proyecto->inversionTotal }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>personalOcupado:</strong>
                    <input class="form-control" type="number" name="personalOcupado" value="{{ $proyecto->personalOcupado }}">
                </div>
            </div>´
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>tasacion:</strong>
                    <input class="form-control" name="tasacion" value="{{ $proyecto->telefono }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nroPartida:</strong>
                    <input class="form-control" name="nroPartida" value="{{ $proyecto->nroPartida }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nroMatricula:</strong>
                    <input class="form-control" name="nroMatricula" value="{{ $proyecto->nroMatricula }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <strong>ciiuCs:</strong>
                    <select name="ciiuCs" id="ciiuCs" class="form-multiselect block rounded-md shadow-sm mt-1 w-full">
                    @foreach($dfciiu as $ciiuCs => $ciiu)
                        <option value="{{ $ciiuCs }}" {{ ( $ciiuCs == $proyecto->ciiuCs) ? 'selected' : '' }}>
                            {{ $ciiu }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" onclick="confirmar()" class="btn btn-primary">Realizar cabios</button>
            </div>
        </div>
    </form>
</body>
