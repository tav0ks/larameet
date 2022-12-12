@extends('layouts.panel')
@section('title', 'Editar Meet')

@section('content')
    <form action="{{ route('user.meets.update', $meet->id) }}" method="POST" class="user">
        @method('PUT')
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            value="{{ $meet->name }}">
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="duration">Duração (Horas e Minutos)</label>
                        <input type="text" name="duration"
                            class="form-control date {{ $errors->has('duration') ? ' is-invalid' : '' }}"
                            value="{{ $meet->duration_formatted }}" data-mask="00:00">
                        <div class="invalid-feedback">{{ $errors->first('duration') }}</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="obs">Observações</label>
                        <input type="text" name="obs" class="form-control"
                            placeholder="Use este campo para inserir dados adicionais do meet, como obs de encontro ou link da sala virtual"
                            {{ $errors->has('obs') ? ' is-invalid' : '' }}" value="{{ old('meet.obs') }}">
                        <div class="invalid-feedback">{{ $errors->first('obs') }}</div>
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-1 btn btn-primary btn-user btn-block">
                Salvar!
            </button>
        </div>
    </form>
@endsection
