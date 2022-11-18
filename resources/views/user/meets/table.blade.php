
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

<div class="card-header py-3">
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
    </div>
</div>
<div class="card-body">
    <div class="d-flex">
        <div class="col-4">
            <div class="card" style="width: 100%; height: 100%;">
                <div class="card-body">
                    <h3>Olá {{ ucfirst($user->name) }}!</h3>
                    <p class="card-text">Aqui voce pode coordenar os horários disponíveis para o Meet acontecer</p>

                    <h5>Meet: {{ ucfirst($meet->name) }}</h5>
                    <h6>Duração do Meet: {{$meet->duration_formatted}}</h6>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card" style="width: 100%; height: 100%;">
                <div class="card-body">
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
                    @if($horarios->count() > 0)
                        <div class="owl-carousel owl-theme">
                            @foreach($horarios as $horario)
                                @php
                                    $day_number = explode(' ', $horario->meet_date);
                                    $day_number = explode('-', $day_number[0]);
                                    $day_number = $day_number[2];
                                @endphp
                                <div class="card" style="width: 100%; height: 100%;">
                                    <div class="card-header">
                                        <div class="form-group">
                                            <a style="margin-left:5px;" class="btn btn-danger btn-icon-split" onclick="deleteMeetModal('{{ $meet->id }}');">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </a>
                                            <a  href="{{ route('horarios.edit', $horario->id) }}" style="margin-left:5px;"  class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                            </a>
                                        </div>
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
                                                <div class="custom-control custom-checkbox small" style="display: none;">
                                                    <a class="btn btn-success btn-circle">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                </div>
                                                <div class="custom-control custom-checkbox small"
                                                >
                                                    <a class="btn btn-danger btn-circle">
                                                        <i class="fas fa-x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div>
                                                <h5>{{ $horario->votes }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h3>Não existem horarios disponíveis, cadastre um novo!</h3>
                    @endif
                </div>
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
    .form-group a{
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
    .owl-nav{
        display: none;
    }
    .owl-dots{
        margin-top:25px;
    }
</style>


<script
    src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous">
</script>

<script>

    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        });
    });

    function prev(){
        document.getElementsByClassName('owl-prev')[0].click();
    }
    function next(){
        document.getElementsByClassName('owl-next')[0].click();
    }
</script>
