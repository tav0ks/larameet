@extends('layouts.panel')
@section('title')
    {{ $meet->name }}
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <table class=" table mt-4 table-dark">
        <thead class="thead-dark ">

            <tr class="">
                <th class="text-center" colspan="{{$tamanho+1}}">Horários</th>
            </tr>

            <tr>
                <th scope="col" colspan="1">Participantes</th>

                @for ($i = 0, $tamanho = count($horarios); $i < $tamanho; ++$i)
                    <th scope="col">

                        {{ $horarios[$i]->meet_date_formatted }}
                        {{ $horarios[$i]->meet_start_formatted }}
                        {{ $horarios[$i]->meet_end_formatted }}
                    </th>
                @endfor

            </tr>

        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <th class="dark" scope="row">
                        {{ $participant->name }}
                    </th>
                    <form action="" method="post">
                        @foreach ($horarios as $h)
                            <td scope="col" colspan="1">
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </td>
                        @endforeach
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="justify-content-between">
            <a href="{{ route('horario.meet.create', $meet->id) }}" class="btn btn-primary">Novo Horario</a>
        </div>

        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form-participant"
            aria-expanded="false" aria-controls="form-participant">
            Adicionar Particpante
        </button>
    </div>
    <div class="collapse" id="form-participant">
        <div class="mt-1 card card-body">
            <form class="form" action="{{ route('participant.store', $meet->id) }}" method="post">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="Adicione o participante">
                <button class="btn btn-primary" type="submit">Adicionar</button>
            </form>
        </div>
    </div>
@endsection
