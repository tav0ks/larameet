<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">


</head>

<body onload="page_open()">
    <div class="container border border-dark rounded-3 mt-3 pt-3 pb-4 theme">
        <div class="row theme">

            {{-- Nome da pool --}}
            <div class="col">
                <h2 class="text-gray-800">Pool reunião</h2>
            </div>

            {{-- botão inutil --}}
            <div class="col-1 justify-content-end">
                <button class="btn btn-success btn-sm" onclick="color_theme()">
                    O
                </button>
            </div>

        </div>

        <div class="row justify-content-start theme">
            <div class="col">
                <form action="">
                    <button class="btn btn-success" href="#">Edit</button>
                </form>

                <!--Pessoas participantes-->
                <i class="fa-solid fa-user"></i>
                <!--adicionar contador-->
            </div>
        </div>

        {{-- conteudo da pagina --}}

        {{-- botoes para collapse --}}
        <div class="row">
            <div class="col">
                <p>
                    <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseFormParticipant"
                        aria-expanded="false" role="button" aria-controls="collappseFormParticipant">Inserir
                        participante</button>
                    <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseFormDate"
                        aria-expanded="false" role="button" aria-controls="collappseFormData">Inserir novo
                        horário</button>
                </p>
            </div>

        </div>

        {{-- conteudo collapse --}}
        <div class="row mb-2">
            <div class="collapse col-12" id="collapseFormParticipant">
                <div class="col-12 card card-body">
                    <form action="{{route('pool.topics.store')}}" method="post">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" placeholder="Nome do participante">
                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-primary">
                                    Adicionar participante
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="collapse col-12" id="collapseFormDate">
                <div class="card card-body">
                    <form action="{{route('pool.dates.store')}}" method="post">
                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Data de início</label>
                                <input class="form-control" type="text" name="start_date" id="start_date" />
                            </div>

                            <div class="col-md-6">
                                <label for="start_date_hour" class="form-label">Hora de início</label>
                                <input class="form-control" type="text" name="start_date_hour"
                                    id="start_date_hour" />
                            </div>

                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Data de fim</label>
                                <input class="form-control" type="text" name="end_date" id="end_date" />
                            </div>

                            <div class="col-md-6">
                                <label for="end_date_hour" class="form-label">Hora de encerramento</label>
                                <input class="form-control" type="text" name="end_date_hour" id="end_date_hour" />
                            </div>

                            <div class="col mt-1">
                                <button type="submit" class="btn btn-info pt-1">
                                    Adicionar data
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card-body border border-gray">

                    <table class="table theme" aria-label="." id="tabelaPool">
                        <thead>

                            <tr>
                                <th scope="col">PARTICIPANTES</th>
                                <th scope="col">
                                    {{-- {{()}} --}}
                                </th>
                            </tr>

                            <tr>
                                
                                {{-- @foreach ($events as $item)
                                              <th scope="col">{{ $item->start_date }}</th>
                                              <th scope="col">{{ $item->end_date }}</th>
                                          @endforeach --}}
                            </tr>

                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scrip.js') }}"></script>
</body>

</html>
