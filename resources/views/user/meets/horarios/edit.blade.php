@extends('layouts.panel')
@section('title', 'Editar Horario')

@section('content')
    <form action="{{ route('horarios.update', $horario->id) }}" method="POST" class="user">
        @method('PUT')
        @csrf
        @if (session()->has('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Data</label>
                        <input type="text" name="meet_date"
                            class="form-control date {{ $errors->has('meet_date') ? ' is-invalid' : '' }}"
                            placeholder="Data" value="{{ $horario->meet_date_formatted }}" data-mask="00/00/0000">
                        <div class="invalid-feedback">{{ $errors->first('meet_date') }}</div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <div class="form-group">
                        <label for="name">Início</label>
                        <input type="text" name="meet_start"
                            class="form-control date {{ $errors->has('meet_start') ? ' is-invalid' : '' }}"
                            placeholder="Início" value="{{ $horario->meet_start_formatted }}" data-mask="00:00">
                        <div class="invalid-feedback">{{ $errors->first('meet_start') }}</div>
                    </div>
                </div>
            <button type="submit" class="mt-1 btn btn-primary btn-user btn-block">
                Salvar!
            </button>
        </div>
    </form>
@endsection
