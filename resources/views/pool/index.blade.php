<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">

    <style>
        #main_content .hidden_desc {
            display: none;
            visibility: hidden;
        }
    </style>

</head>

<body onload="page_open()">
    <div class="container border border-dark rounded-2 mt-3 pt-3 pb-4 theme">
        <div class="row theme justify-content-around">

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

        {{-- <div class="row justify-content-start theme">
        <div class="col">
          <form action="">
            <button class="btn btn-success" href="#">Edit</button>
          </form>

          <!--Pessoas participantes-->
          <i class="fa-solid fa-user"></i>
          <!--adicionar contador-->
        </div>
      </div> --}}

        {{-- conteudo da pagina --}}
        <div class="content-wrapper theme" id="main_content">
            <div class="row justify-content-start gx-1">

                <div class="col">
                    <p class="selected btn btn-info" id="page1" onclick="change_tab(this.id);">
                        Tabela
                    </p>

                    <p class="notselected btn btn-info" id="page2" onclick="change_tab(this.id);">
                        Administrador
                    </p>
                </div>
                <div class="col">

                </div>

            </div>

            <div class="hidden_desc" id="page1_desc">
                <div class="card theme">
                    <div class="card-header theme">
                        <h2 class="theme">Tabela de pool</h2>
                    </div>

                    <div class="card-body">

                        <table class="table theme" aria-label="." id="tabelaPool">
                            <thead>

                                <tr>
                                    <th scope="col">
                                        {{-- {{()}} --}}
                                    </th>
                                </tr>

                                <tr>
                                    <th scope="col">PARTICIPANTES</th>
                                    {{-- @foreach ($events as $item)
                                              <th scope="col">{{ $item->start_date }}</th>
                                              <th scope="col">{{ $item->end_date }}</th>
                                          @endforeach --}}
                                </tr>

                            </thead>
                            <tbody>
                                <tr>

                                    <form action="" method="post" id="formUsuario">
                                        
                                            <input class="form-control" type="text" name="user" id="user"
                                                placeholder="Nome do participante">
                                        
                                            <button type="submit" class="btn">Adicionar</button>
                                        
                                    </form>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <div class="hidden_desc" id="page2_desc">

                @include('pool.paginas.page2_desc')

            </div>

            <div class="theme" id="page_content"></div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scrip.js') }}"></script>
    <script src="{{ asset('js/scriptData.js') }}"></script>
    <script src="{{ asset('js/scriptUsuario.js') }}"></script>
</body>

</html>
