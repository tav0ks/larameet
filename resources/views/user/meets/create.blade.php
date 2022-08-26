@extends('layouts.panel')
@section('title', 'Novo evento')
@section('content')
    <form action="{{ route('user.meets.store') }}" method="POST" class="user">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name"
                        class="form-control form-control-user {{ $errors->has('name') ? ' is-invalid' : '' }}"
                        value="{{ old('name') }}">
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="name">Local</label>
                    <input type="text" name="location"
                        class="form-control form-control-user {{ $errors->has('location') ? ' is-invalid' : '' }}"
                        value="{{ old('location') }}">
                    <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="name">Data e Hora</label>
                    <input type="text" name="meet_date"
                        class="form-control form-control-user date {{ $errors->has('meet_date') ? ' is-invalid' : '' }}"
                        value="{{ old('meet_date') }}" data-mask="00/00/0000 00:00">
                    <div class="invalid-feedback">{{ $errors->first('meet_date') }}</div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="name">Pauta</label>
                    <textarea class="form-control form-control-user {{ $errors->has('agenda') ? 'is-invalid' : '' }}" name="agenda"
                        rows="3">{{ old('agenda') }}</textarea>
                    <div class="invalid-feedback">{{ $errors->first('agenda') }}</div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                Criar!
            </button>
    </form>
@endsection
