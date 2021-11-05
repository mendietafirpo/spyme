<head>
@include('layouts.head')
@include('flash-message')
</head>
<header>
@include('layouts.header')
</header>

<body>
@if(Session::has('jsAlert'))


    @if(session('info'))
    {{ session('info') }}
    @endif


@endif
@include('layouts.main')
     <!--Query scope-->
    <table class="bg-blue-500 px-2 mx-2 my-2">
            <form class="navbar-form navbar-left" role="Search">
            <tr>
                <td>
                    <select id="sql" type="text" title="seleccione una opción, puede incluir una ciudad, y luego buscar ->" name="sql" class="bg-blue-100 form-multiselect text-black-400 rounded-lg h-9 mx-2 w-44 border-blue-500">
                    <option value=""></option>
                    <option value="1">En tramite banco</option>
                    <option value="2">En tramite UEP</option>
                    <option value="3">En tramite CFI</option>
                    <option value="4">En tramite COBRO</option>
                    <option value="5">Efectivizados</option>
                    <option value="6">Dados de baja</option>
                    <option value="7">Desistidos</option>
                    </select>
                </td>
                <td>
                        <input minlength="8" maxlength="11" class="bg-blue-100 text-black-400 rounded-lg h-9 w-32 mx-2 border-blue-500" type="text" name="cuit" class="form-control" placeholder="numero cuit">
                </td>
                <td>
                        <input class="bg-blue-100 text-black-400 rounded-lg h-9 w-82 border-blue-500 mx-2" type="text" name="razonSocial" class="form-control" placeholder="nombre o razon social">
                </td>
                <td>
                        <input class="bg-blue-100 text-black-400 rounded-lg h-9 w-68 border-blue-500 mx-2" type="text" name="ciudad" class="form-control" placeholder="ciudad o localidad">
                </td>
                <td>
                    <button type="submit" title="BUSCAR" class="btn btn-default bg-yellow-200">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="w-8 h-9 text-blue-700"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </svg>
                    </button>

                </td>
            </tr>
            </form>
    </table>
    <!--fin Query scope-->
    <table class="table table-condensed mx-2 my-2">
        <tr class="bg-blue-200">
            <th>No</th>
            <th>Cuit</th>
            <th>Razón social</th>
            <th>Localidad</th>
            <th>Apps</th>
            <th width="180px">Panel de controles</th>
            <th><a class="btn btn-danger ml-2 pull-left" href="{{ route('firmas.create') }}"> Nueva firma</a></th>
        </tr>
        @foreach ($firmas as $firma)
        <tr @if ($loop->even) class="bg-gray-200" @endif>
        <td>{{ ++$i }}</td></div>
           <td> <a class="text-blue-400 underline" title="ir a personas humanas vinculadas a esta firma" href="{{ route('personas.irpersona',$firma->idFirma) }}">{{ $firma->cuit }}</a></td>
           <td> <a class="text-blue-400 underline" title="información detallada de la firma" href="{{ route('firmas.show',$firma->idFirma) }}">{{ $firma->razonSocial }} </a></td>
           <td>{{ $firma->ciudad }}</td>
           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                @foreach($app as $firma_idFirma => $ap)
                    @if ($firma_idFirma==$firma->idFirma)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $ap }}
                        </span>
                    @endif
                @endforeach
            </td>
           <td>
                <form action="{{ route('firmas.destroy',$firma->idFirma) }}" method="POST">
                    <!--<a class="btn btn-warning h-9" href="{{ route('firmas.edit',$firma->idFirma) }}"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>-->
          <!--  @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>-->
                    &nbsp
                    <a href="{{ route('proyectos.irproyecto',$firma->idFirma) }}" class="btn btn-success">Proyecto</a>
                </form>
            </td>
            <td>
                <form action="{{ route('firmas.addapp',$firma->idFirma) }}" method="PUT"action="{{ route('proyectos.irproyecto',$firma->idFirma) }}" onClick="return confirm('Confirmar anexar firma si aún no se cargó o eliminar si ya existe en SPYME');">
                    <button type="submit" class="btn btn-primary">Add/elim app</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
{{ $firmas->withQueryString()->links() }}


</body>
<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
