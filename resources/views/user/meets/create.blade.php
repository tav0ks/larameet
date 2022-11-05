@extends('layouts.panel')
@section('title', 'Novo Meet')

@section('content')
    <form action="{{ route('user.meets.store') }}" method="POST" class="user">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="hidden" name="meet[user_id]">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="meet[name]"
                            class="form-control {{ $errors->has('meet.name') ? ' is-invalid' : '' }}"
                            value="{{ old('meet.name') }}">
                        <div class="invalid-feedback">{{ $errors->first('meet.name') }}</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Data</label>
                        <input type="text" name="horario[meet_date]"
                            class="form-control date {{ $errors->has('horario.meet_date') ? ' is-invalid' : '' }}"
                            value="{{ old('horario.meet_date') }}" data-mask="00/00/0000">
                        <div class="invalid-feedback">{{ $errors->first('horario.meet_date') }}</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Início</label>
                        <input type="text" name="horario[meet_start]"
                            class="form-control date {{ $errors->has('horario.meet_start') ? ' is-invalid' : '' }}"
                            value="{{ old('horario.meet_start') }}" data-mask="00:00">
                        <div class="invalid-feedback">{{ $errors->first('horario.meet_start') }}</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Duração</label>
                        <input type="text" name="meet[duration]"
                            class="form-control date {{ $errors->has('meet.duration') ? ' is-invalid' : '' }}"
                            value="{{ old('meet.duration') }}" data-mask="00:00">
                        <div class="invalid-feedback">{{ $errors->first('meet.duration') }}</div>
                    </div>
                </div>
            </div>
            <button type="submit" class="mt-1 btn btn-primary btn-user btn-block">
                Criar!
            </button>
        </div>
    </form>
@endsection
