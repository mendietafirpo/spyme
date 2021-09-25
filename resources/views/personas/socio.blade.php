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
     <table class="bg-green-100 w-11/12">
            <form class="navbar-form navbar-left" role="Search">
                <td>
                <a class="btn btn-warning ml-16 pull-left" href="{{ route('personas.create') }}"> Nueva persona</a>
                &nbsp
                &nbsp
                <a href="javascript: history.go(-1)" class="btn btn-primary pull-right"> Volver</a>
                </td>
            </tr>
            </form>
    </table>

    <td> &nbsp</td>
    <table class="table table-condensed w-11/12 mx-2">
        <tr class="bg-blue-200">
            <th>DNI</th>
            <th>Apellido y nombres</th>
            <th>Ciudad</th>
            <th>Email</th>
            <th>Tipo Relacion</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($personas as $persona)
        <tr @if ($loop->even) class="bg-gray-200" @endif>
            <td>{{ $persona->documentoIdentidad }}</td>
            <td>{{ $persona->nombresApellido }}</td>
            <td>{{ $persona->ciudad }}</td>
            <td>{{ $persona->email }}</td>
            @foreach ($persona->firmas as $firma)
                @foreach($fprel as $id => $fp)
                        @if ($id==$firma->pivot->tipoRelacion)
                        <td> {{ $fp }}</td>
                        @endif
                @endforeach
                @endforeach
            <td>
                <form action="{{ route('personas.show',$persona->idPers) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('personas.show',$persona->idPers) }}">ver</a>

                   <!-- <a class="btn btn-primary" href="{{ route('personas.edit',$persona->idPers) }}">Edit</a>-->
                <!--    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>-->
                        <!--<a class="btn btn-success" href="{{ route('personas.show',$persona->idPers) }}">Proyecto</a>-->
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
