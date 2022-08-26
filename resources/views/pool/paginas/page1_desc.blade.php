<div class="card theme">
    <div class="card-header theme">
        <h2 class="theme">Tabela de pool</h2>
    </div>

    <div class="card-body">

        <table class="table theme" aria-label=".">
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

                    <form class="form" action="" method="post" id="formUsuario">
                        <div class="col">
                            <input class="form-control" type="text" name="user" id="user"
                                placeholder="Nome do participante">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn">Adicionar</button>
                        </div>
                    </form>

                </tr>
            </tbody>
        </table>

    </div>
</div>
