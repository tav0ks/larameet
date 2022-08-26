@extends('layouts.panel')
@section('title', 'Meets')

@section('lista')
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Meets</div>
    </div>
    @foreach ($meets as $meet)
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>{{ $meet->name }} </span>
            </a>
        </li>
    @endforeach
@endsection


@section('content')
    <form>
        <div class="d-flex justify-content-between">
            <a href="{{ route('user.meets.create') }}" class="btn btn-primary">Novo evento</a>
        </div>
    </form>
    <table class="table mt-4">
        <thead class="thead bg-white">
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Pauta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
        </tbody>
    </table>

@endsection
