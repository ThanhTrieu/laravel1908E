<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link type="text/css" rel="stylesheet" href="{{asset('test/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                <h1 class="text-center text-secondary my-2">Login</h1>
                <form class="border p-3" action="{{route('test.handle.login')}}" method="post">
                    @csrf
                    {{-- de co token gui len - vi day la method post --}}
                    <div class="form-group">
                        <label for="user">username</label>
                        <input type="text" id="user" name="user" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" name="pass" class="form-control" />
                    </div>
                    <button type="submit" name="btnLogin" class="btn btn-primary"> Login </button>
                    {{-- comment blade laravel --}}
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('test/js/jquery-3.5.1.min.js')}}"></script>
</body>
</html>
