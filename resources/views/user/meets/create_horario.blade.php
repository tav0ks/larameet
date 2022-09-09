@extends('layouts.panel')
@section('title', 'Novo Horario')

@section('content')
    <form action="{{ route('user.meets.meet.store', 'id') }}" method="POST" class="user">
        @csrf
        <div class="row">
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
                    <label for="name">Fim</label>
                    <input type="text" name="horario[meet_end]"
                        class="form-control date {{ $errors->has('horario.meet_end') ? ' is-invalid' : '' }}"
                        value="{{ old('horario.meet_end') }}" data-mask="00:00">
                    <div class="invalid-feedback">{{ $errors->first('horario.meet_end') }}</div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                Criar!
            </button>
    </form>
@endsection
