@extends('layouts.panel')
@section('title')
    {{ $meet->name }}
@endsection

@section('content')
    <table class="table mt-4">
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
        <thead class="thead bg-white">
            <tr>
                <th>Data</th>
                <th>Inicio</th>
                <th>Fim</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $h)
                <tr>
                    <td>{{ $h->meet_date_formatted }}</td>
                    <td>{{ $h->meet_start_formatted }}</td>
                    <td>{{ $h->meet_end_formatted }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <a href="{{ route('horario.meet.create', $meet->id) }}" class="btn btn-primary">Novo Horario</a>
    </div>
@endsection
