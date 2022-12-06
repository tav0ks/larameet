@extends('layouts.panel')
@section('title', $meet->name)
@section('header')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.umd.min.js"></script>
@endsection

@section('content')
    <div>
        {{-- @dd($most_voted) --}}
        <div class="row">
            <div class="col">
                <h4>Editor de pauta</h4>
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
                    <a class="btn btn-success" target="_blank" href="{{ route('topic.print', $meet->id) }}">Gerar ATA</a>
                </div>
            </form>
        </div>
    </div>

@endsection
