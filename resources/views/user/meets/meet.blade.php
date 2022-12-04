@extends('layouts.panel')
@section('title', $meet->name)
@section('content')
    {{-- @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    @if (session()->has('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="card shadow mb-4">

        @include('user.meets.table')

    {{-- MODAL CRIAR PARTICIPANTE --}}

    <div class="modal fade" id="participantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex flex-column">
                        <h5 class="modal-title font-weight-bold text-primary">Adicionar Horário</h5>
                        <span>(a data deve ser posterior a hoje)</span>
                    </div>
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
                        <div class="form-group" style="margin-top: 10px;">
                            <input type="text" name="meet_start"
                                class="form-control date {{ $errors->has('meet_start') ? ' is-invalid' : '' }}"
                                placeholder="Início (Horas e Minutos)" value="{{ old('meet_start') }}" data-mask="00:00">
                            <div class="invalid-feedback">{{ $errors->first('meet_start') }}</div>
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

    <style>

    </style>

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
