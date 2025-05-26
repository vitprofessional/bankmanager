<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Dutch Bangla Bank PLC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/32dcd4a478.js" crossorigin="anonymous"></script>
  </head>
  <body class="bg-success">
    <div class="container my-4">
        <div class="row align-items-center vh-100">
            <div class="col-8 col-md-5 mx-auto">
                <div class="card shadow py-4">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4 mx-auto mb-2">
                                <img class="w-100" src="https://iconape.com/wp-content/files/az/151369/png/151369.png">
                            </div>
                            <h5 class="card-title my-2 mb-4"><i class="fa-sharp fa-regular fa-hand-holding-circle-dollar"></i> Calculas Admin</h5>
                        </div>
                        <div class="row">
                            <div class="col-11 mx-auto">
                                @if(session()->has('success'))
                                    <div class="alert alert-success p-2 w-100 rounded-0 fw-bold">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-danger w-100 rounded-0 fw-bold">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @if($allemployee->count()>0)
                            <form class="form col-11 mx-auto" action="{{ route('loginCalculas') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="loginId"><i class="fa-thin fa-lock"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter login ID" aria-label="loginId" name="loginId" aria-describedby="loginId" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="loginPass"><i class="fa-thin fa-key"></i></span>
                                    <input type="password" class="form-control" placeholder="Enter password" aria-label="loginPass" name="loginPass" aria-describedby="loginPass" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Login</button>
                                </div>
                            </form>
                            @else
                            <form class="form col-11 mx-auto" action="{{ route('registerCalculas') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="employeeName"><i class="fa-thin fa-circle-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter employee name" aria-label="employeeName" name="employeeName" aria-describedby="employeeName">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="employeeMail"><i class="fa-thin fa-envelope"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter employee email" aria-label="employeeMail" name="employeeMail" aria-describedby="employeeMail" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="loginId"><i class="fa-thin fa-lock"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter login ID" aria-label="loginId" name="loginId" aria-describedby="loginId" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="loginPass"><i class="fa-thin fa-key"></i></span>
                                    <input type="password" class="form-control" placeholder="Enter password" aria-label="loginPass" name="loginPass" aria-describedby="loginPass" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success" type="submit"><i class="fa-solid fa-right-from-bracket fa-beat"></i> Register</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>