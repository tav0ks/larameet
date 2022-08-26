@extends('layouts.panel')
@section('title', 'Meets')
@section('content')
    <form>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-fill">
                <input type="text" name="search" class="form-control w-50 mr-2" value="" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
            <a href="{{ route('user.meets.create') }}" class="btn btn-primary">Novo evento</a>
        </div>
    </form>
    <table class="table mt-4">
        <thead class="thead bg-white">
            <tr>
                <th>Nome</th>
                <th>Local</th>
                <th>Data</th>
                <th>Fim</th>
                <th>Pauta</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
        </tbody>
    </table>

@endsection
