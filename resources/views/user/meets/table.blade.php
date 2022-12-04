<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

<div class="card-header py-3">
    @if($user->is_participant == 0)
        <div class="row ml-1 align-items-center">
            <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#horariosModal"
                aria-expanded="false" aria-controls="form-horario">
                <i class="fa-solid fa-plus"></i>
                Novo Horario
            </button>
            <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#participantModal"
                aria-expanded="false" aria-controls="form-participant">
                <i class="fa-solid fa-plus"></i>
                Adicionar Participante
            </button>
            <a class="btn btn-primary mr-2" type="button" href="{{ route('topic.edit', $meet->id) }}">
                <i class="fas fa-pen"></i>
                Pauta
            </a>
        </div>
    @endif
</div>
<div class="card-body">
    <div class="d-flex">
        <div class="col-4">
            <div class="card" style="width: 100%; height: 100%;">
                <div class="card-body">
                    @if($user->is_participant == 0)
                        <h3>Olá {{ ucfirst($user->name) }}!</h3>
                        <p class="card-text">Aqui voce pode coordenar os horários disponíveis para o Meet acontecer</p>
                    @else
                        <h3>Olá {{ ucfirst($user->name) }}!</h3>
                        <p class="card-text">Aqui voce poderá realizar a votação para o horário em que o Meet ocorrerá!</p>
                    @endif

                    <h5>Meet: {{ ucfirst($meet->name) }}</h5>
                    <h6>Duração do Meet: {{$meet->duration_formatted}}</h6>
                    <h6>Numero de participantes: {{($participants->count()+1)}}</h6>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card" style="width: 100%; height: 100%;">
                <div class="card-body">
                    @if($horarios->count() > 5)
                        <div class="nav-buttons d-flex justify-content-end" style="margin-bottom:20px">
                            <button onclick="prev()" class="btn btn-primary" type="button"
                            aria-expanded="false" aria-controls="form-horario">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <button onclick="next()" class="btn btn-primary ml-2" type="button"
                            aria-expanded="false" aria-controls="form-horario">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    @endif
                    @if($horarios->count() > 0)
                        <div class="owl-carousel owl-theme">
                            @foreach ($horarios as $horario)
                                @php
                                    $day_number = explode(' ', $horario->meet_date);
                                    $day_number = explode('-', $day_number[0]);
                                    $day_number = $day_number[2];
                                    $vote = $votes->where('horario_id', $horario->id)->first();
                                @endphp
                                @if(isset($most_voted_list) && (in_array($horario->id, $most_voted_list->toArray())))
                                    <div class="card border-warning" style="width: 100%; height: 100%;">
                                        <div class="card-header border-warning">
                                            <span style="color: #ffc107;">Estão empatados!</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="flex-column" style="display: flex;
                                            align-items: center;
                                            justify-content: center;">
                                                <div>
                                                    <h5>{{ $horario->day }}</h5>
                                                </div>
                                                <div>
                                                    <h3>{{ $day_number }}</h3>
                                                </div>
                                                <div>
                                                    <h5>{{ $horario->month }}</h5>
                                                </div>
                                                <div>
                                                    <h5>Inicio: {{ $horario->meet_start_formatted }}</h5>
                                                </div>
                                                <div class="vote-buttons">
                                                    @if($vote->value == '1')
                                                        <form action="{{ route('vote.update', $vote->id) }}"method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div id="1" class="vote custom-control custom-checkbox small">
                                                                <input type="hidden" name="value" value="{{ $vote->value }}">
                                                                <input type="hidden" name="meet_id" value="{{ $meet->id }}">
                                                                <button type="submit" class="btn btn-success btn-circle">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                    @if($vote->value == '0')
                                                        <form action="{{ route('vote.update', $vote->id) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div id="0" class="vote custom-control custom-checkbox small">
                                                                <input type="hidden" name="value" value="{{ $vote->value }}">
                                                                <input type="hidden" name="meet_id" value="{{ $meet->id }}">
                                                                <button type="submit" class="btn btn-danger btn-circle">
                                                                    <i class="fas fa-x"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h5>Votos: {{ $horario->votes }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        @if($user->is_participant == 0)
                                            <div class="card-footer border-warning">
                                                <a style="margin-right:5px;" class="btn btn-danger btn-icon-split" onclick="deleteHorarioModal('{{ $horario->id }}');">
                                                    <span class="icon text-white-50" style="width:40px !important;">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a  href="{{ route('horarios.edit', $horario->id) }}" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if(isset($most_voted) && ($most_voted->id == $horario->id))
                                    <div class="card border-success" style="width: 100%; height: 100%;">
                                        <div class="card-header border-success">
                                            <span style="color: #1cc88a;">Tem mais votos!</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="flex-column" style="display: flex;
                                            align-items: center;
                                            justify-content: center;">
                                                <div>
                                                    <h5>{{ $horario->day }}</h5>
                                                </div>
                                                <div>
                                                    <h3>{{ $day_number }}</h3>
                                                </div>
                                                <div>
                                                    <h5>{{ $horario->month }}</h5>
                                                </div>
                                                <div>
                                                    <h5>Inicio: {{ $horario->meet_start_formatted }}</h5>
                                                </div>
                                                <div class="vote-buttons">
                                                    @if($vote->value == '1')
                                                    <form action="{{ route('vote.update', $vote->id) }}"method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div id="1" class="vote custom-control custom-checkbox small">
                                                            <input type="hidden" name="value" value="{{ $vote->value }}">
                                                            <input type="hidden" name="meet_id" value="{{ $meet->id }}">
                                                            <button type="submit" class="btn btn-success btn-circle">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    @if($vote->value == '0')
                                                    <form action="{{ route('vote.update', $vote->id) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div id="0" class="vote custom-control custom-checkbox small">
                                                            <input type="hidden" name="value" value="{{ $vote->value }}">
                                                            <input type="hidden" name="meet_id" value="{{ $meet->id }}">
                                                            <button type="submit" class="btn btn-danger btn-circle">
                                                                <i class="fas fa-x"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h5>Votos: {{ $horario->votes }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        @if($user->is_participant == 0)
                                            <div class="card-footer border-success">
                                                <a style="margin-right:5px;" class="btn btn-danger btn-icon-split" onclick="deleteHorarioModal('{{ $horario->id }}');">
                                                    <span class="icon text-white-50" style="width:40px !important;">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a  href="{{ route('horarios.edit', $horario->id) }}" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if((isset($most_voted) && ($most_voted->id != $horario->id)) || (isset($most_voted_list) && !in_array($horario->id, $most_voted_list->toArray())))
                                    <div class="card" style="width: 100%; height: 100%;">
                                        <div class="card-header" style="height: 45px !important;">
                                        </div>
                                        <div class="card-body">
                                            <div class="flex-column" style="display: flex;
                                            align-items: center;
                                            justify-content: center;">
                                                <div>
                                                    <h5>{{ $horario->day }}</h5>
                                                </div>
                                                <div>
                                                    <h3>{{ $day_number }}</h3>
                                                </div>
                                                <div>
                                                    <h5>{{ $horario->month }}</h5>
                                                </div>
                                                <div>
                                                    <h5>Inicio: {{ $horario->meet_start_formatted }}</h5>
                                                </div>
                                                <div class="vote-buttons">
                                                    @if($vote->value == '1')
                                                    <form action="{{ route('vote.update', $vote->id) }}"method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div id="1" class="vote custom-control custom-checkbox small">
                                                            <input type="hidden" name="value" value="{{ $vote->value }}">
                                                            <input type="hidden" name="meet_id" value="{{ $meet->id }}">
                                                            <button type="submit" class="btn btn-success btn-circle">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    @if($vote->value == '0')
                                                    <form action="{{ route('vote.update', $vote->id) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div id="0" class="vote custom-control custom-checkbox small">
                                                            <input type="hidden" name="value" value="{{ $vote->value }}">
                                                            <input type="hidden" name="meet_id" value="{{ $meet->id }}">
                                                            <button type="submit" class="btn btn-danger btn-circle">
                                                                <i class="fas fa-x"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h5>Votos: {{ $horario->votes }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        @if($user->is_participant == 0)
                                            <div class="card-footer">
                                                <a style="margin-right:5px;" class="btn btn-danger btn-icon-split" onclick="deleteHorarioModal('{{ $horario->id }}');">
                                                    <span class="icon text-white-50" style="width:40px !important;">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                <a  href="{{ route('horarios.edit', $horario->id) }}" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        @if($user->is_participant == 0)
                            <h3>Não existem horarios cadastrados, cadastre um novo!</h3>
                        @else
                            <h3>Não existem horarios cadastrados, contate o administrador!</h3>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteHorarioModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body py-0">
                <div class="text-center">
                    <input type="hidden" id="horario_to_delete">
                    <h3 class="mt-3 mb-0">Você tem certeza que <br> gostaria de excluir o horario do</h3>
                    <h3 id="delete_horario_modal_date"></h3>
                    <h3 class="mt-3 mb-0">Com início as: <br></h3>
                    <h3 id="delete_horario_modal_start"></h3>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn bg-secondary btn-shadow text-white modal-cancel-button" data-dismiss="modal">
                    <span>Cancelar</span>
                </button>
                <a id="delete_course" type="button" onclick="deleteHorarioConfirmed();"
                    class="btn bg-danger btn-shadow text-white d-flex align-items-center justify-content-center modal-confirm-button">
                    <span>EXCLUIR</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header {
        padding: 10px !important;
    }

    .nav-buttons button {
        box-shadow: 2px 2px 2px #cbcbcb;
    }

    .form-group {
        margin-top: ;
        margin-bottom: 0px !important;
        display: flex;
        flex-direction: row-reverse;
    }

    .form-group a {
        box-shadow: 2px 2px 2px #cbcbcb;
    }

    .vote-buttons {
        margin-top: 10px;
        margin-bottom: 20px !important;
        margin-right: 20px !important;
    }

    .vote-buttons a {
        box-shadow: 2px 2px 2px #cbcbcb;
    }

    .owl-nav {
        display: none;
    }

    .owl-dots {
        margin-top: 25px;
    }
</style>


<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });

    // function changeVote(voteId){
    //     votes = document.getElementsByClassName('vote');
    //     for(let vote of votes){
    //         vote.setAttribute("style", "display: none");
    //     };
    //     document.getElementById(voteId).setAttribute("style", "display: block");
    // }

    function prev(){
        document.getElementsByClassName('owl-prev')[0].click();
    }

    function next() {
        document.getElementsByClassName('owl-next')[0].click();
    }

    function reloadPage() {
        window.location.reload();
    }

    function deleteHorarioModal(horario_id) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: `/meet/${horario_id}/getBasicData`,
            type: 'GET',
            data: {
                'horario': horario_id
            },
            success: function (response) {
                let modal = $('#deleteHorarioModal');

                modal.find('#delete_horario_modal_date').text(`${response.meet_date}?`)
                modal.find('#delete_horario_modal_start').text(`${response.meet_start}?`)
                modal.find('#horario_to_delete').val(response.id);
                modal.modal('show');
            }
        });
    }

    function deleteHorarioConfirmed() {
        let horario_id = $('#horario_to_delete').val();

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: `/meet/${horario_id}/delete`,
            type: 'GET',
            success: function (response) {
                let modal = $('#delete_horario_modal');
                modal.find('#horario_to_delete').val('');
                modal.modal('hide');
                window.location.reload();
            },
            error: function (error) {
                window.location.reload();
            }
        });

    }
</script>
