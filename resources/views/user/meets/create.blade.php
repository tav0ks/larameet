@extends('layouts.panel')
@section('title', 'Novo Meet')

@section('content')
    <form action="{{ route('user.meets.store') }}" method="POST" class="user">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            value="{{ old('meet.name') }}">
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Duração (Horas e Minutos)</label>
                        <input type="text" name="duration"
                            class="form-control date {{ $errors->has('duration') ? ' is-invalid' : '' }}"
                            value="{{ old('meet.duration') }}" data-mask="00:00">
                        <div class="invalid-feedback">{{ $errors->first('duration') }}</div>
                    </div>
                </div>
            </div>
            <button type="submit" class="mt-1 btn btn-primary btn-user btn-block">
                Criar!
            </button>
        </div>
    </form>
@endsection
