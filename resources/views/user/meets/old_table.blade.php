<div class="card-header py-3">
    <div class="row ml-1 align-items-center">

        <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#horariosModal"
            aria-expanded="false" aria-controls="form-horario">
            Novo Horario
        </button>

        <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#participantModal"
            aria-expanded="false" aria-controls="form-participant">
            Adicionar Participante
        </button>

        {{-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form-topic"
            aria-expanded="false" aria-controls="form-topic">
            Adicionar Tópico
        </button> --}}
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" colspan="{{ $tamanho + 1 }}">Escolha do horário</th>
                    </tr>
                    <tr>
                        <th scope="col-3" class="text-center align-middle">Participantes</th>

                        @for ($i = 0, $tamanho = count($horarios); $i < $tamanho; ++$i)
                            <th scope="col">

                                <div>{{ $horarios[$i]->meet_date_formatted }}<br></div>
                                <div>Início: {{ $horarios[$i]->meet_start_formatted }}</div>
                            </th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $pKey => $participant)
                        <tr>
                            <th class="dark" scope="row">
                                {{ $participant->name }}
                            </th>
                            @foreach ($horarios as $h)
                                <td scope="col" colspan="1" class="text-center align-middle">
                                    <form method="POST" action="{{ route('horarios.update', [$meet->id, $h->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <input name="meet_id" type="hidden" value="{{ $meet->id }}">
                                        <input name="horario_id" type="hidden" value="{{ $h->id }}">
                                        <input id="{{ $h->id }}" name="votes" type="hidden" value="1">
                                        <button type="submit" id="{{ $pKey }}{{ $h->id }} button" onclick="countVote('{{ $pKey }}{{ $h->id }} button', '{{ $h->id }}')" class="btn red btn-block btn-lg"></button>
                                    </form>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
</div>

{{-- <div class="col">
<div class="collapse multi-collapse" id="form-topic">
    <div class="mt-2 card card-body">
        <h4 class="mb-0 font-weight-bold text-primary">Novo Tópico</h4>
        <hr>
        <form class="form" action="{{ route('topic.store', $meet->id) }}" method="post">
            @csrf
            <input type="text" name="topico" class="form-control mb-2" placeholder="Tópico">
            <button class="btn btn-primary btn-user btn-block" type="submit">Adicionar</button>
        </form>
    </div>
</div>
</div> --}}
