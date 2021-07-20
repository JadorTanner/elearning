<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- @php
        dd($lecciones)
    @endphp --}}
    tipos:
    <ul>
        @foreach ($tipos as $tipo)
            <li>{{ $tipo }}</li>
        @endforeach
    </ul>
    @foreach ($lecciones as $leccion)
        <h3>{{ $leccion->title }}</h3>
        @php
            $detalle_tipos = [];
        @endphp
        @foreach ($leccion->detalles_lecciones as $detalle)
            <h5>
                {{ $detalle->titulo }}
            </h5>
            @php
                $tipos_aux = $tipos;
                $detalle_tipos[] = $detalle->pk_tipo;
            @endphp
        @endforeach
        <ul>
            @foreach ($detalle_tipos as $detalle_tipo)
                <li>
                    {{-- tipo 1 --}}
                    @if ($detalle_tipo == 1)
                        HTML
                    @else

                        {{-- tipo 2 --}}
                        @if ($detalle_tipo == 2)
                            Video
                        @else

                            {{-- tipo 3 --}}
                            @if ($detalle_tipo == 3)
                                Image
                            @endif
                        @endif
                    @endif
                </li>
                @php
                    if (($key = array_search($detalle_tipo, $tipos_aux)) !== false) {
                        unset($tipos_aux[$key]);
                    }
                @endphp
            @endforeach
            <li>
                faltan:
            </li>
            <ul>
                @foreach ($tipos_aux as $tipo_aux)
                    <li>{{ $tipo_aux }}</li>
                @endforeach
            </ul>
        </ul>
    @endforeach
</body>

</html>
