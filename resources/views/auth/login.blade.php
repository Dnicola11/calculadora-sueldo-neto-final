<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de sesión</title>

    {{-- Icon page --}}
    <link rel="icon" href="https://static-00.iconduck.com/assets.00/devicon-plain-icon-2048x1941-ps18p8i9.png">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-light mt-5">Iniciar sesión</h2>

                <div class="card my-5">
                    <form class="card-body p-lg-5" action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" id="username" name="username" class="form-control"
                                value="{{ old('username') }}">

                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control">

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @if (Session::has('message'))
                                <small class="text-danger">{{ Session::get('message') }}</small>
                            @endif
                        </div>

                        <div class="mb-3 float-end">
                            <button type="submit" class="btn btn-success px-4">Ingresar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- FontAwesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>

</html>
