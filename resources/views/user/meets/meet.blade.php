@extends('layouts.panel')
@section('title', $meet->name)
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

    <h3 class="mb-2 ml-3 font-weight-bold text-primary">{{ ucfirst($meet->name) }}</h3>

    <h5 class="mb-2 ml-3 font-weight-bold text-primary">Duração do Meet: {{$meet->duration_formatted}}</h5>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row ml-1 align-items-center">

                <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#horariosModal"
                    aria-expanded="false" aria-controls="form-horario">
                    Novo Horario
                </button>

                <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#participantModal"
                    aria-expanded="false" aria-controls="form-participant">
                    Adicionar Participante
                </button>

                <a class="btn btn-primary" type="button" href="{{ route('topic.edit', $meet->id)}}">
                    Adicionar Tópico
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="{{ $tamanho + 1 }}">Escolha do horário</th>
                            </tr>
                            <tr>
                                <th scope="col-3" class="text-center align-middle">Participantes</th>

                                @for ($i = 0, $tamanho = count($horarios); $i < $tamanho; ++$i)
                                    <th scope="col">

                                        <div>{{ $horarios[$i]->meet_date_formatted }}<br></div>
                                        <div>Início: {{ $horarios[$i]->meet_start_formatted }}</div>
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $pKey => $participant)
                                <tr>
                                    <th class="dark" scope="row">
                                        {{ $participant->name }}
                                    </th>
                                    @foreach ($horarios as $h)
                                        <td scope="col" colspan="1" class="text-center align-middle">
                                            <form method="POST" action="{{ route('horarios.update', [$meet->id, $h->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <input id="{{ $h->id }}" name="votes" type="hidden" value="1">
                                                <button type="submit" id="{{ $pKey }}{{ $h->id }} button" onclick="countVote('{{ $pKey }}{{ $h->id }} button', '{{ $h->id }}')" class="btn red btn-block btn-lg"></button>
                                            </form>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

    {{-- <div class="col">
        <div class="collapse multi-collapse" id="form-topic">
            <div class="mt-2 card card-body">
                <h4 class="mb-0 font-weight-bold text-primary">Novo Tópico</h4>
                <hr>
                <form class="form" action="{{ route('topic.store', $meet->id) }}" method="post">
                    @csrf
                    <input type="text" name="pauta" class="form-control mb-2" placeholder="Tópico">
                    <button class="btn btn-primary btn-user btn-block" type="submit">Adicionar</button>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- MODAL CRIAR PARTICIPANTE --}}

    <div class="modal fade" id="participantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary">Adicionar Participante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" action="{{ route('participant.store', $meet->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="is_participant" value="1">
                        <div class="form-group">
                            <input type="email" name="email"
                                class="form-control form-control-user {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="Email" value="{{ old('email') }}">
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL CRIAR HORARIO --}}

    <div class="modal fade" id="horariosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary">Adicionar Horário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" action="{{ route('horarios.store', $meet->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="meet_date"
                                class="form-control date {{ $errors->has('meet_date') ? ' is-invalid' : '' }}"
                                placeholder="Data" value="{{ old('meet_date') }}" data-mask="00/00/0000">
                            <div class="invalid-feedback">{{ $errors->first('meet_date') }}</div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="meet_start"
                                class="form-control date {{ $errors->has('meet_start') ? ' is-invalid' : '' }}"
                                value="{{ old('meet_start') }}" data-mask="00:00">
                            <div class="invalid-feedback">{{ $errors->first('meet_start') }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Criar!
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('.btn-lg').click(function() {
            if($(this).hasClass('green')) {
                $(this).removeClass('green');
                $(this).addClass('red');
            } else if($(this).hasClass('red')){
                $(this).removeClass('red');
                $(this).addClass('green');
            }
        });

        // function countVote(buttonId, inputId){
        //    let botao = document.getElementById(buttonId);
        //    let voto = document.getElementById(inputId);
        //    if(botao.classList.contains('red')){
        //         voto.value++;
        //    }
        //    if(botao.classList.contains('green')){
        //         voto.value--;
        //    }
        // }

    </script>

    <style>
        .green {
            background-color: rgb(77, 184, 77);
        }

        .red{
            background-color: rgb(238, 33, 33);
        }
    </style>
@endsection
