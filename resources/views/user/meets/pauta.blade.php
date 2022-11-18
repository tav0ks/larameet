@extends('layouts.panel')
@section('title', $meet->name)
@section('header')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.umd.min.js"></script>
@endsection

@section('content')
    <form action="{{ route('topic.update', $meet->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="pauta" id="pauta" value="{{ $pauta->pauta }}">
        <trix-editor class="trix-content" input="pauta"></trix-editor>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <a class="btn btn-success" target="_blank" href="{{ route('topic.print', $meet->id) }}">Imprimir a parada</a>
@endsection
