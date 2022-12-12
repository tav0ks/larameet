<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Larameet</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;

        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="bg-gradient bg-primary">

    <div class="container">

        <div class="card shadow-lg my-5 w-50">
            <div class="card-body ">

                <div class="row">
                    <div class=" col-12">
                        <div class="p-5 border rounded-4 border-dark">

                            <div class=" center text-center">
                                <h2 class=" mb-4">Reunião</h2>
                            </div>
                            <hr>
                            <div class="text-center">
                                <p>
                                    Foi reenviado o seu uuid para participar da reunião {{ $meet->name }}
                                </p>
                                <p>Insira seu código na área UUID. Ao entrar pela primeira vez será pedido que coloque
                                    um nome!</p>
                                <p>Seu código para acesso é:</p>
                                <p>{{ $uuid }}</p>
                            </div>
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <a href="{{ route('auth.login.create') }}">
                                    <button style="background-color: rgb(48, 109, 222);padding: 10px 15px; color: aliceblue;border: 0; text-align: center;">
                                        Acessar
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

</body>

</html>
