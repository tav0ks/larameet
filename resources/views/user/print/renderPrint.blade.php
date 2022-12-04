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
            margin-left: 20px;
        }
    </style>
</head>

<body>

    <div class="box">
        <br>
        <h1>
            {{ $meet->name }}
        </h1>
        <br>
        <br>
        <h4>Duração: {{ $meet->duration }}</h4>
        <h5>Responsável pelo meet: {{ $user->name }}</h5>
        <h5>Participantes:</h5>
        <ul>
            @foreach ($participants as $participant)
                @if ($participant->name != '' && $participant->name != null)
                    <li>{{ $participant->name }}</li>
                @endif
            @endforeach
        </ul>
        <br><br>
        <div class="trix-content">
            {{ $pauta->pauta }}
        </div>
    </div>
</body>

</html>
