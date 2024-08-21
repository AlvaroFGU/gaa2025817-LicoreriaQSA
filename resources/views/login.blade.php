<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<section class="vh-100" style="background-color: #333333;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <div class="img-container" style="width: 100%; overflow: hidden;">
                <img src="" alt="login form" class="img-fluid" style="width: 200%; border-radius: 1rem;">
              </div>
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        
                    </div>
                @endif
              <form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="d-flex align-items-center mb-3 pb-1">
    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
    <span class="h1 fw-bold mb-0">Ingresar</span>
  </div>
  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicia sesión en tu cuenta</h5>
  <div class="form-outline mb-4">
    <input type="email" name="Correo" id="Correo" class="form-control form-control-lg" required />
    <label class="form-label" for="Correo">Correo Electronico</label>
  </div>
  <div class="form-outline mb-4">
    <input type="password" name="Contrasenia" id="Contrasenia" class="form-control form-control-lg" required />
    <label class="form-label" for="Contrasenia">Contraseña</label>
  </div>
  <div class="pt-1 mb-4">
    <button class="btn btn-dark btn-lg btn-block" type="submit">Iniciar</button>
  </div>
  <a class="small text-muted" href="{{ route('password.request') }}">Olvidaste tu Contraseña</a>
  <a href="#!" class="small text-muted">Terminos de uso.</a>
  <a href="#!" class="small text-muted">Politica de privacidad</a>
</form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
