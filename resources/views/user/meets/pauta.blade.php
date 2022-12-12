@extends('layouts.panel')
@section('title', $meet->name)
@section('header')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.umd.min.js"></script>
@endsection

@section('content')
    <div>
        <div class="row">
            <div class="col-12 mb-2" style="padding-left: 0 !important;">
                <div class="col-12 d-flex flex-column">
                    <h4>Editor de pauta</h4>
                    <h5>Beleza! O horário escolhido para o Meet foi: </h5>
                    <div>
                        <h5>Dia escolhido: {{ $most_voted->meet_date_formatted }}</h5>
                    </div>
                    <h5>Agora você pode incluir as pautas que serão discutidas no Meet: </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-12">

            <form action="{{ route('topic.update', $meet->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="pauta" id="pauta" value="{{ $pauta->pauta }}">
                <trix-editor class="trix-content" input="pauta"></trix-editor>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a class="btn btn-success" target="_blank" href="{{ route('topic.print', [$meet->id, $most_voted]) }}">Gerar Ata</a>
                </div>
            </form>
        </div>
    </div>

@endsection
