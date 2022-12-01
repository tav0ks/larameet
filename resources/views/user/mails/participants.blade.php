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
                                    Você foi chamado para participar da reunião {{ $meet->name }}
                                </p>
                                <p>Insira seu código na área UUID. Ao entrar pela primeira vez será pedido que coloque
                                    um nome!</p>
                                <p>Seu código para acesso será:</p>
                                <p>{{ $uuid }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

</body>

</html>
