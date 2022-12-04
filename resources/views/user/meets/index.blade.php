@extends('layouts.panel')
@section('content')

<script
    src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous">
</script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row ml-1 align-items-center">
            <a href="{{ route('user.meets.create') }}" class="nav-link" style="padding: 0px;">
                <button class="btn btn-primary mr-2" type="button"
                aria-expanded="false" aria-controls="form-horario">
                <i class="fa-solid fa-plus"></i>
                    Novo Meet
                </button>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <div class="col-3">
                <div class="card" style="width: 100%; height: 100%;">
                    <div class="card-body">
                        <h3>Olá {{ ucfirst($user->name) }}!</h3>
                        <p class="card-text">Aqui voce pode coordenar os seus Meets, <br> selecione um dos Meets ou crie um novo!</p>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card" style="width: 100%; height: 100%;">
                    <div class="card-body">
                        @if($meets->count() > 4)
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
                        @if($meets->count() > 0)
                            <div class="owl-carousel owl-theme">
                                @foreach($meets as $meet)
                                    <div class="card" style="width: 250px; height: 170px;">
                                        <div class="card-body">
                                            <div class="flex-column">
                                                <div>
                                                    <h5>Meet: {{ $meet->name }}</h5>
                                                </div>
                                                <div>
                                                    <h5>Duração: {{ $meet->duration_formatted }}</h5>
                                                </div>
                                                <div class="form-group">
                                                    <a style="margin-left:5px;" class="btn btn-danger btn-icon-split" onclick="deleteMeetModal('{{ $meet->id }}');">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-trash"></i>
                                                        </span>
                                                    </a>
                                                    <a  href="{{ route('user.meets.edit', $meet->id) }}" style="margin-left:5px;"  class="btn btn-primary btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-pen"></i>
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('horarios.index', $meet->id) }}" class="btn btn-info btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h3>Não existem meets cadastrados, cadastre um novo!</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMeetModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body py-0">
                <div class="text-center">
                    <input type="hidden" id="meet_to_delete">
                    <h3 class="mt-3 mb-0">Você tem certeza que <br> gostaria de excluir o meet</h3>
                    <h3 id="delete_meet_modal_item"></h3>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn bg-secondary btn-shadow text-white modal-cancel-button" data-dismiss="modal">
                    <span>Cancelar</span>
                </button>
                <a id="delete_course" type="button" onclick="deleteMeetConfirmed();"
                    class="btn bg-danger btn-shadow text-white d-flex align-items-center justify-content-center modal-confirm-button">
                    <span>EXCLUIR</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-buttons button {
        box-shadow: 2px 2px 2px #cbcbcb;
    }

    .form-group {
        margin-top:40px;
        margin-bottom: 0px !important;
        display: flex;
        flex-direction: row-reverse;
    }
    .form-group a{
        box-shadow: 2px 2px 2px #cbcbcb;
    }
    .owl-nav{
        display: none;
    }
    .owl-dots{
        margin-top:25px;
    }
</style>

<script>
    function deleteMeetModal(meet_id) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: `/user/${meet_id}/getBasicData`,
            type: 'GET',
            data: {
                'meet': meet_id
            },
            success: function (response) {
                let modal = $('#deleteMeetModal');

                modal.find('#delete_meet_modal_item').text(`${response.name}?`)
                modal.find('#meet_to_delete').val(response.id);
                modal.modal('show');
            }
        });
    }

    function deleteMeetConfirmed() {
        let meet_id = $('#meet_to_delete').val();

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: `/user/${meet_id}/delete`,
            type: 'GET',
            success: function (response) {
                let modal = $('#delete_meet_modal');
                modal.find('#meet_to_delete').val('');
                modal.modal('hide');
                window.location.reload();
            },
            error: function (error) {
                window.location.reload();
            }
        });

    }

    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            autoWidth:true,
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
                    items:4
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

@endsection


