    @extends('adminlte::page')

    @section('title', 'Lista tareas')

    @section('content_header')
    @stop

    @section('content')

        <div class="card-body container" id="" {{-- style="display:none" --}}>
            {{-- <div class="row">

            <h4 class="col">Piezas Exitosas = {{ $item['exitosas'] }}</h4>
            <h4 class="col">Cantidad a realizar = {{ $item['ordenC']->Cantidad }}</h4>
        </div>

        <div class="row">
            <h4 class="col">Piezas Fallidas = {{ $item['fallidas'] }}</h4>
        </div>

        <div class="row">
            <h4 class="col">Total Piezas = {{ $item['total'] }}</h4>
        </div> --}}
        {{-- <a href="" class="btn btn-success"
            target="blank">Exel</a> --}}
            <table class="table table-striped border-dark">

                <tr class="bg-dark text-light">

                    <head>

                        <th>Pieza</th>
                        <th>Tiempo</th>
                        <th>Estado</th>
                        <th>Fecha/Hora</th>
                        <th>Operario</th>
                    </head>
                </tr>
                @foreach ($piezas as $pieza)


                    @switch($pieza->Estado)
                        @case('fallida')
                            <tr class="bg-danger text-light">
                                <td>{{ $pieza->Numero }}</td>
                                <td>{{ $pieza->Tiempo }}</td>

                        @break
                        @case('exitosa')
                            <tr class="bg-primary text-light">
                                <td>{{ $pieza->Numero }}</td>
                                <td>{{ $pieza->Tiempo }}</td>

                        @break
                        @case('pausa')
                            <tr class="bg-success text-light">
                                <td>{{ $pieza->Numero }}</td>
                                <td>
                                    <p id="pantalla{{ $pieza->id }}"></p>
                                </td>
                        @break
                        @case('inicio')
                            <tr class="bg-light">
                                <input type="text" id="{{ $pieza->id }}" value="{{ $pieza->id }}" class="inicio"
                                    hidden>
                                <td>{{ $pieza->Numero }}</td>
                                <td>
                                    <p id="pantalla{{ $pieza->id }}"></p>
                                </td>

                        @break
                        @default

                    @endswitch

                    <td>{{ $pieza->Estado }}</td>
                    <td>{{ $fechaDesde = date_format(date_create($pieza->Fecha), 'd/m/y H:i') }}</td>
                    @if ($pieza->name == 'admin')
                    <td>_________</td>
                    @else
                    <td>{{$pieza->name}} </td>
                    @endif
                    </tr>

                    {{-- @endforeach --}}


                @endforeach

            </table>
        </div>
    @stop

    @section('css')
    @stop

    @section('js')
    @stop
