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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sb-admin-2.min.css') }}">

</head>

<body class="bg-gradient-primary">

    <div class="container ">

        <div class="card shadow-lg my-5 w-75 mx-auto">
            <div class="card-body ">

                <div class="row">
                    <div class="col-12">
                        <div class="p-3">

                            <div class="text-center">

                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session()->has('warning'))
                                    <div class="alert alert-warning">
                                        {{ session('warning') }}
                                    </div>
                                @endif

                                <h2 class="text-gray-900 mb-4">Login</h2>
                            </div>
                            <form action="{{ route('auth.login.store') }}" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control form-control-user {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="Email" value="{{ old('email') }}">
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-user {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="Senha">
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Realizar Login
                                </button>
                            </form>
                            <hr>
                            <form action="{{ route('auth.uuid.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="password" name="uuid"
                                        class="form-control form-control-user {{ $errors->has('uuid') ? ' is-invalid' : '' }}"
                                        placeholder="UUID">
                                    <div class="invalid-feedback">{{ $errors->first('uuid') }}</div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Realizar Login
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('auth.register.create') }}">Crie uma conta!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
