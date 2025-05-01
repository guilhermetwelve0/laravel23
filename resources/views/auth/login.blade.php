<!doctype html>
<html lang="pt">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>POS | Página de Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Página de Login" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <style>
      #particles-js {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
      }
    </style>
  </head>
  <body class="login-page bg-body-secondary">
    <div id="particles-js"></div>
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>POS </b>Sistema</a>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Entre para iniciar sua sessão</p>
          @include('_message')
          <form action="{{url('login_post')}}" method="post">
            @csrf
            {{csrf_field()}}
            <div class="input-group mb-3">
              <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email" required />
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Senha" required />
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="form-check">
                  <label class="form-check-label" for="flexCheckDefault"> </label>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
              </div>
            </div>
          </form>
          <p class="mb-1"><a href="{{url('registration')}}">Novo Cadastro</a></p>
          <br>
          <p class="mb-1"><a href="{{url('forgot')}}">Esqueci minha senha</a></p>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
  particlesJS("particles-js", {
    particles: {
      number: { value: 120 }, 
      color: { value: "#333333" }, 
      opacity: { value: 0.8, random: false }, 
      size: { value: 4, random: true }, 
      move: { speed: 1.5, direction: "none", random: false, straight: false },
      line_linked: { 
        enable: true, 
        distance: 120, 
        color: "#222222", 
        opacity: 0.6, 
        width: 1.5 
      }
    }
  });
</script>

    <script src="{{asset('dist/js/adminlte.js')}}"></script>
  </body>
</html>
