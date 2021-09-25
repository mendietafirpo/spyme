<head>
@include('layouts.head')
@include('flash-message')
</head>
<header>
@include('layouts.header')
</header>

<body>
@include('layouts.main')
    <td> &nbsp</td>
     <!--Query scope-->
     <table class="bg-green-100 w-1/2">
            <form class="navbar-form navbar-left" role="Search">
            <tr>
                <td>
                        <input maxlength="11" class="bg-blue-100 text-black-400 rounded-lg h-9 w-36 border-blue-500" type="text" name="documentoIdentidad" class="form-control" placeholder="numero de dni">
                </td>
                <td> &nbsp</td><td> &nbsp</td>
                <td>
                        <input class="bg-blue-100 text-black-400 rounded-lg h-9 w-82 border-blue-500" type="text" name="apellidoNombres" class="form-control" placeholder="apellido nombre">
                </td>
                <td>&nbsp
                </td>
                <td> &nbsp</td><td> &nbsp</td>
                <td>
                        <input class="bg-blue-100 text-black-400 rounded-lg h-9 w-68 border-blue-500" type="text" name="ciudad" class="form-control" placeholder="ciudad o localidad">
                </td>
                <td>
                    <button type="submit" class="btn btn-default">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="w-8 h-8 text-blue-400"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </svg>
                    </button>

                </td>
                <td>
                <a class="btn btn-primary ml-16" href="{{ route('personas.create') }}"> Nueva persona</a>
                </td>
            </tr>
            </form>
    </table>
    <!--fin Query scope-->
    <td> &nbsp</td>
    <table class="table table-condensed mx-2">
        <tr class="bg-blue-200">
            <th>DNI</th>
            <th>Apellido y Nombre</th>
            <th>Ciudad</th>
            <th>IdFirma</th>
            <th>Tipo Relacion</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($personas as $persona)
        <tr @if ($loop->even) class="bg-gray-200" @endif>
            <td>{{ $persona->documentoIdentidad }}</td>
            <td>{{ $persona->nombresApellido }}</td>
            <td>{{ $persona->ciudad }}</td>

            @foreach ($persona->firmas as $firma)
            <td>{{ $firma->idFirma }}</td>
                @foreach($fprel as $id => $fp)
                    @if ($id==$firma->pivot->tipoRelacion)
                    <td> {{ $fp }}</td>
                    @endif
                @endforeach
            @endforeach
            <td>
                <form action="{{ route('personas.show',$persona->idPers) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('personas.show',$persona->idPers) }}">ver</a>

                    <!--<a class="btn btn-primary" href="{{ route('personas.edit',$persona->idPers) }}">Edit</a>-->
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                        <!--<a class="btn btn-success" href="{{ route('personas.show',$persona->idPers) }}">Proyecto</a>-->
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
{{!!$personas->withQueryString()->links()!!}}
<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
